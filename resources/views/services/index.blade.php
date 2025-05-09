@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список услуг
@endsection

@section('content')
    @if ($errors->any())
        <div
            class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-4 dark:bg-red-900/10 dark:border-red-500/20 dark:text-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Список услуг</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0">
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Левая колонка с поиском и фильтрами -->
                        <div class="w-full md:w-1/4">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Фильтры и поиск</h3>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5">
                                    <form method="GET" action="{{ route('service.index') }}">
                                        <!-- Поле поиска по названию -->
                                        <div class="mb-4">
                                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                                Название услуги
                                            </label>
                                            <input type="text" name="word" id="search"
                                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                                placeholder="Поиск услуг" value="{{ request('word') ?? '' }}" />
                                        </div>

                                        <!-- Фильтры по цене -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                                Цена
                                            </label>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div>
                                                    <label for="price_min" class="sr-only">Цена от</label>
                                                    <input type="number" name="price_min" id="price_min"
                                                        class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                                        placeholder="От" min="0" step="0.01"
                                                        value="{{ request('price_min') ?? '' }}" />
                                                </div>
                                                <div>
                                                    <label for="price_max" class="sr-only">Цена до</label>
                                                    <input type="number" name="price_max" id="price_max"
                                                        class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                                        placeholder="До" min="0" step="0.01"
                                                        value="{{ request('price_max') ?? '' }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Кнопки -->
                                        <div class="flex flex-col gap-2">
                                            <button type="submit"
                                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                Применить фильтры
                                            </button>

                                            @if (request()->has('word') || request()->has('price_min') || request()->has('price_max'))
                                                <a href="{{ route('service.index') }}"
                                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    Сбросить все
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Правая колонка со списком услуг -->
                        <div class="w-full md:w-3/4">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Доступные услуги</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Выберите услугу для записи</p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="bg-cream px-4 py-5">
                                        <div class="w-full">
                                            @if ($services->count() > 0)
                                                @foreach ($services as $service)
                                                    @component('components.service-card', [
                                                        'service' => $service,
                                                        'variant' => 'client',
                                                        'masters' => $masters,
                                                    ])
                                                    @endcomponent
                                                @endforeach
                                            @else
                                                <div class="text-center py-8">
                                                    <p class="text-gray-500">Услуги не найдены</p>
                                                    @if (request()->has('word') || request()->has('price_min') || request()->has('price_max'))
                                                        <a href="{{ route('service.index') }}"
                                                            class="text-mauve hover:text-blush mt-2 inline-block">
                                                            Сбросить фильтры
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
