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
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex flex-wrap gap-4 items-end">
                        @auth
                            <!-- Мастер -->
                            <div class="w-full sm:w-auto">
                                <label for="master-select-{{ $service->id }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">Мастер</label>
                                <select id="master-select-{{ $service->id }}"
                                    class="master-select bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                    required>
                                    <option value="">Выберите мастера</option>
                                    @foreach ($service->masters as $item)
                                        <option value="{{ $item->id }}">{{ $item->surname }} {{ $item->name }}
                                            {{ $item->fathername }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Календарь -->
                            <div class="w-full sm:w-auto">
                                <label for="date-select-{{ $service->id }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">Дата</label>
                                <select id="date-select-{{ $service->id }}"
                                    class="date-select bg-cream border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                    required>
                                    <option value="">Выберите дату</option>
                                    @for ($i = 1; $i <= 14; $i++)
                                        <?php
                                        $date = date('Y-m-d', strtotime("+$i day"));
                                        $formattedDate = date('d.m.Y', strtotime("+$i day"));
                                        $dayOfWeek = date('l', strtotime("+$i day"));
                                        $dayOfWeekRu = [
                                            'Monday' => 'Понедельник',
                                            'Tuesday' => 'Вторник',
                                            'Wednesday' => 'Среда',
                                            'Thursday' => 'Четверг',
                                            'Friday' => 'Пятница',
                                            'Saturday' => 'Суббота',
                                            'Sunday' => 'Воскресенье',
                                        ][$dayOfWeek];
                                        ?>
                                        <option value="{{ $date }}">{{ $formattedDate }} ({{ $dayOfWeekRu }})
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Кнопка выбора времени -->
                            @if (count($service->masters) > 0)
                                <button type="button" id="show-time-btn-{{ $service->id }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve"
                                    data-modal-target="time-modal-{{ $service->id }}"
                                    data-modal-toggle="time-modal-{{ $service->id }}" disabled>
                                    Выбрать время
                                </button>
                            @else
                                <button type="button" disabled
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 cursor-not-allowed">
                                    Выбрать время
                                </button>
                            @endif
                        @else
                            <!-- Очень компактное сообщение -->
                            <div
                                class="flex items-center justify-between p-3 bg-cream/50 border border-mauve/20 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user-lock text-mauve"></i>
                                    <span class="text-sm text-gray-700">Требуется авторизация</span>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Модальное окно выбора времени -->
            <div id="time-modal-{{ $service->id }}" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Содержимое модального окна -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Заголовок модального окна -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Выбор времени
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="time-modal-{{ $service->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Закрыть</span>
                            </button>
                        </div>

                        <!-- Тело модального окна -->
                        <div class="p-6 space-y-6">
                            <div id="time-slots-container-{{ $service->id }}" class="time-slots-container">
                                <div class="text-center py-8">
                                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-mauve mx-auto">
                                    </div>
                                    <p class="mt-4 text-gray-700">Загрузка доступного времени...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Форма для отправки данных -->
            <form id="booking-form-{{ $service->id }}" action="{{ route('records.upload') }}" method="post"
                class="hidden">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <input type="hidden" name="master_id" id="form-master-id-{{ $service->id }}">
                <input type="hidden" name="date" id="form-date-{{ $service->id }}">
                <input type="hidden" name="hour" id="form-hour-{{ $service->id }}">
                <input type="hidden" name="minute" id="form-minute-{{ $service->id }}">
            </form>
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
    document.addEventListener("DOMContentLoaded", () => {
        console.log("Appointment script loaded")

        // Фиксированные слоты для записи
        const FIXED_SLOTS = [{
                hour: 9,
                minute: 0
            },
            {
                hour: 11,
                minute: 30
            },
            {
                hour: 15,
                minute: 0
            },
            {
                hour: 17,
                minute: 30
            }
        ];

        // Обеденный перерыв
        const LUNCH_BREAK_START = 14 // 2 PM
        const LUNCH_BREAK_END = 15 // 3 PM
        const APPOINTMENT_DURATION = 150 // 2 часа 30 минут в минутах

        // Кэш для временных слотов
        const timeSlotCache = {}

        // Обработка выбора мастера
        document.querySelectorAll(".master-select").forEach((select) => {
            select.addEventListener("change", function() {
                const serviceId = this.id.replace("master-select-", "")
                const dateSelect = document.getElementById(`date-select-${serviceId}`)
                const showTimeBtn = document.getElementById(`show-time-btn-${serviceId}`)

                // Сбросить выбор даты
                dateSelect.value = ""
                showTimeBtn.disabled = true

                // Сохранить ID мастера в форме
                document.getElementById(`form-master-id-${serviceId}`).value = this.value
            })
        })

        // Обработка выбора даты
        document.querySelectorAll(".date-select").forEach((select) => {
            select.addEventListener("change", function() {
                const serviceId = this.id.replace("date-select-", "")
                const masterSelect = document.getElementById(`master-select-${serviceId}`)
                const showTimeBtn = document.getElementById(`show-time-btn-${serviceId}`)

                if (!masterSelect.value) {
                    alert("Пожалуйста, сначала выберите мастера")
                    this.value = ""
                    return
                }

                // Активировать кнопку выбора времени
                showTimeBtn.disabled = !this.value

                // Сохранить дату в форме в формате m/d/Y
                if (this.value) {
                    // Преобразуем дату из формата YYYY-MM-DD в формат MM/DD/YYYY
                    const dateParts = this.value.split("-")
                    const formattedDate = `${dateParts[1]}/${dateParts[2]}/${dateParts[0]}`
                    document.getElementById(`form-date-${serviceId}`).value = formattedDate
                    console.log("Formatted date for form:", formattedDate)
                }
            })
        })

        // Обработка нажатия на кнопку выбора времени
        document.querySelectorAll("[id^='show-time-btn-']").forEach((button) => {
            button.addEventListener("click", function() {
                const serviceId = this.id.replace("show-time-btn-", "")
                const masterSelect = document.getElementById(`master-select-${serviceId}`)
                const dateSelect = document.getElementById(`date-select-${serviceId}`)

                if (!masterSelect.value || !dateSelect.value) {
                    alert("Пожалуйста, выберите мастера и дату")
                    return
                }

                // Загрузить временные слоты
                loadTimeSlots(serviceId, masterSelect.value, dateSelect.value)
            })
        })

        // Функция загрузки временных слотов
        function loadTimeSlots(serviceId, masterId, date) {
            const container = document.getElementById(`time-slots-container-${serviceId}`)
            const cacheKey = `${serviceId}-${masterId}-${date}`

            // Показать загрузку
            container.innerHTML = `
            <div class="text-center py-8">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-mauve mx-auto"></div>
                <p class="mt-4 text-gray-700">Загрузка доступного времени...</p>
            </div>
        `

            // Проверить кэш
            if (timeSlotCache[cacheKey]) {
                renderTimeSlots(serviceId, timeSlotCache[cacheKey])
                return
            }

            // Получить CSRF-токен
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content")
            if (!csrfToken) {
                container.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
                    <p class="text-lg text-red-500">Ошибка: CSRF-токен не найден</p>
                </div>
            `
                return
            }

            // Запрос на сервер для получения доступных временных слотов
            fetch("/get-available-time-slots", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        service_id: serviceId,
                        master_id: masterId,
                        date: date,
                    }),
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`)
                    }
                    return response.json()
                })
                .then((data) => {
                    console.log("Available time slots:", data)

                    if (data.success) {
                        // Кэшировать результат
                        timeSlotCache[cacheKey] = data.slots
                        // Отрисовать временные слоты
                        renderTimeSlots(serviceId, data.slots)
                    } else {
                        container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
                        <p class="text-lg text-red-500">Ошибка: ${data.message || "Не удалось загрузить доступное время"}</p>
                    </div>
                `
                    }
                })
                .catch((error) => {
                    console.error("Error fetching available time slots:", error)
                    container.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
                    <p class="text-lg text-red-500">Ошибка: ${error.message}</p>
                </div>
            `
                })
        }

        // Функция отрисовки временных слотов
        function renderTimeSlots(serviceId, slots) {
            const container = document.getElementById(`time-slots-container-${serviceId}`)

            if (slots.length === 0) {
                container.innerHTML = `
                <div class="text-center py-8">
                    <i class="fas fa-calendar-times text-gray-400 text-5xl mb-4"></i>
                    <p class="text-lg text-gray-700">На выбранную дату нет доступного времени.</p>
                </div>
            `
                return
            }

            let html = `
            <h3 class="text-lg font-medium text-gray-900 mb-4">Доступное время:</h3>
            <p class="text-sm text-gray-500 mb-4">Продолжительность записи: 2 часа 30 минут.</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        `

            slots.forEach((slot) => {
                html += `
                <div class="time-slot">
                    <button type="button"
                        class="w-full p-3 text-gray-700 bg-cream border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 time-slot-btn"
                        data-hour="${slot.hour}"
                        data-minute="${slot.minute}"
                        data-service-id="${serviceId}">
                        ${slot.formatted}
                    </button>
                </div>
            `
            })

            html += `
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" id="confirm-time-btn-${serviceId}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 cursor-not-allowed"
                    disabled>
                    Записаться
                </button>
            </div>
        `

            container.innerHTML = html

            // Добавить обработчики для кнопок времени
            container.querySelectorAll(".time-slot-btn").forEach((btn) => {
                btn.addEventListener("click", function() {
                    // Убрать выделение со всех кнопок
                    container.querySelectorAll(".time-slot-btn").forEach((b) => {
                        b.classList.remove("bg-mauve", "text-white")
                        b.classList.add("bg-cream", "text-gray-700")
                    })

                    // Выделить выбранную кнопку
                    this.classList.remove("bg-cream", "text-gray-700")
                    this.classList.add("bg-mauve", "text-white")

                    // Активировать кнопку подтверждения
                    const confirmBtn = document.getElementById(`confirm-time-btn-${serviceId}`)
                    confirmBtn.disabled = false
                    confirmBtn.classList.remove("bg-gray-400", "cursor-not-allowed")
                    confirmBtn.classList.add("bg-mauve", "hover:bg-blush")

                    // Сохранить выбранное время в форме
                    document.getElementById(`form-hour-${serviceId}`).value = this.dataset.hour
                    document.getElementById(`form-minute-${serviceId}`).value = this.dataset
                        .minute
                })
            })

            // Добавить обработчик для кнопки подтверждения
            const confirmBtn = document.getElementById(`confirm-time-btn-${serviceId}`)
            if (confirmBtn) {
                confirmBtn.addEventListener("click", function() {
                    if (this.disabled) return

                    // Отправить форму
                    document.getElementById(`booking-form-${serviceId}`).submit()
                })
            }
        }
    })
</script>
