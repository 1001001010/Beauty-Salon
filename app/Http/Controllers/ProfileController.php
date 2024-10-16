<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Record;
use DB;

class ProfileController extends Controller
{
    /**
     * Отображение профиля
     */
    public function index(): View
    {
        $userId = Auth::id();
        $now = now();

        // Получаем предстоящие записи
        $upcomingRecords = Record::where('client_id', $userId)
            ->where('datetime', '>=', $now)
            ->get();

        // Создаем массив для результата предстоящих записей
        $upcomingResult = [];

        // Добавляем предстоящие записи в массив
        foreach ($upcomingRecords as $record) {
            // Получаем master_service_id из текущей записи
            $masterServiceId = $record->master_service_id;

            // Получаем master_id и service_id из таблицы master_service по master_service_id
            $masterService = DB::table('master_service')
                ->where('id', $masterServiceId)
                ->first();

            if ($masterService) {
                $masterId = $masterService->master_id;
                $serviceId = $masterService->service_id;

                // Получаем информацию о мастере из таблицы masters по master_id
                $master = DB::table('masters')
                    ->where('id', $masterId)
                    ->first();

                // Получаем информацию о сервисе из таблицы services по service_id
                $service = DB::table('services')
                    ->where('id', $serviceId)
                    ->first();

                // Добавляем информацию о мастере и сервисе в запись
                $record->master = $master;
                $record->service = $service;
            }

            // Добавляем запись в массив результата
            $upcomingResult[] = $record;
        }

        // Получаем прошедшие записи
        $pastRecords = Record::where('client_id', $userId)
            ->where('datetime', '<', $now)
            ->get();

        // Создаем массив для результата прошедших записей
        $pastResult = [];

        // Добавляем прошедшие записи в массив
        foreach ($pastRecords as $record) {
            // Получаем master_service_id из текущей записи
            $masterServiceId = $record->master_service_id;

            // Получаем master_id и service_id из таблицы master_service по master_service_id
            $masterService = DB::table('master_service')
                ->where('id', $masterServiceId)
                ->first();

            if ($masterService) {
                $masterId = $masterService->master_id;
                $serviceId = $masterService->service_id;

                // Получаем информацию о мастере из таблицы masters по master_id
                $master = DB::table('masters')
                    ->where('id', $masterId)
                    ->first();

                // Получаем информацию о сервисе из таблицы services по service_id
                $service = DB::table('services')
                    ->where('id', $serviceId)
                    ->first();

                // Добавляем информацию о мастере и сервисе в запись
                $record->master = $master;
                $record->service = $service;
            }

            // Добавляем запись в массив результата
            $pastResult[] = $record;
        }

        return view('profile', [
            'user' => Auth::user(),
            'upcomingRecords' => $upcomingResult,
            'pastRecords' => $pastResult,
        ]);
    }

    /**
     * Отображение открытия настроек
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Обновления данных пользователя
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
