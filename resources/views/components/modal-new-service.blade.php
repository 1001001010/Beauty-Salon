<button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve mt-4">
    Добавить
</button>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow overflow-hidden">
            <!-- Modal header -->
            <div class="px-4 py-5 sm:px-6 flex items-center justify-between border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Добавление услуги
                </h3>
                <button type="button"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-mauve focus:ring-offset-2 rounded-md"
                    data-modal-toggle="crud-modal">
                    <span class="sr-only">Закрыть</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form class="p-6" method="POST" action="{{ route('service.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Название</label>
                        <div class="mt-1">
                            <input type="text" name="name" id="name"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="Название услуги" required>
                        </div>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Цена от</label>
                        <div class="mt-1">
                            <input type="number" name="price" id="price"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="₽" required min="1">
                        </div>
                    </div>

                    <div>
                        <label for="service-dropzone-file" class="block text-sm font-medium text-gray-700 mb-2">Загрузка
                            фото</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="service-dropzone-file"
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
                                <input id="service-dropzone-file" name="photo" type="file" class="hidden"
                                    accept="image/*" />
                            </label>
                        </div>
                        <div id="service-file-preview" class="mt-2 hidden">
                            <div class="flex items-center p-2 bg-cream rounded-md">
                                <img id="service-preview-image" class="h-16 w-16 object-cover rounded-md"
                                    src="/placeholder.svg" alt="Предпросмотр">
                                <div class="ml-3 flex-grow">
                                    <p class="text-sm font-medium text-gray-900" id="service-file-name"></p>
                                    <p class="text-xs text-gray-500" id="service-file-size"></p>
                                </div>
                                <button type="button" id="service-remove-file"
                                    class="text-gray-400 hover:text-red-500">
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
                        <label for="description" class="block text-sm font-medium text-gray-700">Описание</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="4"
                                class="bg-cream border border-gray-300 text-gray-900 text-sm rounded-md shadow-sm focus:ring-mauve focus:border-mauve block w-full p-2.5"
                                placeholder="Описание услуги"></textarea>
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
                        data-modal-toggle="crud-modal">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка загрузки файла для услуги
        const serviceDropzoneFile = document.getElementById('service-dropzone-file');
        const serviceFilePreview = document.getElementById('service-file-preview');
        const servicePreviewImage = document.getElementById('service-preview-image');
        const serviceFileName = document.getElementById('service-file-name');
        const serviceFileSize = document.getElementById('service-file-size');
        const serviceRemoveFile = document.getElementById('service-remove-file');

        if (serviceDropzoneFile) {
            serviceDropzoneFile.addEventListener('change', function(e) {
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
                        servicePreviewImage.src = e.target.result;
                        serviceFileName.textContent = file.name;
                        serviceFileSize.textContent = formatFileSize(file.size);
                        serviceFilePreview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            });
        }

        if (serviceRemoveFile) {
            serviceRemoveFile.addEventListener('click', function() {
                serviceDropzoneFile.value = '';
                serviceFilePreview.classList.add('hidden');
            });
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }
    });
</script>
