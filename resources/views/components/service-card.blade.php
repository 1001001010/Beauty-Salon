<?php
$today = date('m/d/Y');
$tomorrow = date('m/d/Y', strtotime('+1 day'));
?>

<div class="mb-4">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex flex-col md:flex-row md:items-center gap-4">
            @if ($service->photo)
                <div class="flex-shrink-0 h-24 w-24 rounded-full overflow-hidden bg-cream">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $service->photo) }}"
                        alt="{{ $service->name }}">
                </div>
            @else
                <div class="flex-shrink-0 h-24 w-24 rounded-full bg-cream flex items-center justify-center">
                    <i class="fas fa-spa text-mauve text-2xl"></i>
                </div>
            @endif
            <div class="flex-grow">
                <h3 class="text-lg font-medium text-gray-900">{{ $service->name }}</h3>
                <p class="mt-1 text-sm font-bold text-gray-700">От ₽{{ $service->price }}</p>
                @if ($service->description)
                    <p class="mt-1 text-sm text-gray-500">{{ $service->description }}</p>
                @endif
            </div>
        </div>

        @if ($variant == 'client')
            <div class="border-t border-gray-200">
                <form action="{{ route('records.upload') }}" method="post" class="px-4 py-5 sm:px-6">
                    @csrf
                    <div class="flex flex-wrap gap-4 items-end">
                        <!-- Календарь -->
                        <div class="w-full sm:w-auto">
                            <label for="datepicker-{{ $service->id }}"
                                class="block text-sm font-medium text-gray-700 mb-1">Дата</label>
                            <div class="relative">
                                <input datepicker id="datepicker-{{ $service->id }}" type="text" name="date"
                                    datepicker-min-date="<?php echo $tomorrow; ?>"
                                    class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full ps-10 p-2.5"
                                    placeholder="Выберите дату" required>
                            </div>
                        </div>

                        <!-- Часы -->
                        <div class="w-full sm:w-auto">
                            <label for="hour-input" class="block text-sm font-medium text-gray-700 mb-1">Время</label>
                            <div class="flex">
                                <input type="text" id="hour-input" name="hour"
                                    class="bg-cream border leading-none border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-mauve focus:border-mauve block w-16 p-2.5"
                                    min="07" max="21" value=08 required />
                                <span
                                    class="inline-flex items-center px-2 bg-gray-200 border-t border-b border-gray-300 text-gray-900 text-sm">:</span>
                                <select id="minute-input" name="minute"
                                    class="bg-cream border leading-none border-gray-300 text-gray-900 text-sm rounded-r-lg focus:ring-mauve focus:border-mauve block w-16 p-2.5">
                                    <option value=00>00</option>
                                    <option value=30>30</option>
                                </select>
                            </div>
                        </div>

                        <!-- Кнопка выбора мастера -->
                        <div class="w-full sm:w-auto">
                            <label for="dropdownRadioButton-{{ $service->id }}"
                                class="block text-sm font-medium text-gray-700 mb-1">Мастер</label>
                            <button id="dropdownRadioButton-{{ $service->id }}"
                                data-dropdown-toggle="dropdownDefaultRadio-{{ $service->id }}"
                                class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve"
                                type="button">
                                Выбрать мастера
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <div id="dropdownDefaultRadio-{{ $service->id }}"
                                class="z-10 hidden w-max divide-y divide-gray-100 rounded-lg shadow bg-white">
                                <ul class="p-3 space-y-3 text-sm text-gray-700"
                                    aria-labelledby="dropdownRadioButton-{{ $service->id }}">
                                    @if (count($service->masters) > 0)
                                        @foreach ($service->masters as $item)
                                            @if ($item->visibility == 1)
                                                <li>
                                                    <div class="flex items-center">
                                                        <input id="default-radio-{{ $item->id }}" type="radio"
                                                            value="{{ $item->id }}" name="master_id"
                                                            class="w-4 h-4 text-mauve bg-gray-100 border-gray-300 focus:ring-mauve">
                                                        <label for="default-radio-{{ $item->id }}"
                                                            class="ms-2 flex items-center gap-2 text-sm font-medium text-gray-900">
                                                            @if ($item->photo)
                                                                <img class="w-10 h-10 rounded-full object-cover"
                                                                    src="{{ asset('storage/' . $item->photo) }}"
                                                                    alt="{{ $item->name }}">
                                                            @else
                                                                <div
                                                                    class="w-10 h-10 rounded-full bg-cream flex items-center justify-center">
                                                                    <i class="fas fa-user text-mauve"></i>
                                                                </div>
                                                            @endif
                                                            {{ $item->surname }}
                                                            {{ $item->name }}
                                                            {{ $item->fathername }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li class="p-2">Мастеров нет</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <input class="hidden" value={{ $service->id }} name="service_id" />

                        <!-- Кнопка записи -->
                        @if (count($service->masters) > 0)
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                                Записаться
                            </button>
                        @else
                            <button type="button" disabled
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 cursor-not-allowed">
                                Записаться
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        @else
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <div class="flex gap-4 flex-wrap">
                    @component('components.modal-edit-service', [
                        'service' => $service,
                    ])
                    @endcomponent
                    <form action="{{ route('service.destroy') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hourInput = document.getElementById('hour-input');
        const minuteInput = document.getElementById('minute-input');
        const timeInput = document.getElementById('time-input');

        // Функция для обновления основного поля ввода времени
        function updateTimeInput() {
            if (timeInput) {
                const hour = hourInput.value.padStart(2, '0');
                const minute = minuteInput.value;
                timeInput.value = `${hour}:${minute}`;
            }
        }

        // Обработчики событий для обновления времени
        if (hourInput && minuteInput) {
            hourInput.addEventListener('input', updateTimeInput);
            minuteInput.addEventListener('change', updateTimeInput);

            // Инициализация значения времени
            updateTimeInput();
        }
    });
</script>
