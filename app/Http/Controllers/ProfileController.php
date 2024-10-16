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

        $upcomingRecords = Record::where('client_id', $userId)
            ->where('datetime', '>=', $now)
            ->get();
        dd($upcomingRecords);

        $pastRecords = Record::where('client_id', $userId)
            ->where('datetime', '<', $now)
            ->get();

        return view('profile', [
            'user' => Auth::user(),
            'upcomingRecords' => $upcomingRecords,
            'pastRecords' => $pastRecords,
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
