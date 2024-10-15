<div class="pt-4 w-full">
    <div
        class="flex max-md:flex-col w-full items-start gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] duration-300 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:focus-visible:ring-[#FF2D20] hover:text-black/70 hover:ring-black/20 dark:hover:text-white/70 dark:hover:ring-zinc-700 transition">
        <img class="object-cover w-full rounded-lg h-96 md:h-auto md:w-48" src={{ asset('storage/' . $master->photo) }}
            alt="">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $master->surname }}
                {{ $master->name }} {{ $master->fathername }}
            </h5>
            <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">Работает с
                {{ $master->created_at->format('d-m-Y') }}</p>
            @if ($services)
                <p class="mb-3 font-bold text-gray-700 dark:text-gray-400">
                <ul>
                    <p class="font-bold">Выполянет услуги: </p>
                    @foreach ($services as $item)
                        @if (in_array($item->id, $masterServiceIds))
                            <li>{{ $item->name }}</li>
                        @endif
                    @endforeach
                </ul>
                </p>
            @endif
            <div class="flex gap-4 max-md:flex-col">
                @component('components.modal-edit-master', [
                    'master' => $master,
                    'services' => $services,
                    'masterServiceIds' => $masterServiceIds,
                ])
                @endcomponent
                <form action="{{ route('master.destroy') }}" method="post" class="d-none">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="master_id" value="{{ $master->id }}">
                    <x-primary-button class="max-md:w-full">Удалить</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
