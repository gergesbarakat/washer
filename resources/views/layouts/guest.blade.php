<!DOCTYPE html>
<html data-bs-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    @if ($errors->any())
        <div class = "absolute top-10 w-auto  right-2 z-100 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            <span class = "font-medium">Danger alert!</span> {{ implode(' | ', $errors->all()) }}

        </div>
    @endif
    @if (session('status'))
        <div class = "  absolute top-10 w-auto right-2 z-100 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class = "font-medium">Success ! {{ session('status') }}</span>

        </div>
    @endif

    {{ $slot }}
</body>
<script>
    tailwind.config = {
        darkMode: 'class',
        /* 'class' or 'media', we use 'class' to enable dark mode manually */
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('input[type="password"]').forEach(function(input) {
            // Create eye icon wrapper
             const wrapper = document.createElement('div');
            wrapper.classList.add('relative');

            // Clone the input and insert into wrapper
            const clonedInput = input.cloneNode(true);
            input.replaceWith(wrapper);
            wrapper.appendChild(clonedInput);

            // Create the toggle icon
            const toggleIcon = document.createElement('span');
            toggleIcon.innerHTML = '👁️'; // You can use a better SVG/icon if needed
            toggleIcon.classList.add(
                'absolute', 'right-2', 'top-1/2', '-translate-y-1/2', 'cursor-pointer'
            );
            wrapper.appendChild(toggleIcon);

            // Toggle logic
            toggleIcon.addEventListener('click', () => {
                if (clonedInput.type === 'password') {
                    clonedInput.type = 'text';
                    toggleIcon.innerHTML = '🙈'; // icon changes when visible
                } else {
                    clonedInput.type = 'password';
                    toggleIcon.innerHTML = '👁️';
                }
            });
        });
    });
</script>

</html>
