@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Список записей
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Панель мастера</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Мои записи</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Дата и время</th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Клиент</th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Услуга</th>
                            <th
                                class="py-2 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y H:i') }}
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $record->client->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200">{{ $record->masterService->service->name }}
                                </td>
                                <td class="py-3 px-4 border-b border-gray-200">
                                    <button type="button" data-record-id="{{ $record->id }}"
                                        class="cancel-button inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-times mr-1"></i> Отменить
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if (count($records) === 0)
                            <tr>
                                <td colspan="4" class="py-3 px-4 border-b border-gray-200 text-center text-gray-500">У
                                    вас нет предстоящих записей</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Добавляем обработчик для кнопок отмены записи мастером
        const cancelButtons = document.querySelectorAll('.cancel-button');

        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const recordId = this.getAttribute('data-record-id');

                // Показываем модальное окно подтверждения
                if (confirm(
                        'Вы уверены, что хотите отменить эту запись? Клиент получит уведомление об отмене.'
                    )) {
                    // Создаем форму для отправки запроса на отмену
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('record.cancel-by-master') }}';

                    // Добавляем CSRF токен
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    // Добавляем ID записи
                    const recordIdInput = document.createElement('input');
                    recordIdInput.type = 'hidden';
                    recordIdInput.name = 'id';
                    recordIdInput.value = recordId;
                    form.appendChild(recordIdInput);

                    // Добавляем форму в DOM и отправляем
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>
