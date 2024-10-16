<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Record, Service, Master};
use Carbon\Carbon;
use Auth;
use DB;

class RecordController extends Controller
{
    public function upload(Request $request) {
        // Валидация входных данных
        $validate = $request->validate([
            'date' => 'required|date_format:d/m/Y',
            'time' => 'required|date_format:H:i',
            'master_id' => 'required|integer',
            'service_id' => 'required|integer',
        ]);

        // Получение текущего пользователя
        $clientId = Auth::id();

        // Формирование даты и времени
        $date = Carbon::createFromFormat('d/m/Y', $validate['date']);
        $time = Carbon::createFromFormat('H:i', $validate['time']);
        $datetime = $date->format('Y-m-d') . ' ' . $time->format('H:i:s');

        // Проверка наличия мастера
        $master = Master::find($validate['master_id']);

        if (!$master) {
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Ошибка! Такой мастер не найден']);
        }

        // Проверка наличия услуги для данного мастера
        $service = $master->services()->where('service_id', $validate['service_id'])->first();

        if (!$service) {
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Ошибка! Услуга не найдена']);
        }

        // Получение master_service_id на основе master_id и service_id
        $masterServiceId = DB::table('master_service')
            ->where('master_id', $validate['master_id'])
            ->where('service_id', $validate['service_id'])
            ->value('id');

        // Поиск записи на указанное время и дату для данного мастера
        $existingRecord = Record::where('master_service_id', $masterServiceId)
            ->where('datetime', $datetime)
            ->first();

        if ($existingRecord) {
            // Если запись уже существует, вернуть сообщение об ошибке
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Ошибка! Время занято']);
        }

        // Создание новой записи
        Record::create([
            'client_id' => $clientId,
            'master_service_id' => $masterServiceId,
            'datetime' => $datetime,
        ]);

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Успешно! Информацию о записи можете увидеть в личном кабинете']);
    }
}
