<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['required', 'digits:11', 'unique:' . User::class],
        ];
    }

    // Сообщения об ошибках
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.string' => 'Поле "Имя" должно быть строкой',
            'name.max' => 'Имя не должно превышать 255 символов',

            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.string' => 'Поле "Email" должно быть строкой',
            'email.email' => 'Введите корректный адрес электронной почты',
            'email.max' => 'Email не должен превышать 255 символов',
            'email.unique' => 'Пользователь с таким Email уже зарегистрирован',

            'phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'phone.digits' => 'Телефон должен содержать ровно 11 цифр',
            'phone.unique' => 'Пользователь с таким номером телефона уже существует',

            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }

    // Очистка номера телефона
    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => preg_replace('/\D+/', '', $this->input('phone')),
            ]);
        }
    }
}
