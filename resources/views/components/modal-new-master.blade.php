<button type="button" data-modal-target="crud-modal-master" data-modal-toggle="crud-modal-master"
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve mt-4">
    Добавить мастера
</button>

<!-- Main modal -->
<div id="crud-modal-master" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
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
                    Добавление мастера
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal-master">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="master-form" class="p-6 md:p-7" method="POST" action="{{ route('master.upload') }}"
                enctype="multipart/form-data">
                @csrf

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <!-- Левая колонка -->
                    <div class="md:col-span-1 space-y-6">
                        <!-- Поиск существующего пользователя -->
                        <div>
                            <label for="user-search"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Поиск
                                пользователя</label>
                            <div class="relative">
                                <input type="text" id="user-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                    placeholder="Введите email или имя пользователя">
                                <input type="hidden" id="selected-user-id" name="user_id">

                                <!-- Результаты поиска -->
                                <div id="search-results"
                                    class="absolute z-10 w-full mt-1 bg-white shadow-lg rounded-md overflow-hidden hidden dark:bg-zinc-900 dark:border dark:border-gray-700">
                                    <ul class="max-h-60 overflow-auto py-1 text-base" id="search-results-list">
                                        <!-- Результаты будут добавлены через JavaScript -->
                                    </ul>
                                    <div id="no-results"
                                        class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400 hidden">
                                        Пользователи не найдены
                                    </div>
                                    <div id="loading-results"
                                        class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400 hidden">
                                        Поиск...
                                    </div>
                                </div>
                            </div>
                            <div id="selected-user-info"
                                class="mt-2 p-3 bg-gray-50 rounded-md hidden dark:bg-black dark:border dark:border-gray-700">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-cream flex items-center justify-center dark:bg-gray-800">
                                        <i class="fas fa-user text-mauve"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white"
                                            id="selected-user-name"></p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400" id="selected-user-email">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Информация о мастере -->
                        <div>
                            <label for="surname"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                            <input type="text" name="surname" id="surname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Фамилия" required>
                        </div>

                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Имя" required>
                        </div>

                        <div>
                            <label for="fathername"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                            <input type="text" name="fathername" id="fathername"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Отчество" required>
                        </div>
                    </div>

                    <!-- Правая колонка -->
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label for="dropzone-file"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Загрузка
                                фото</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-800 dark:bg-black dark:border-gray-600 dark:hover:border-gray-500">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Нажмите для
                                                загрузки</span> или перетащите файл</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG или GIF (макс.
                                            2MB)</p>
                                    </div>
                                    <input id="dropzone-file" name="photo" type="file" class="hidden"
                                        accept="image/*" />
                                </label>
                            </div>
                            <div id="file-preview" class="mt-2 hidden">
                                <div
                                    class="flex items-center p-2 bg-gray-50 rounded-md dark:bg-black dark:border dark:border-gray-700">
                                    <img id="preview-image" class="h-16 w-16 object-cover rounded-md"
                                        src="/placeholder.svg" alt="Предпросмотр">
                                    <div class="ml-3 flex-grow">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white" id="file-name">
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400" id="file-size"></p>
                                    </div>
                                    <button type="button" id="remove-file" class="text-gray-400 hover:text-red-500">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Услуги мастера - улучшенный интерфейс -->
                <div class="mb-6">
                    <label class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">Услуги мастера</label>
                    <div class="bg-gray-50 dark:bg-black border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                        <div class="mb-3">
                            <input type="text" id="service-search"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-zinc-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Поиск услуг...">
                        </div>

                        <div class="max-h-60 overflow-y-auto pr-2 service-list-container">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @if ($services && count($services) > 0)
                                    @foreach ($services as $item)
                                        <div
                                            class="service-item flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-800 border dark:border-gray-700">
                                            <input id="service-{{ $item->id }}" type="checkbox"
                                                value="{{ $item->id }}" name='services[]'
                                                class="w-4 h-4 text-mauve bg-gray-100 border-gray-300 rounded focus:ring-mauve dark:focus:ring-mauve dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="service-{{ $item->id }}"
                                                class="w-full ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer flex items-center">
                                                @if (isset($item->photo))
                                                    <img src="{{ asset('storage/' . $item->photo) }}"
                                                        alt="{{ $item->name }}"
                                                        class="h-8 w-8 rounded-full object-cover mr-2">
                                                @endif
                                                <span>{{ $item->name }}</span>
                                                <span class="ml-auto text-xs text-gray-500">{{ $item->price ?? '' }}
                                                    @if (isset($item->price))
                                                        ₽
                                                    @endif
                                                </span>
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
                                Выбрано: <span id="selected-count">0</span> из
                                {{ count($services ?? []) }}
                            </div>
                            <div>
                                <button type="button" id="select-all"
                                    class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-1 px-2 rounded dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                                    Выбрать все
                                </button>
                                <button type="button" id="deselect-all"
                                    class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-1 px-2 rounded dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200">
                                    Снять все
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-600">
                    <button type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-black dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-toggle="crud-modal-master">
                        Отмена
                    </button>
                    <button type="submit"
                        class="text-white bg-mauve hover:bg-mauve/90 focus:ring-4 focus:outline-none focus:ring-mauve font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-mauve dark:hover:bg-mauve/80 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Добавить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Элементы DOM
        const userSearchInput = document.getElementById('user-search');
        const searchResults = document.getElementById('search-results');
        const searchResultsList = document.getElementById('search-results-list');
        const noResults = document.getElementById('no-results');
        const loadingResults = document.getElementById('loading-results');
        const selectedUserId = document.getElementById('selected-user-id');
        const selectedUserInfo = document.getElementById('selected-user-info');
        const selectedUserName = document.getElementById('selected-user-name');
        const selectedUserEmail = document.getElementById('selected-user-email');

        // Обработка загрузки файла
        const dropzoneFile = document.getElementById('dropzone-file');
        const filePreview = document.getElementById('file-preview');
        const previewImage = document.getElementById('preview-image');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const removeFile = document.getElementById('remove-file');

        if (dropzoneFile) {
            dropzoneFile.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    // Проверка типа файла
                    if (!file.type.match('image.*')) {
                        alert('Пожалуйста, выберите изображение');
                        return;
                    }

                    // Проверка размера файла (макс. 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Размер файла не должен превышать 2MB');
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        filePreview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            });
        }

        if (removeFile) {
            removeFile.addEventListener('click', function() {
                dropzoneFile.value = '';
                filePreview.classList.add('hidden');
            });
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }

        // Обработка поиска пользователей
        let searchTimeout;

        if (userSearchInput) {
            userSearchInput.addEventListener('focus', function() {
                if (userSearchInput.value.trim().length > 0) {
                    searchResults.classList.remove('hidden');
                }
            });

            userSearchInput.addEventListener('input', function() {
                const query = this.value.trim();

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }

                searchResults.classList.remove('hidden');
                searchResultsList.innerHTML = '';
                noResults.classList.add('hidden');
                loadingResults.classList.remove('hidden');

                searchTimeout = setTimeout(() => {
                    fetchUsers(query);
                }, 300);
            });
        }

        // Закрытие результатов поиска при клике вне
        document.addEventListener('click', function(event) {
            if (searchResults && userSearchInput && !userSearchInput.contains(event.target) && !
                searchResults.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });

        // Функция для получения пользователей через
        function fetchUsers(query) {
            fetch(`/api/users/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    loadingResults.classList.add('hidden');
                    searchResultsList.innerHTML = '';

                    if (data.length === 0) {
                        noResults.classList.remove('hidden');
                        return;
                    }

                    data.forEach(user => {
                        const li = document.createElement('li');
                        li.className =
                            'cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-800 px-4 py-2';
                        li.innerHTML = `
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-cream flex items-center justify-center dark:bg-gray-800">
                                <i class="fas fa-user text-mauve"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">${user.name || 'Без имени'}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">${user.email}</p>
                            </div>
                        </div>
                    `;

                        li.addEventListener('click', function() {
                            selectUser(user);
                        });

                        searchResultsList.appendChild(li);
                    });
                })
                .catch(error => {
                    console.error('Ошибка при поиске пользователей:', error);
                    loadingResults.classList.add('hidden');
                    noResults.classList.remove('hidden');
                    noResults.textContent = 'Ошибка при поиске пользователей';
                });
        }

        // Функция выбора пользователя
        function selectUser(user) {
            selectedUserId.value = user.id;
            userSearchInput.value = user.email;
            searchResults.classList.add('hidden');

            // Показываем информацию о выбранном пользователе
            selectedUserInfo.classList.remove('hidden');
            selectedUserName.textContent = user.name || 'Без имени';
            selectedUserEmail.textContent = user.email;

            // Если у пользователя уже есть данные мастера, заполняем форму
            if (user.master) {
                document.getElementById('surname').value = user.master.surname || '';
                document.getElementById('name').value = user.master.name || '';
                document.getElementById('fathername').value = user.master.fathername || '';

                // Отмечаем услуги, если они есть
                if (user.master.services && user.master.services.length > 0) {
                    user.master.services.forEach(serviceId => {
                        const checkbox = document.getElementById(`service-${serviceId}`);
                        if (checkbox) checkbox.checked = true;
                    });
                }

                // Обновляем счетчик выбранных услуг
                updateSelectedCount();
            }
        }

        // Функциональность поиска услуг
        const serviceSearchInput = document.getElementById('service-search');
        const serviceItems = document.querySelectorAll('.service-item');

        if (serviceSearchInput) {
            serviceSearchInput.addEventListener('input', function() {
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
        const selectAllBtn = document.getElementById('select-all');
        const deselectAllBtn = document.getElementById('deselect-all');
        const checkboxes = document.querySelectorAll('input[name="services[]"]');
        const selectedCountEl = document.getElementById('selected-count');

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
