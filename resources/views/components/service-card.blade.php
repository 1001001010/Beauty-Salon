<div class="pt-4 w-full">
    <div
        class="flex w-full items-start max-md:flex-col gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
        <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48" src="{{ asset('storage/' . $service->photo) }}"
            alt="Фото мастера">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $service->name }}
            </h5>
            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">От ₽{{ $service->price }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $service->description }}</p>
            @if ($variant == 'client')
                <form action="{{ route('records.upload') }}" method="post">
                    @csrf
                    <div class="flex flex-start gap-4 max-md:flex-col">
                        <!-- Календарь -->
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker id="datepicker-{{ $service->id }}" type="text" name="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Выберите дату">
                        </div>
                        <!-- Часы -->
                        <div class="max-w-[8rem]">
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="time-{{ $service->id }}" name="time"
                                    onchange="validateTime(this)"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="08:00" max="21:00" value="08:00" required />
                            </div>
                        </div>
                        <!-- Кнопка выбора мастера -->
                        <button id="dropdownRadioButton-{{ $service->id }}"
                            data-dropdown-toggle="dropdownDefaultRadio-{{ $service->id }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 max-sm:justify-center"
                            type="button">Выбрать мастера <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <div id="dropdownDefaultRadio-{{ $service->id }}"
                            class="z-10 hidden w-max divide-y divide-gray-100 rounded-lg shadow bg-gray-800 dark:bg-gray-200 dark:divide-gray-600">
                            <ul class="p-3 space-y-3 text-sm text-white dark:text-gray-800"
                                aria-labelledby="dropdownRadioButton-{{ $service->id }}">
                                @foreach ($service->masters as $item)
                                    @if ($item->visibility == 1)
                                        <li>
                                            <div class="flex items-center">
                                                <input id="default-radio-{{ $item->id }}" type="radio"
                                                    value="{{ $item->id }}" name="master_id"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="default-radio-{{ $item->id }}"
                                                    class="ms-2 flex items-center gap-2 text-sm font-medium text-white dark:text-gray-800">
                                                    <img class="w-10 h-10 rounded"
                                                        src="{{ asset('storage/' . $item->photo) }}" alt="">
                                                    <p>
                                                        {{ $item->surname }}
                                                        {{ $item->name }}
                                                        {{ $item->fathername }}
                                                </label>
                                                </p>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <input class="hidden" value={{ $service->id }} name="service_id" />
                        <!-- Кнопка -->
                        @if (count($service->masters) > 0)
                            <x-primary-button class="max-sm:w-full">Записаться</x-primary-button>
                        @else
                            <x-primary-button class="max-sm:w-full" disabled>Записаться</x-primary-button>
                        @endif
                    </div>
                </form>
            @else
                <div class="flex gap-4 max-sm:flex-col">
                    @component('components.modal-edit-service', [
                        'service' => $service,
                    ])
                    @endcomponent
                    <form action="{{ route('service.destroy') }}" method="post" class="d-none">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <x-primary-button class="max-sm:w-full">Удалить</x-primary-button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
