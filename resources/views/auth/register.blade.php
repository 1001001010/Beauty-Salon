@extends('layouts.auth')
@section('title')
    {{ config('app.APP_NAME') }} - Регистрация
@endsection

@section('content')
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Зарегистрируйте новый аккаунт
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Или
                <a href="/login" class="font-medium text-mauve hover:text-blush">
                    войдите в существующий аккаунт
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-4 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Имя
                        </label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name" autocomplete="given-name" required
                                placeholder="Введите имя" value="{{ old('name') }}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-mauve focus:border-mauve sm:text-sm @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Почта
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                placeholder="Введите почту" value="{{ old('email') }}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-mauve focus:border-mauve sm:text-sm @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">
                            Номер телефона
                        </label>
                        <div class="mt-1">
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-mauve focus:border-mauve sm:text-sm @error('phone') border-red-500 @enderror"
                                placeholder="Введите телефон">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Пароль
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                placeholder="Введите пароль"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-mauve focus:border-mauve sm:text-sm @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Подтверждение пароля
                        </label>
                        <div class="mt-1">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required placeholder="Подтвердите пароль"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-mauve focus:border-mauve sm:text-sm @error('password_confirmation') border-red-500 @enderror">
                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                            Зарегистрироваться
                        </button>
                    </div>
                </form>

                <div class="mt-3">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                ИЛИ
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('yandex') }}"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fab fa-yandex text-red-500 mr-2"></i>
                        Yandex
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="/" class="text-sm font-medium text-mauve hover:text-blush">
                <i class="fas fa-arrow-left mr-2"></i> На главную
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var phoneInput = document.getElementById('phone');
            var im = new Inputmask("+7 (999) 999-99-99", {
                clearMaskOnLostFocus: true,
                onBeforePaste: function(pastedValue, opts) {
                    return pastedValue.replace(/\D/g, '');
                }
            });
            im.mask(phoneInput);
        });
    </script>
@endsection
