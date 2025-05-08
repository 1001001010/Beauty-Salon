<x-primary-button data-modal-target="crud-modal-master-{{ $master->id }}"
    data-modal-toggle="crud-modal-master-{{ $master->id }}">
    Редактировать
</x-primary-button>

<!-- Main modal -->
<div id="crud-modal-master-{{ $master->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div
            class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-cream">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-mauve" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Редактирование мастера
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal-master-{{ $master->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-6 md:p-7" method="post" action={{ route('master.update') }} enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label for="surname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                            <input type="text" name="surname" id="surname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Фамилия" value="{{ $master->surname }}" required>
                        </div>
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Имя" required value="{{ $master->name }}">
                        </div>
                        <div>
                            <label for="fathername"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                            <input type="text" name="fathername" id="fathername"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Отчество" value="{{ $master->fathername }}" required>
                        </div>
                    </div>
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текущее
                                фото</label>
                            <div
                                class="relative h-48 w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                @if ($master->photo)
                                    <img src="{{ asset('storage/' . $master->photo) }}" alt="{{ $master->name }}"
                                        class="h-full w-full object-cover object-center">
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="master_file_input">Загрузить новое фото</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="master_file_input"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-black hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Нажмите для загрузки</span> или перетащите файл
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (MAX. 2MB)</p>
                                    </div>
                                    <input id="master_file_input" name="photo" type="file" class="hidden"
                                        accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Услуги мастера - улучшенный интерфейс -->
                <div class="mb-6">
                    <label class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">Услуги мастера</label>
                    <div class="bg-gray-50 dark:bg-black border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                        <div class="mb-3">
                            <input type="text" id="service-search-{{ $master->id }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-zinc-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Поиск услуг...">
                        </div>

                        <div class="max-h-60 overflow-y-auto pr-2 service-list-container">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @if ($services && count($services) > 0)
                                    @foreach ($services as $item)
                                        <div
                                            class="service-item flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-800 border">
                                            <input id="service-{{ $master->id }}-{{ $item->id }}"
                                                type="checkbox" value="{{ $item->id }}" name='services[]'
                                                class="w-4 h-4 text-mauve bg-gray-100 border-gray-300 rounded focus:ring-mauve dark:focus:ring-mauve dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                {{ in_array($item->id, $masterServiceIds) ? 'checked' : '' }}>
                                            <label for="service-{{ $master->id }}-{{ $item->id }}"
                                                class="w-full ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer flex items-center">
                                                @if ($item->photo)
                                                    <img src="{{ asset('storage/' . $item->photo) }}"
                                                        alt="{{ $item->name }}"
                                                        class="h-8 w-8 rounded-full object-cover mr-2">
                                                @endif
                                                <span>{{ $item->name }}</span>
                                                <span class="ml-auto text-xs text-gray-500">{{ $item->price }}
                                                    ₽</span>
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-span-2 text-center py-4 text-gray-500 dark:text-gray-400">
                                        Нет доступных услуг
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Выбрано: <span
                                    id="selected-count-{{ $master->id }}">{{ count($masterServiceIds) }}</span> из
                                {{ count($services) }}
                            </div>
                            <div>
                                <button type="button" id="select-all-{{ $master->id }}"
                                    class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-1 px-2 rounded dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                                    Выбрать все
                                </button>
                                <button type="button" id="deselect-all-{{ $master->id }}"
                                    class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-1 px-2 rounded dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                                    Снять все
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <input name="id" class="hidden" id="id" type="text" value="{{ $master->id }}">
                <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-600">
                    <button type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-black dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-toggle="crud-modal-master-{{ $master->id }}">
                        Отмена
                    </button>
                    <x-primary-button class="bg-mauve hover:bg-blush focus:ring-mauve">
                        Сохранить изменения
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript для функциональности поиска услуг и выбора всех/снятия всех -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Функциональность поиска услуг
        const searchInput = document.getElementById('service-search-{{ $master->id }}');
        const serviceItems = document.querySelectorAll('#crud-modal-master-{{ $master->id }} .service-item');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                serviceItems.forEach(item => {
                    const label = item.querySelector('label');
                    const text = label.textContent.toLowerCase();

                    if (text.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Функциональность выбора всех/снятия всех
        const selectAllBtn = document.getElementById('select-all-{{ $master->id }}');
        const deselectAllBtn = document.getElementById('deselect-all-{{ $master->id }}');
        const checkboxes = document.querySelectorAll(
            '#crud-modal-master-{{ $master->id }} input[name="services[]"]');
        const selectedCountEl = document.getElementById('selected-count-{{ $master->id }}');

        function updateSelectedCount() {
            let count = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) count++;
            });
            if (selectedCountEl) selectedCountEl.textContent = count;
        }

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
                updateSelectedCount();
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateSelectedCount();
            });
        }

        // Обновление счетчика при изменении чекбоксов
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Инициализация счетчика
        updateSelectedCount();
    });
</script>
