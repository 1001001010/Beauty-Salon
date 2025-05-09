<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\{Record, MasterService};
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

        // Предстоящие записи (только активные)
        $upcomingRecords = Record::with(['service' => function($query) {
                $query->withTrashed();
            }])
            ->where('client_id', $userId)
            ->where('datetime', '>=', $now)
            ->get();

        // Прошедшие записи (включая удаленные услуги)
        $pastRecords = Record::with(['service' => function($query) {
                $query->withTrashed();
            }])
            ->where('client_id', $userId)
            ->where('datetime', '<', $now)
            ->get();

        return view('profile', [
            'user' => Auth::user(),
            'upcomingRecords' => $upcomingRecords,
            'pastRecords' => $pastRecords,
        ]);
    }

    /**
     * Получение информации о прошедших записях
     */
    private function GetPastInfo($pastRecords) {
        $pastResult = [];

        foreach ($pastRecords as $record) {
            $masterServiceId = $record->master_service_id;
            $masterService = MasterService::with('master', 'service')->where('id', $masterServiceId)->first();

            if ($masterService) {
                $feedback = DB::table('feedback')->where('records_id', $record->id)->first();

                $record->feedback = $feedback;
            }
            // Добавляем запись в массив результата
            $pastResult[] = $record;
        }

        return $pastResult;
    }

    /**
     * Получение информации о будующих записях
     */
    private function GetComminginfo($upcomingRecords) {
        $upcomingResult = [];

        foreach ($upcomingRecords as $record) {
            $masterServiceId = $record->master_service_id;
//            $masterService = DB::table('master_service')->where('id', $masterServiceId)->first();
            $masterService = MasterService::with('master', 'service')->where('id', $masterServiceId)->first();

            if ($masterService) {
                $masterId = $masterService->master_id;
                $serviceId = $masterService->service_id;
            }
            // Добавляем запись в массив результата
            $upcomingResult[] = $record;
        }

        return $upcomingResult;
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
