<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\{Record, Service, Master, MasterService};
use Carbon\Carbon;
use Auth;
use DB;

class RecordController extends Controller
{
    public function upload(Request $request) {
        $requestData = $request->all();
        $requestData['hour'] = (int)$requestData['hour'];
        $requestData['minute'] = (int)$requestData['minute'];

        $validator = Validator::make($requestData, [
            'date' => 'required|date_format:m/d/Y',
            'hour' => 'required|integer|between:0,23',
            'minute' => 'required|integer|in:0,30',
            'master_id' => 'required|integer',
            'service_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validate = $validator->validated();

        $clientId = Auth::id();

        // Формируем дату и время
        $date = Carbon::createFromFormat('m/d/Y', $validate['date']);
        $time = Carbon::createFromTime($validate['hour'], $validate['minute']);
        $datetime = $date->copy()->setTime($time->hour, $time->minute);

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
        $masterServiceId = MasterService::where('master_id', $validate['master_id'])
            ->where('service_id', $validate['service_id'])
            ->value('id');

        if (!$masterServiceId) {
            return redirect()->back()->with('message', ['type' => 'error', 'text' => 'Ошибка! Не удалось найти master_service_id']);
        }

        // Проверка на наличие записи в диапазоне 29 минут до и после
        $startTime = $datetime->copy()->subMinutes(29);
        $endTime = $datetime->copy()->addMinutes(29);

        $existingRecord = Record::where('master_service_id', $masterServiceId)
            ->whereBetween('datetime', [$startTime, $endTime])
            ->first();

        if ($existingRecord) {
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

    public function delete(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $record = Record::findOrFail($request->id);
        $record->delete();

        return redirect()->back()->with('message', ['type' => 'message', 'text' => 'Запись успешно отменена']);
    }
}
