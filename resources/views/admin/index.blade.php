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
                                                    <p class="text-sm font-medium text-gray-900">Статистика</p>
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
                                    @include('components.modal-new-service')
                                </div>
                                <div class="border-t border-gray-200">
                                    <div class="bg-cream px-4 py-5">
                                        <div class="w-full">
                                            @foreach ($services as $service)
                                                <div
                                                    class="bg-white shadow mb-4 rounded-md overflow-hidden @if ($service->trashed()) border-l-4 border-red-500 opacity-75 @endif">
                                                    <div class="px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <!-- Блок с фото и информацией -->
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="flex-shrink-0 h-16 w-16 rounded-md bg-cream flex items-center justify-center overflow-hidden">
                                                                    @if ($service->photo)
                                                                        <img src="{{ asset('storage/' . $service->photo) }}"
                                                                            alt="Фото услуги {{ $service->name }}"
                                                                            class="h-full w-full object-cover">
                                                                    @else
                                                                        <svg class="h-8 w-8 text-gray-400" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                    @endif
                                                                </div>

                                                                <!-- Информация об услуге -->
                                                                <div class="ml-4">
                                                                    <p class="text-sm font-medium text-gray-900">
                                                                        {{ $service->name }}
                                                                        @if ($service->trashed())
                                                                            <span
                                                                                class="text-xs text-red-500">(удалена)</span>
                                                                        @endif
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ number_format($service->price, 0, ',', ' ') }} ₽
                                                                    </p>
                                                                    @if ($service->trashed())
                                                                        <p class="text-xs text-gray-400 mt-1">
                                                                            Удалена:
                                                                            {{ $service->deleted_at->format('d.m.Y H:i') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <!-- Блок с кнопками -->
                                                            <div class="flex space-x-2">
                                                                @if ($service->trashed())
                                                                    <!-- Кнопка восстановления -->
                                                                    <form action="{{ route('service.restore', $service) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                                            Восстановить
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <!-- Кнопки редактирования и удаления -->
                                                                    @include(
                                                                        'components.modal-edit-service',
                                                                        ['service' => $service]
                                                                    )
                                                                    @include(
                                                                        'components.modal-delete-service',
                                                                        ['service' => $service]
                                                                    )
                                                                @endif
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
                                                <div
                                                    class="bg-white shadow mb-4 rounded-md overflow-hidden @if ($master->trashed()) border-l-4 border-red-500 opacity-75 @endif">
                                                    <div class="px-4 py-4 sm:px-6">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center">
                                                                <div
                                                                    class="flex-shrink-0 h-16 w-16 rounded-md bg-cream flex items-center justify-center overflow-hidden">
                                                                    @if ($master->photo)
                                                                        <img src="{{ asset('storage/' . $master->photo) }}"
                                                                            alt="Фото мастера {{ $master->name }}"
                                                                            class="h-full w-full object-cover">
                                                                    @else
                                                                        <svg class="h-8 w-8 text-gray-400" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                    @endif
                                                                </div>
                                                                <div class="ml-4">
                                                                    <p class="text-sm font-medium text-gray-900">
                                                                        {{ $master->surname . ' ' . $master->name . ' ' . $master->fathername }}
                                                                        @if ($master->trashed())
                                                                            <span
                                                                                class="text-xs text-red-500">(удален)</span>
                                                                        @endif
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $master->specialization }}</p>
                                                                    @if ($master->trashed())
                                                                        <p class="text-xs text-gray-400 mt-1">
                                                                            Удален:
                                                                            {{ $master->deleted_at->format('d.m.Y H:i') }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="flex space-x-2">
                                                                @if ($master->trashed())
                                                                    <!-- Кнопка восстановления -->
                                                                    <form action="{{ route('master.restore', $master) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                                            Восстановить
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <!-- Кнопки редактирования и удаления -->
                                                                    @include(
                                                                        'components.modal-edit-master',
                                                                        [
                                                                            'master' => $master,
                                                                            'services' => $services,
                                                                            'masterServiceIds' => $master->services->pluck('id')->toArray(),
                                                                        ]
                                                                    )
                                                                    @include(
                                                                        'components.modal-delete-master',
                                                                        [
                                                                            'master' => $master,
                                                                        ]
                                                                    )
                                                                @endif
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
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Формирование отчетов о работе салона
                                    </p>
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
                                                <p class="text-2xl font-bold text-gray-900">{{ $recordsCount }}</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('admin.excel') }}">
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    Скачать Excel отчет
                                                </button>
                                            </a>
                                            <a href="{{ route('admin.pdf') }}">
                                                <button type="button"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    Скачать PDF отчет
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
