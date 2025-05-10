<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function yandex() : RedirectResponse {
        return Socialite::driver('yandex')->redirect();
    }

    public function yandexRedirect(): RedirectResponse
    {
        try {
            $user = Socialite::driver('yandex')->user();

            $existingUser = User::where('email', $user->email)->first();

            // Обработка телефона
            $phone = null;
            if (isset($user->user['default_phone']['number'])) {
                $phone = preg_replace('/[^0-9]/', '', $user->user['default_phone']['number']);
                $phone = ltrim($phone, '7'); // Убираем ведущую 7 для России
                $phone = '7'.$phone; // Добавляем обратно
            }

            if (!$existingUser) {
                $newUser = User::create([
                    'name' => $user->name ?? $user->nickname,
                    'email' => $user->email,
                    'provider' => 'yandex',
                    'provider_id' => $user->id, // Добавляем provider_id
                    'password' => Hash::make(Str::random(16)),
                    'phone' => $phone,
                ]);

                Auth::login($newUser, true); // Второй параметр "remember" = true
                return redirect()->intended(route('profile.index'));
            } else {
                // Обновляем данные существующего пользователя
                if (empty($existingUser->provider_id)) {
                    $existingUser->update([
                        'provider' => 'yandex',
                        'provider_id' => $user->id,
                    ]);
                }

                Auth::login($existingUser, true);
                return redirect()->intended(route('profile.index'));
            }
        } catch (\Exception $e) {
            logger()->error('Yandex auth error: '.$e->getMessage());
            return redirect(route('login'))->with('error', 'Ошибка входа через Yandex');
        }
    }
}
