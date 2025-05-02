@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Панель администратора
@endsection

@section('content')
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Панель администратора</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row mt-6">
                    <!-- Сайдбар с якорями -->
                    <div class="w-full lg:w-1/4 mb-6 lg:mb-0 lg:pr-6">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg sticky top-6">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Разделы</h3>
                            </div>
                            <div class="border-t border-gray-200 bg-cream">
                                <ul class="divide-y divide-gray-200">
                                    <li>
                                        <a href="#section1"
                                            class="block px-4 py-4 hover:bg-blush hover:text-white transition-colors duration-200">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-8 w-8 rounded-full bg-white flex items-center justify-center">
                                                    <i class="fas fa-list text-mauve"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Список услуг</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#section2"
                                            class="block px-4 py-4 hover:bg-blush hover:text-white transition-colors duration-200">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-8 w-8 rounded-full bg-white flex items-center justify-center">
                                                    <i class="fas fa-users text-mauve"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Список мастеров</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#section3"
                                            class="block px-4 py-4 hover:bg-blush hover:text-white transition-colors duration-200">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-8 w-8 rounded-full bg-white flex items-center justify-center">
                                                    <i class="fas fa-chart-bar text-mauve"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Отчет</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Основной контент -->
                    <div class="w-full lg:w-3/4">
                        <!-- Секция услуг -->
                        <div id="section1" class="mb-8">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Список услуг</h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Управление услугами салона</p>
                                    </div>
                                    {{-- <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                        Добавить услугу
                                    </button> --}}
                                    @component('components.modal-new-service')
                                    @endcomponent
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="bg-cream px-4 py-5">
                                        <div class="w-full">
                                            @foreach ($services as $service)
                                                <div class="bg-white shadow mb-4 rounded-md overflow-hidden">
                                                    <div class="px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center">
                                                                    <i class="fas fa-spa text-mauve"></i>
                                                                </div>
                                                                <div class="ml-4">
                                                                    <p class="text-sm font-medium text-gray-900">
                                                                        {{ $service->name }}</p>
                                                                    <p class="text-sm text-gray-500">{{ $service->price }} ₽
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="flex space-x-2">
                                                                <button type="button"
                                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                                    Редактировать
                                                                </button>
                                                                <button type="button"
                                                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                                    Удалить
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Секция мастеров -->
                        <div id="section2" class="mb-8">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Список мастеров</h3>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Управление мастерами салона</p>
                                    </div>
                                    @component('components.modal-new-master', ['services' => $services])
                                    @endcomponent
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="bg-cream px-4 py-5">
                                        <div class="w-full">
                                            @foreach ($masters as $master)
                                                <div class="bg-white shadow mb-4 rounded-md overflow-hidden">
                                                    <div class="px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center">
                                                                    <i class="fas fa-user text-mauve"></i>
                                                                </div>
                                                                <div class="ml-4">
                                                                    <p class="text-sm font-medium text-gray-900">
                                                                        {{ $master->name }}</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $master->specialization }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="flex space-x-2">
                                                                <button type="button"
                                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                                    Редактировать
                                                                </button>
                                                                <button type="button"
                                                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                                    Удалить
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Секция отчета -->
                        <div id="section3" class="mb-8">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Отчет</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Формирование отчетов о работе салона</p>
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="bg-cream px-4 py-5">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                            <div class="bg-white p-4 rounded-md shadow">
                                                <h4 class="text-sm font-medium text-gray-500">Всего услуг</h4>
                                                <p class="text-2xl font-bold text-gray-900">{{ count($services) }}</p>
                                            </div>
                                            <div class="bg-white p-4 rounded-md shadow">
                                                <h4 class="text-sm font-medium text-gray-500">Всего мастеров</h4>
                                                <p class="text-2xl font-bold text-gray-900">{{ count($masters) }}</p>
                                            </div>
                                            <div class="bg-white p-4 rounded-md shadow">
                                                <h4 class="text-sm font-medium text-gray-500">Записей за месяц</h4>
                                                <p class="text-2xl font-bold text-gray-900">42</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-center">
                                            <a href="{{ route('admin.exel') }}">
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    Скачать полный отчет
                                                </button>
                                            </a>
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

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection
