<button data-modal-target="feedback-modal" data-modal-toggle="feedback-modal"
    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-mauve bg-cream hover:bg-blush hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-mauve">
    Оставить отзыв
</button>

<div id="feedback-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div
            class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 bg-cream">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-mauve" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    Поделитесь своим мнением
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="feedback-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Закрыть</span>
                </button>
            </div>

            <form class="p-6 md:p-7" method="POST" action="{{ route('feedback.upload') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <!-- Левая колонка - информация об отзыве -->
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label for="feedback-title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Заголовок отзыва
                            </label>
                            <input type="text" name="title" id="feedback-title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Кратко о вашем опыте">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Необязательное поле</p>
                        </div>

                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Ваш отзыв
                            </label>
                            <textarea id="description" rows="8" name="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-mauve focus:border-mauve block w-full p-2.5 dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve"
                                placeholder="Поделитесь своими впечатлениями..." required></textarea>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Оценка
                            </label>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="rating-{{ $i }}" name="rating"
                                            value="{{ $i }}" class="hidden peer"
                                            {{ $i == 5 ? 'checked' : '' }}>
                                        <label for="rating-{{ $i }}"
                                            class="cursor-pointer peer-checked:text-yellow-400 text-gray-300 dark:text-gray-600 hover:text-yellow-400 dark:hover:text-yellow-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Правая колонка - фото и предпросмотр -->
                    <div class="md:col-span-1 space-y-6">
                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Предпросмотр фото
                            </label>
                            <div id="image-preview"
                                class="relative h-48 w-full overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center">
                                <div id="no-image-placeholder"
                                    class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm">Предпросмотр появится здесь</p>
                                </div>
                                <img id="preview-image" class="hidden h-full w-full object-cover object-center"
                                    src="#" alt="Предпросмотр">
                                <button type="button" id="remove-image"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hidden hover:bg-red-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2"
                                for="file_input">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Загрузить фото
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="file_input"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-black hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Нажмите для загрузки</span> или перетащите файл
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 5MB)
                                        </p>
                                    </div>
                                    <input id="file_input" name="photo" type="file" class="hidden"
                                        accept="image/*" required />
                                </label>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 dark:bg-black border border-gray-300 dark:border-gray-600 rounded-lg p-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Рекомендации для отзыва
                            </h4>
                            <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1 list-disc pl-5">
                                <li>Поделитесь своими впечатлениями о качестве услуг</li>
                                <li>Расскажите о профессионализме мастеров</li>
                                <li>Опишите атмосферу и комфорт</li>
                                <li>Упомяните, что вам особенно понравилось</li>
                                <li>Добавьте фото для наглядности (если возможно)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <input type="text" class="hidden" value="{{ $item->id ?? '' }}" name="records_id">

                <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-600">
                    <button type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-black dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                        data-modal-toggle="feedback-modal">
                        Отмена
                    </button>
                    <button type="submit"
                        class="text-white bg-mauve hover:bg-mauve/90 focus:ring-4 focus:outline-none focus:ring-mauve font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-mauve dark:hover:bg-mauve/80 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Опубликовать отзыв
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file_input');
        const previewImage = document.getElementById('preview-image');
        const noImagePlaceholder = document.getElementById('no-image-placeholder');
        const removeImageBtn = document.getElementById('remove-image');

        if (fileInput && previewImage && noImagePlaceholder && removeImageBtn) {
            // Обработка загрузки файла
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        noImagePlaceholder.classList.add('hidden');
                        removeImageBtn.classList.remove('hidden');
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Обработка удаления изображения
            removeImageBtn.addEventListener('click', function() {
                fileInput.value = '';
                previewImage.src = '#';
                previewImage.classList.add('hidden');
                noImagePlaceholder.classList.remove('hidden');
                removeImageBtn.classList.add('hidden');
            });
        }

        // Звездный рейтинг
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const ratingLabels = document.querySelectorAll('label[for^="rating-"]');

        ratingInputs.forEach((input, index) => {
            input.addEventListener('change', function() {
                // Сбросить все звезды
                ratingLabels.forEach(label => {
                    label.classList.remove('text-yellow-400');
                    label.classList.add('text-gray-300', 'dark:text-gray-600');
                });

                // Заполнить звезды до выбранной
                for (let i = 0; i <= index; i++) {
                    ratingLabels[i].classList.remove('text-gray-300', 'dark:text-gray-600');
                    ratingLabels[i].classList.add('text-yellow-400');
                }
            });
        });

        // Подсветка звезд при наведении
        ratingLabels.forEach((label, index) => {
            label.addEventListener('mouseenter', function() {
                for (let i = 0; i <= index; i++) {
                    ratingLabels[i].classList.add('text-yellow-400');
                    ratingLabels[i].classList.remove('text-gray-300', 'dark:text-gray-600');
                }
            });

            label.addEventListener('mouseleave', function() {
                const checkedIndex = Array.from(ratingInputs).findIndex(input => input.checked);

                ratingLabels.forEach((label, i) => {
                    if (i <= checkedIndex) {
                        label.classList.add('text-yellow-400');
                        label.classList.remove('text-gray-300', 'dark:text-gray-600');
                    } else {
                        label.classList.remove('text-yellow-400');
                        label.classList.add('text-gray-300', 'dark:text-gray-600');
                    }
                });
            });
        });
    });
</script>
