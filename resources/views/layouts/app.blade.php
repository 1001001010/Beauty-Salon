<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Elegance Beauty Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <style>
        :root {
            --color-cream: #FAF6F3;
            --color-blush: #E9BFB3;
            --color-mauve: #D2ACA1;
        }

        .bg-cream {
            background-color: var(--color-cream);
        }

        .bg-blush {
            background-color: var(--color-blush);
        }

        .bg-mauve {
            background-color: var(--color-mauve);
        }

        .text-mauve {
            color: var(--color-mauve);
        }

        .text-blush {
            color: var(--color-blush);
        }

        .border-mauve {
            border-color: var(--color-mauve);
        }

        .border-blush {
            border-color: var(--color-blush);
        }

        .hover\:bg-mauve:hover {
            background-color: var(--color-mauve);
        }

        .hover\:bg-blush:hover {
            background-color: var(--color-blush);
        }

        .hover\:text-mauve:hover {
            color: var(--color-mauve);
        }

        .focus\:ring-mauve:focus {
            --tw-ring-color: var(--color-mauve);
        }

        .focus\:border-mauve:focus {
            border-color: var(--color-mauve);
        }
    </style>
</head>

<body class="bg-cream font-sans">
    @include('components.header')

    @yield('content')

    @include('components.footer')

    <!-- Скрипты -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        @if (session('message'))
            const notyf = new Notyf({
                duration: 3000,
                ripple: true,
                position: {
                    x: 'right',
                    y: 'top'
                }
            });

            let type = "{{ session('message.type') }}";
            let text = "{{ session('message.text') }}";

            if (type === 'message') {
                notyf.success(text);
            } else if (type === 'error') {
                notyf.error(text);
            } else {
                notyf.open({
                    type: 'info',
                    message: text
                });
            }
        @endif
    </script>
</body>

</html>
