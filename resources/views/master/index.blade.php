@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список записей
@endsection

@section('content')
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Ваши записи</h1>
            </div>
        </header>

        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <!-- Фильтры и поиск -->
                    <div
                        class="px-4 py-5 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-200">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Управление записями</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Просмотр и управление всеми записями клиентов</p>
                        </div>
                        <div class="flex items-center">
                            <div class="relative">
                                <input type="text" id="search-records"
                                    class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-mauve focus:border-mauve block w-full pl-10 p-2.5"
                                    placeholder="Поиск записей...">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Таблица записей -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-cream">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Клиент
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Дата и время
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Услуга
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Мастер
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Действия
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($records as $record)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center">
                                                    <i class="fas fa-user text-mauve"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $record->client->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $record->client->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 mr-2">
                                                    <i class="far fa-calendar-alt text-mauve"></i>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y') }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($record->datetime)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $record->service->name }}</div>
                                            <div class="text-sm text-gray-500">₽{{ $record->service->price }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if (isset($record->master) && $record->master->photo)
                                                    <img class="h-8 w-8 rounded-full object-cover mr-2"
                                                        src="{{ asset('storage/' . $record->master->photo) }}"
                                                        alt="{{ $record->master->name }}">
                                                @else
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-cream flex items-center justify-center mr-2">
                                                        <i class="fas fa-user-md text-mauve text-xs"></i>
                                                    </div>
                                                @endif
                                                <div class="text-sm text-gray-900">
                                                    {{ isset($record->master) ? $record->master->surname . ' ' . $record->master->name : 'Не назначен' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    <i class="fas fa-edit mr-1"></i> Изменить
                                                </button>
                                                <form action="{{ route('records.delete') }}" method="post"
                                                    class="inline-block">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input name="id" class="hidden" value="{{ $record->id }}">
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                        <i class="fas fa-times mr-1"></i> Отменить
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if (count($records) == 0)
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div
                                                    class="h-16 w-16 rounded-full bg-cream flex items-center justify-center mb-4">
                                                    <i class="fas fa-calendar-times text-mauve text-2xl"></i>
                                                </div>
                                                <p class="text-gray-500 text-lg">Записей пока нет</p>
                                                <p class="text-gray-400 text-sm mt-1">Здесь будут отображаться все ваши
                                                    записи</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Пагинация -->
                    @if (isset($records) && method_exists($records, 'links') && $records->hasPages())
                        <div class="px-4 py-3 bg-cream border-t border-gray-200 sm:px-6">
                            {{ $records->links() }}
                        </div>
                    @endif
                </div>

                <!-- Статистика -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-cream flex items-center justify-center">
                                <i class="fas fa-calendar-check text-mauve text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Всего записей</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ count($records) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-cream flex items-center justify-center">
                                <i class="fas fa-clock text-mauve text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Ближайшая запись</h3>
                                @php
                                    $nextRecord = $records->where('datetime', '>=', now())->sortBy('datetime')->first();
                                @endphp
                                @if ($nextRecord)
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($nextRecord->datetime)->format('d.m.Y H:i') }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-500">Нет предстоящих записей</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-cream flex items-center justify-center">
                                <i class="fas fa-spa text-mauve text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Популярная услуга</h3>
                                @php
                                    $services = $records->groupBy('service.name');
                                    $popularService = $services
                                        ->sortByDesc(function ($service) {
                                            return $service->count();
                                        })
                                        ->keys()
                                        ->first();
                                @endphp
                                @if ($popularService)
                                    <p class="text-sm font-medium text-gray-900">{{ $popularService }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Нет данных</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Поиск по записям
            const searchInput = document.getElementById('search-records');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
@endsection
