<x-primary-button data-modal-target="crud-modal-master-{{ $master->id }}"
    data-modal-toggle="crud-modal-master-{{ $master->id }}">
    Редактировать
</x-primary-button>

<!-- Main modal -->
<div id="crud-modal-master-{{ $master->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div
            class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Редактирование
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
            <form class="p-4 md:p-5" method="post" action={{ route('master.update') }} enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="surname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Фамилия</label>
                        <input type="text" name="surname" id="surname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Фамилия" value="{{ $master->surname }}" required>
                    </div>
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Имя" required value="{{ $master->name }}">
                    </div>
                    <div class="col-span-2">
                        <label for="fathername"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Отчество</label>
                        <input type="text" name="fathername" id="fathername"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Отчество" value="{{ $master->fathername }}" required>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Изменить фото</label>
                        <input name="photo"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-black dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file">
                    </div>
                    <ul
                        class="col-span-2 text-sm w-full font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-black dark:border-gray-600 dark:text-white">
                        @if ($services)
                            @foreach ($services as $item)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="{{ $item->id }}" type="checkbox" value="{{ $item->id }}"
                                            name='services[]'
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            {{ in_array($item->id, $masterServiceIds) ? 'checked' : '' }}>
                                        <label for="{{ $item->id }}"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>Нет доступных сервисов.</p>
                        @endif
                    </ul>
                </div>
                <input name="id" class="hidden" id="id" type="text" value="{{ $master->id }}">
                <div class="flex justify-end">
                    <x-primary-button>Сохранить</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>