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
                                                <button type="button" data-record-id="{{ $record->id }}"
                                                    data-client-name="{{ $record->client->name }}"
                                                    data-client-email="{{ $record->client->email }}"
                                                    data-client-phone="{{ $record->client->phone ?? 'Не указан' }}"
                                                    data-appointment-date="{{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y H:i') }}"
                                                    data-service-name="{{ $record->service->name }}"
                                                    class="cancel-button inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    <i class="fas fa-times mr-1"></i> Отменить
                                                </button>
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

    <!-- Модальное окно для отмены записи -->
    <div id="cancel-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Фоновое затемнение -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Центрирование модального окна -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Содержимое модального окна -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-cream sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-circle text-mauve"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Отмена записи
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Для отмены записи необходимо предварительно связаться с клиентом и сообщить ему об
                                    отмене. Используйте контактную информацию клиента:
                                </p>
                                <div class="mt-4 bg-cream rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-user text-mauve mr-2"></i>
                                        <span class="text-sm font-medium" id="client-name"></span>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-envelope text-mauve mr-2"></i>
                                        <span class="text-sm font-medium" id="client-email"></span>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-phone-alt text-mauve mr-2"></i>
                                        <span class="text-sm font-medium" id="client-phone"></span>
                                    </div>
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex items-center mb-2">
                                            <i class="far fa-calendar-alt text-mauve mr-2"></i>
                                            <span class="text-sm font-medium" id="appointment-date"></span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-spa text-mauve mr-2"></i>
                                            <span class="text-sm font-medium" id="service-name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="cancel-form" action="{{ route('records.delete') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input id="record-id-input" name="id" class="hidden" value="">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-mauve text-base font-medium text-white hover:bg-mauve-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve sm:ml-3 sm:w-auto sm:text-sm">
                            Подтвердить отмену
                        </button>
                    </form>
                    <button type="button" id="close-modal"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Закрыть
                    </button>
                </div>
            </div>
        </div>
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

            // Функционал модального окна
            const modal = document.getElementById('cancel-modal');
            const closeModalBtn = document.getElementById('close-modal');
            const cancelButtons = document.querySelectorAll('.cancel-button');
            const recordIdInput = document.getElementById('record-id-input');

            // Элементы для отображения информации о клиенте
            const clientNameEl = document.getElementById('client-name');
            const clientEmailEl = document.getElementById('client-email');
            const clientPhoneEl = document.getElementById('client-phone');
            const appointmentDateEl = document.getElementById('appointment-date');
            const serviceNameEl = document.getElementById('service-name');

            // Функция форматирования телефонного номера
            function formatPhoneNumber(phoneNumber) {
                // Если номер не указан или не является строкой
                if (!phoneNumber || phoneNumber === 'Не указан') {
                    return 'Не указан';
                }

                // Удаляем все нецифровые символы
                const cleaned = phoneNumber.replace(/\D/g, '');

                // Проверяем длину номера
                if (cleaned.length !== 11) {
                    return phoneNumber; // Возвращаем исходный номер, если формат не соответствует
                }

                // Форматируем номер в формат +7 (XXX) XXX-XX-XX
                return `+7 (${cleaned.substring(1, 4)}) ${cleaned.substring(4, 7)}-${cleaned.substring(7, 9)}-${cleaned.substring(9, 11)}`;
            }

            // Открытие модального окна при нажатии на кнопку "Отменить"
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recordId = this.getAttribute('data-record-id');
                    const clientName = this.getAttribute('data-client-name');
                    const clientEmail = this.getAttribute('data-client-email');
                    const clientPhone = this.getAttribute('data-client-phone');
                    const appointmentDate = this.getAttribute('data-appointment-date');
                    const serviceName = this.getAttribute('data-service-name');

                    // Заполняем информацию о клиенте
                    clientNameEl.textContent = clientName;
                    clientEmailEl.textContent = clientEmail;
                    clientPhoneEl.textContent = formatPhoneNumber(clientPhone);
                    appointmentDateEl.textContent = appointmentDate;
                    serviceNameEl.textContent = serviceName;

                    // Устанавливаем ID записи для формы отмены
                    recordIdInput.value = recordId;

                    // Показываем модальное окно
                    modal.classList.remove('hidden');
                });
            });

            // Закрытие модального окна
            closeModalBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Закрытие модального окна при клике вне его области
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
