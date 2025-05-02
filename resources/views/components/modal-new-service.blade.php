<button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal"
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-mauve hover:bg-blush focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve mt-4">
    Добавить
</button>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-50">
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
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="photo" type="file" name="photo" class="hidden" />
                        </label>
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
