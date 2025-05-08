<x-primary-button data-modal-target="delete-modal-master-{{ $master->id }}"
    data-modal-toggle="delete-modal-master-{{ $master->id }}"
    class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
    Удалить
</x-primary-button>

<!-- Форма удаление мастера -->
<div id="delete-modal-master-{{ $master->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div
            class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-red-50 dark:bg-red-900/20">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-600 dark:text-red-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                    </svg>
                    Удаление мастера
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="delete-modal-master-{{ $master->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-6 flex items-center">
                    <div class="mr-4 flex-shrink-0">
                        @if ($master->photo)
                            <img src="{{ asset('storage/' . $master->photo) }}" alt="{{ $master->name }}"
                                class="h-16 w-16 rounded-full object-cover">
                        @else
                            <div
                                class="h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $master->surname }}
                            {{ $master->name }} {{ $master->fathername }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            @if ($master->services->count() > 0)
                                {{ $master->services->count() }} услуг
                            @else
                                Нет услуг
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-900/20 dark:text-red-400"
                        role="alert">
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="font-medium">Внимание!</span>
                        </div>
                        <div class="mt-1.5">Вы уверены, что хотите удалить мастера <br><b>"{{ $master->surname }}
                                {{ $master->name }} {{ $master->fathername }}"</b>?</div>
                    </div>
                </div>

                <form method="post" action={{ route('master.delete') }}>
                    @csrf
                    @method('delete')
                    <input name="id" class="hidden" id="id" type="text" value="{{ $master->id }}">
                    <div class="flex justify-end gap-3">
                        <button type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-black dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            data-modal-toggle="delete-modal-master-{{ $master->id }}">
                            Отмена
                        </button>
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                            Удалить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
