@extends('layouts.app')
@section('title')
    {{ config('app.APP_NAME') }} - Профиль
@endsection

@section('content')
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">Профиль</h1>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 py-8 sm:px-0">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Информация профиля</h3>
                            </div>
                            <a href="{{ route('profile.edit') }}">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                    Редактировать
                                </button>
                            </a>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="bg-cream px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dl class="sm:col-span-2 grid sm:grid-cols-2 gap-x-4 gap-y-8">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Имя</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Почта</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Номер телефона</dt>
                                        <dd class="mt-1 text-sm text-gray-900" id="masked-phone">{{ $user->phone }}</dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Дата регистрации</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y') }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Предстоящие записи</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Ваши запланированные косметические процедуры</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <ul role="list" class="divide-y divide-gray-200">
                                @forelse($upcomingRecords as $record)
                                    <li>
                                        <div class="px-4 py-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center">
                                                        <img src="{{ asset('storage/' . $record->service->photo) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $record->service->name }}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y в H:i') }}
                                                            @if (isset($record->master))
                                                                • Мастер: {{ $record->master->surname }}
                                                                {{ $record->master->name }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                        Перепланировать
                                                    </button>
                                                    <form action="{{ route('records.delete') }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input name="id" class="hidden" value="{{ $record->id }}">
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                            Отменить
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="px-4 py-8 sm:px-6 text-center">
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="flex-shrink-0 h-16 w-16 rounded-full bg-cream flex items-center justify-center mb-3">
                                                    <i class="fas fa-calendar-alt text-mauve text-xl"></i>
                                                </div>
                                                <p class="text-sm text-gray-500">У вас нет предстоящих записей</p>
                                                <a href="{{ route('service.index') }}"
                                                    class="mt-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                                    Записаться на услугу
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">История записей</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Ваши прошедшие процедуры</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <ul role="list" class="divide-y divide-gray-200">
                                @forelse($pastRecords as $record)
                                    <li>
                                        <div
                                            class="px-4 py-4 sm:px-6 @if ($record->service->trashed()) bg-gray-50 opacity-75 @endif">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center">
                                                        @if ($record->service->photo && !$record->service->trashed())
                                                            <img src="{{ asset('storage/' . $record->service->photo) }}"
                                                                alt="">
                                                        @else
                                                            <i class="fas fa-calendar-times text-gray-400"></i>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $record->service->name ?? 'Услуга удалена' }}
                                                            @if ($record->service->trashed())
                                                                <span class="text-xs text-red-500">(Услуга удалена)</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-sm text-gray-500">
                                                            {{ \Carbon\Carbon::parse($record->datetime)->format('d.m.Y в H:i') }}
                                                            @if (isset($record->master))
                                                                • Мастер: {{ $record->master->surname }}
                                                                {{ $record->master->name }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                                @if (!$record->feedback && !$record->service->trashed())
                                                    <div>
                                                        @include('components.modal-new-feedback', [
                                                            'item' => $record,
                                                        ])
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <!-- Пустой список -->
                                @endforelse
                            </ul>
                        </div>
                        @if (count($pastRecords) > 3)
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                    Просмотреть полную историю
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Применяем маску на телефонный номер в поле с id "masked-phone"
            var phoneInput = document.getElementById('masked-phone');

            if (phoneInput) {
                var im = new Inputmask("+7 (999) 999-99-99", {
                    clearMaskOnLostFocus: false
                });
                im.mask(phoneInput);
            }
        });
    </script>
@endsection
