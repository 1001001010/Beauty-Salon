<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegance Beauty Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom color palette */
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

    @yield('content')

</body>

</html>
