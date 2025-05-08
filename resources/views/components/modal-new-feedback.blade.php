<!-- Кнопка для открытия модального окна -->
<button data-modal-target="feedback-modal" data-modal-toggle="feedback-modal"
    class="mt-4 underline text-end w-max flex items-center gap-2 text-gray-700 hover:text-mauve dark:text-gray-300 dark:hover:text-white transition-colors duration-200">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
    Оставить отзыв
</button>

<!-- Main modal -->
<div id="feedback-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-25">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div
            class="relative bg-white rounded-lg shadow dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <!-- Modal header -->
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

            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST" action="{{ route('feedback.upload') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Рейтинг (звездочки) -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Оценка
                    </label>
                    <div class="flex items-center space-x-1">
                        <div class="rating-stars flex">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating"
                                    value="{{ $i }}" class="hidden" {{ $i == 5 ? 'checked' : '' }}>
                                <label for="star{{ $i }}"
                                    class="cursor-pointer text-gray-300 dark:text-gray-600 hover:text-yellow-400 dark:hover:text-yellow-400 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </label>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Загрузка фото -->
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2"
                        for="file_input">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Добавить фото
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="file_input"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-black hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 transition-colors">
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
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 5MB)</p>
                            </div>
                            <input id="file_input" name="photo" type="file" class="hidden" accept="image/*"
                                required />
                        </label>
                    </div>
                    <div id="image-preview" class="mt-2 hidden">
                        <div class="relative w-full h-32 rounded-lg overflow-hidden">
                            <img id="preview-img" src="#" alt="Предпросмотр"
                                class="w-full h-full object-cover">
                            <button type="button" id="remove-image"
                                class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <input type="text" class="hidden" value="{{ $item->id ?? '' }}" name="records_id">

                <!-- Текст отзыва -->
                <div class="mb-4">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-mauve" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h10M7 16h10M3 3h18v18H3z" />
                        </svg>
                        Ваш отзыв
                    </label>
                    <textarea id="description" rows="5" name="description"
                        class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-mauve focus:border-mauve dark:bg-black dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-mauve dark:focus:border-mauve transition-colors"
                        placeholder="Поделитесь своими впечатлениями..." required></textarea>
                </div>

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

<!-- JavaScript для предпросмотра изображения и звездного рейтинга -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Предпросмотр изображения
        const fileInput = document.getElementById('file_input');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const removeImageBtn = document.getElementById('remove-image');

        if (fileInput && imagePreview && previewImg && removeImageBtn) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            removeImageBtn.addEventListener('click', function() {
                fileInput.value = '';
                imagePreview.classList.add('hidden');
                previewImg.src = '#';
            });
        }

        // Звездный рейтинг
        const ratingLabels = document.querySelectorAll('.rating-stars label');
        const ratingInputs = document.querySelectorAll('.rating-stars input');

        // Инициализация звезд (5 звезд по умолчанию)
        updateStars(5);

        // Обработчик клика по звездам
        ratingLabels.forEach(label => {
            label.addEventListener('click', function() {
                const forAttr = this.getAttribute('for');
                const starValue = forAttr.replace('star', '');
                updateStars(starValue);
            });
        });

        function updateStars(value) {
            ratingLabels.forEach(label => {
                const forAttr = label.getAttribute('for');
                const starValue = parseInt(forAttr.replace('star', ''));

                if (starValue <= value) {
                    label.classList.add('text-yellow-400');
                    label.classList.remove('text-gray-300', 'dark:text-gray-600');
                } else {
                    label.classList.remove('text-yellow-400');
                    label.classList.add('text-gray-300', 'dark:text-gray-600');
                }
            });
        }
    });
</script>
