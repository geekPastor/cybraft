<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
        <!-- Scripts -->
        <script defer src="{{ asset('custom.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-8">
            <button type="button" data-theme-toggle class="fixed right-4 top-4 grid size-10 place-items-center rounded-full border border-black/10 bg-white/80 text-cyb-ink shadow-sm backdrop-blur transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-neutral-900/80 dark:text-neutral-100">
                <span class="sr-only">Changer le mode d'affichage</span>
                <svg class="size-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 15.25A9 9 0 0 1 8.75 2.25 7.5 7.5 0 1 0 21.75 15.25Z" />
                </svg>
                <svg class="hidden size-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36-6.36-1.59 1.59M7.23 16.77l-1.59 1.59m12.72 0-1.59-1.59M7.23 7.23 5.64 5.64M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                </svg>
            </button>
            <div>
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div class="cyb-surface mt-8 w-full overflow-hidden rounded-lg px-6 py-6 sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
