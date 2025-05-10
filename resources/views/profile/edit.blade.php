@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Редактирование профиля
@endsection

@section('content')
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Редактирование профиля</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0 space-y-8">
                    <!-- Форма обновления профиля -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Обновление информации профиля</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Обновите ваши личные данные</p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')

                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                                        <div class="mt-1">
                                            <input type="text" id="name" name="name" autocomplete="name"
                                                value="{{ old('name', $user->name) }}"
                                                class="shadow-sm focus:ring-mauve focus:border-mauve block w-full sm:text-sm border-gray-300 rounded-md">
                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <div class="mt-1">
                                            <input type="email" id="email" name="email" autocomplete="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="shadow-sm focus:ring-mauve focus:border-mauve block w-full sm:text-sm border-gray-300 rounded-md">
                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <div class="flex items-center gap-4">
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                Сохранить
                                            </button>

                                            @if (session('status') === 'profile-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    Успешно сохранено
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Форма обновления пароля -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Обновление пароля</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Измените ваш пароль</p>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="update_password_current_password"
                                            class="block text-sm font-medium text-gray-700">Действующий пароль</label>
                                        <div class="mt-1">
                                            <input type="password" id="update_password_current_password"
                                                name="current_password" autocomplete="current-password"
                                                class="shadow-sm focus:ring-mauve focus:border-mauve block w-full sm:text-sm border-gray-300 rounded-md">
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="update_password_password"
                                            class="block text-sm font-medium text-gray-700">Новый пароль</label>
                                        <div class="mt-1">
                                            <input type="password" id="update_password_password" name="password"
                                                autocomplete="new-password"
                                                class="shadow-sm focus:ring-mauve focus:border-mauve block w-full sm:text-sm border-gray-300 rounded-md">
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="update_password_password_confirmation"
                                            class="block text-sm font-medium text-gray-700">Подтверждение пароля</label>
                                        <div class="mt-1">
                                            <input type="password" id="update_password_password_confirmation"
                                                name="password_confirmation" autocomplete="new-password"
                                                class="shadow-sm focus:ring-mauve focus:border-mauve block w-full sm:text-sm border-gray-300 rounded-md">
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <div class="flex items-center gap-4">
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                Сохранить
                                            </button>

                                            @if (session('status') === 'password-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    Успешно сохранено
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
