<x-primary-button data-modal-target="crud-modal-service-{{ $service->id }}"
    data-modal-toggle="crud-modal-service-{{ $service->id }}">
    Редактировать
</x-primary-button>

<!-- Main modal -->
<div id="crud-modal-service-{{ $service->id }}" tabindex="-1" aria-hidden="true"
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
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Редактирование услуги
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal-service-{{ $service->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-6 md:p-7" method="post" action={{ route('service.update') }} enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название
                                услуги</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Название услуги" required value="{{ $service->name }}">
                        </div>
                        <div>
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Цена
                                от</label>
                            <div class="relative">
                                <input type="number" name="price" id="price"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 pr-12 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                    placeholder="Цена" value="{{ $service->price }}" required min="1">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400">₽</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                            <textarea id="description" rows="5" name="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-mauve focus:border-mauve dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Описание услуги">{{ $service->description }}</textarea>
                        </div>
                    </div>
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текущее
                                фото</label>
                            <div
                                class="relative h-48 w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                                @if ($service->photo)
                                    <img src="{{ asset('storage/' . $service->photo) }}" alt="{{ $service->name }}"
                                        class="h-full w-full object-cover object-center">
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Загрузить новое фото</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="file_input"
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
                                    <input id="file_input" name="photo" type="file" class="hidden"
                                        accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="id" class="hidden" id="id" type="text" value="{{ $service->id }}">
                <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-600">
                    <button type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-black dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-toggle="crud-modal-service-{{ $service->id }}">
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
