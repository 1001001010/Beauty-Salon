<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Отображение страницы регистрации
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Регистрация пользователя
     */
    // public function store(Request $request)/
    public function store(RegisterRequest $request)
    {
        // Получаем валидированные данные
        $data = $request->validated();

        // Создаем пользователя
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        Auth::login($user); // Входим в аккаунт

        return redirect(route('profile.index', absolute: false));
    }
}
