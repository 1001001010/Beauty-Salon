<button type="button" data-modal-target="crud-modal-master" data-modal-toggle="crud-modal-master"
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve mt-4">
    Добавить мастера
</button>

<!-- Main modal -->
<div id="crud-modal-master" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow overflow-hidden">
            <!-- Modal header -->
            <div class="px-4 py-5 sm:px-6 flex items-center justify-between border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Добавление мастера
                </h3>
                <button type="button"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-mauve focus:ring-offset-2 rounded-md"
                    data-modal-toggle="crud-modal-master">
                    <span class="sr-only">Закрыть</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form id="master-form" class="p-6" method="POST" action="{{ route('master.upload') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Поиск существующего пользователя -->
                <div class="mb-6">
                    <label for="user-search" class="block text-sm font-medium text-gray-700">Поиск пользователя</label>
                    <div class="mt-1 relative">
                        <input type="text" id="user-search"
                            class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                            placeholder="Введите email или имя пользователя">
                        <input type="hidden" id="selected-user-id" name="user_id">

                        <!-- Результаты поиска -->
                        <div id="search-results"
                            class="absolute z-10 w-full mt-1 bg-white shadow-lg rounded-md overflow-hidden hidden">
                            <ul class="max-h-60 overflow-auto py-1 text-base" id="search-results-list">
                                <!-- Результаты будут добавлены через JavaScript -->
                            </ul>
                            <div id="no-results" class="px-4 py-2 text-sm text-gray-500 hidden">
                                Пользователи не найдены
                            </div>
                            <div id="loading-results" class="px-4 py-2 text-sm text-gray-500 hidden">
                                Поиск...
                            </div>
                        </div>
                    </div>
                    <div id="selected-user-info" class="mt-2 p-3 bg-cream rounded-md hidden">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-white flex items-center justify-center">
                                <i class="fas fa-user text-mauve"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900" id="selected-user-name"></p>
                                <p class="text-sm text-gray-500" id="selected-user-email"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Информация о мастере -->
                <div class="space-y-6">
                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-700">Фамилия</label>
                        <div class="mt-1">
                            <input type="text" name="surname" id="surname"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="Фамилия" required>
                        </div>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="Имя" required>
                        </div>
                    </div>

                    <div>
                        <label for="fathername" class="block text-sm font-medium text-gray-700">Отчество</label>
                        <div class="mt-1">
                            <input type="text" name="fathername" id="fathername"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="Отчество" required>
                        </div>
                    </div>

                    <div>
                        <label for="dropzone-file" class="block text-sm font-medium text-gray-700 mb-2">Загрузка
                            фото</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-cream hover:bg-cream/80 dark:hover:bg-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-mauve" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-700"><span class="font-semibold">Нажмите для
                                            загрузки</span> или перетащите файл</p>
                                    <p class="text-xs text-gray-500">JPG, PNG или GIF (макс. 2MB)</p>
                                </div>
                                <input id="dropzone-file" name="photo" type="file" class="hidden"
                                    accept="image/*" />
                            </label>
                        </div>
                        <div id="file-preview" class="mt-2 hidden">
                            <div class="flex items-center p-2 bg-cream rounded-md">
                                <img id="preview-image" class="h-16 w-16 object-cover rounded-md"
                                    src="/placeholder.svg" alt="Предпросмотр">
                                <div class="ml-3 flex-grow">
                                    <p class="text-sm font-medium text-gray-900" id="file-name"></p>
                                    <p class="text-xs text-gray-500" id="file-size"></p>
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

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Выполняет услуги:</label>
                        <div class="bg-cream border border-gray-200 rounded-md overflow-hidden">
                            @if (count($services) > 0)
                                <ul class="divide-y divide-gray-200">
                                    @foreach ($services as $item)
                                        <li class="p-2 hover:bg-cream/70">
                                            <div class="flex items-center">
                                                <input id="service-{{ $item->id }}" type="checkbox"
                                                    value="{{ $item->id }}" name="services[]"
                                                    class="w-4 h-4 text-mauve bg-white border-gray-300 rounded focus:ring-mauve">
                                                <label for="service-{{ $item->id }}"
                                                    class="w-full py-2 ms-2 text-sm font-medium text-gray-900">
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="p-4 text-sm text-gray-500">
                                    Нет доступных услуг
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6 sm:mt-8 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
                        Добавить
                    </button>
                    <button type="button"
                        class="mt-3 sm:mt-0 sm:mr-3 inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve"
                        data-modal-toggle="crud-modal-master">
                        Отмена
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
                        li.className = 'cursor-pointer hover:bg-cream px-4 py-2';
                        li.innerHTML = `
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8 rounded-full bg-cream flex items-center justify-center">
                                <i class="fas fa-user text-mauve"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">${user.name || 'Без имени'}</p>
                                <p class="text-sm text-gray-500">${user.email}</p>
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
            }
        }
    });
</script>
