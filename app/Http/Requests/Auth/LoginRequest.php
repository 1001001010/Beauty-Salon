<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Может ли пользователь выполнить запрос
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Сообщения об ошибках валидации
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Поле почта обязательно для заполения',
            'email.email' => 'Введите корректный адрес электронной почты',
            'password.required' => 'Пароль обязателен для заполения',
        ];
    }

    /**
     * Попытка проверить подлинность учетных данных запроса
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->input('email'))->first();

        if ($user && $user->provider === 'yandex') {
            throw ValidationException::withMessages([
                'email' => 'Используйте Yandex для авторизации',
            ]);
        }

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Проверка, что частота запросов на вход не ограничена
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Получение ключа ограничения скорости для запроса
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
