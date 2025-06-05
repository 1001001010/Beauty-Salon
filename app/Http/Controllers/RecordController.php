<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Record, Service, Master, MasterService, User};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Events\RecordCancelled;

class RecordController extends Controller
{
    // Ограничения по рабочим часам
    const WORKING_HOURS_START = 9; // начало рабочего дня - 9:00
    const WORKING_HOURS_END = 20;  // конец рабочего дня - 20:00
    const LUNCH_BREAK_START = 14;  // начало обеда - 14:00
    const LUNCH_BREAK_END = 15;    // конец обеда - 15:00
    const APPOINTMENT_DURATION = 150; // продолжительность записи в минутах (2 ч 30 мин)

    // Фиксированные слоты для записи
    const FIXED_SLOTS = [
        ['hour' => 9, 'minute' => 0],
        ['hour' => 11, 'minute' => 30],
        ['hour' => 15, 'minute' => 0],
        ['hour' => 17, 'minute' => 30],
    ];

    /**
     * Создание новой записи на прием
     */
    public function upload(Request $request)
    {
        $requestData = $request->all();
        $requestData['hour'] = (int) $requestData['hour'];
        $requestData['minute'] = (int) $requestData['minute'];

        // Валидация входящих данных
        $validator = Validator::make($requestData, [
            'date' => 'required|date_format:m/d/Y',
            'hour' => 'required|integer|between:' . self::WORKING_HOURS_START . ',' . self::WORKING_HOURS_END,
            'minute' => 'required|integer|in:0,30',
            'master_id' => 'required|integer',
            'service_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validate = $validator->validated();

        // Проверка, входит ли время в список допустимых слотов
        $isValidSlot = false;
        foreach (self::FIXED_SLOTS as $slot) {
            if ($validate['hour'] == $slot['hour'] && $validate['minute'] == $slot['minute']) {
                $isValidSlot = true;
                break;
            }
        }

        if (!$isValidSlot) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Ошибка! Запись возможна только на 9:00, 11:30, 15:00 или 17:30'
            ]);
        }

        // Получаем ID текущего клиента
        $clientId = Auth::id();

        // Форматирование даты и времени
        $date = Carbon::createFromFormat('m/d/Y', $validate['date']);
        $time = Carbon::createFromTime($validate['hour'], $validate['minute']);
        $datetime = $date->copy()->setTime($time->hour, $time->minute);

        // Проверка, существует ли мастер
        $master = Master::find($validate['master_id']);
        if (!$master) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Ошибка! Такой мастер не найден'
            ]);
        }

        // Проверка, оказывает ли мастер данную услугу
        $service = $master->services()->where('service_id', $validate['service_id'])->first();
        if (!$service) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Ошибка! Услуга не найдена'
            ]);
        }

        // Получение ID записи в связующей таблице master_service
        $masterServiceId = MasterService::where('master_id', $validate['master_id'])
            ->where('service_id', $validate['service_id'])
            ->value('id');

        if (!$masterServiceId) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Ошибка! Не удалось найти master_service_id'
            ]);
        }

        // Проверка, свободен ли указанный слот
        $existingRecord = Record::where('master_service_id', $masterServiceId)
            ->whereDate('datetime', $date)
            ->whereTime('datetime', $time->format('H:i:s'))
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'Ошибка! Это время уже занято.'
            ]);
        }

        // Создание новой записи
        Record::create([
            'client_id' => $clientId,
            'master_service_id' => $masterServiceId,
            'datetime' => $datetime,
        ]);

        return redirect()->back()->with('message', [
            'type' => 'message',
            'text' => 'Успешно! Информацию о записи можете увидеть в личном кабинете'
        ]);
    }

    /**
     * Получение доступных слотов на указанную дату и мастера
     */
    public function getAvailableTimeSlots(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date' => 'required|date_format:Y-m-d',
                'master_id' => 'required|integer',
                'service_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $date = Carbon::createFromFormat('Y-m-d', $request->date);

            // Проверка, не выбран ли выходной (воскресенье)
            if ($date->dayOfWeek === Carbon::SUNDAY) {
                return response()->json([
                    'success' => false,
                    'message' => 'Выбранный день является выходным'
                ], 422);
            }

            // Поиск master_service_id
            $masterServiceId = MasterService::where('master_id', $request->master_id)
                ->where('service_id', $request->service_id)
                ->value('id');

            if (!$masterServiceId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Мастер не предоставляет данную услугу'
                ], 404);
            }

            // Получаем все записи этого мастера на эту дату
            $existingAppointments = Record::whereIn('master_service_id', function ($query) use ($request) {
                $query->select('id')
                    ->from('master_service')
                    ->where('master_id', $request->master_id);
            })
                ->whereDate('datetime', $date)
                ->get(['datetime'])
                ->pluck('datetime')
                ->map(function ($datetime) {
                    return Carbon::parse($datetime)->format('H:i');
                })
                ->toArray();

            // Генерация доступных слотов
            $availableSlots = [];
            foreach (self::FIXED_SLOTS as $slot) {
                $timeString = sprintf('%02d:%02d', $slot['hour'], $slot['minute']);

                if (!in_array($timeString, $existingAppointments)) {
                    $availableSlots[] = [
                        'hour' => $slot['hour'],
                        'minute' => $slot['minute'],
                        'formatted' => $timeString
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'date' => $date->format('d.m.Y'),
                'slots' => $availableSlots
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка в getAvailableTimeSlots: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Проверка доступности временного слота
     */
    private function isTimeSlotAvailable($timeSlot, $existingAppointments)
    {
        // Проверка, не в прошлом ли слот
        if ($timeSlot->isPast()) {
            return false;
        }

        // Проверка, есть ли записи в пределах 2ч30м от текущего слота
        foreach ($existingAppointments as $appointment) {
            $timeDiff = abs($timeSlot->diffInMinutes($appointment));
            if ($timeDiff < self::APPOINTMENT_DURATION - 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Получение занятых дат для мастера
     */
    public function getBusyDates(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'master_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Получаем все master_service_id мастера
            $masterServices = MasterService::where('master_id', $request->master_id)->pluck('id');

            // Группировка всех записей по дате
            $busyDates = Record::whereIn('master_service_id', $masterServices)
                ->where('datetime', '>=', Carbon::today())
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->datetime)->format('Y-m-d');
                })
                ->map(function ($group) {
                    return [
                        'date' => $group->first()->datetime->format('Y-m-d'),
                        'count' => $group->count(),
                        'fully_booked' => $group->count() >= 10 // 4 фиксированных слота, максимум 10 записей в день
                    ];
                })
                ->values();

            return response()->json([
                'success' => true,
                'busy_dates' => $busyDates
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка в getBusyDates: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Удаление записи клиентом
     */
    public function delete(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $record = Record::findOrFail($request->id);

        // Получаем информацию о мастере
        $masterService = MasterService::findOrFail($record->master_service_id);
        $master = Master::findOrFail($masterService->master_id);
        $masterUser = User::findOrFail($master->user_id);

        // Получаем информацию о клиенте
        $client = Auth::user();

        // Сохраняем запись перед удалением для использования в событии
        $recordCopy = clone $record;

        // Удаляем запись
        $record->delete();

        // Отправляем уведомление мастеру через событие
        event(new RecordCancelled($recordCopy, $client, $masterUser));

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Запись успешно отменена']);
    }

    /**
     * Отмена записи мастером
     */
    public function cancelByMaster(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $record = Record::findOrFail($request->id);

        // Проверяем, что текущий пользователь - мастер этой записи
        $masterService = MasterService::findOrFail($record->master_service_id);
        $master = Master::findOrFail($masterService->master_id);

        if ($master->user_id != Auth::id()) {
            return redirect()->back()->with('message', [
                'type' => 'error',
                'text' => 'У вас нет прав для отмены этой записи'
            ]);
        }

        // Получаем информацию о клиенте
        $client = User::findOrFail($record->client_id);

        // Сохраняем запись перед удалением для использования в событии
        $recordCopy = clone $record;

        // Удаляем запись
        $record->delete();

        // Отправляем уведомление клиенту через событие
        event(new RecordCancelled($recordCopy, Auth::user(), $client));

        return redirect()->back()->with('message', [
            'type' => 'message',
            'text' => 'Запись успешно отменена'
        ]);
    }
}