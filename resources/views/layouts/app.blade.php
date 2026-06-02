@props(
    [
        'title' => null,
        'pageLink' => null,
        'pageText' => null,
        'method'   => null,
    ]
)
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
        <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">
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
        
        @include('layouts.navigation')
        
        <div class="flex min-h-screen flex-col sm:ml-72">

            <div class="flex-grow flex-shrink-0">
                @if ($title != null)
                    <header class="border-b border-black/10 bg-white/70 backdrop-blur dark:border-white/10 dark:bg-neutral-950/70">
                        <div class="cyb-container mt-16 py-6">
                            <h2 class="text-xl font-semibold leading-tight text-cyb-ink dark:text-neutral-100">
                                {{ __($title) }}
                            </h2>
                        </div>
                    </header>
                @endif
                <main>
                
                    <div class="py-6">
                        <div class="cyb-container">
                            <x-flash-notifications></x-flash-notifications>
                            @if ($pageLink != null and $pageText != null)
                                <div class="text-end mb-3">
                                    @if ($method != null)
                                        <form action="{{ $pageLink }}" method="post" class="d-inline">
                                            @csrf
                                            <x-primary-button>{{ $pageText }}</x-primary-button>
                                        </form>
                                    @else
                                        <x-primary-link href="{{ $pageLink }}">{{ $pageText }}</x-primary-link>
                                    @endif
                                </div>
                            @endif
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>

            <footer class="mt-3 flex-shrink-0 border-t border-black/10 bg-white/70 dark:border-white/10 dark:bg-neutral-950/70">
                <div class="cyb-container p-4 text-center text-sm font-semibold text-neutral-600 dark:text-neutral-400">
                    {{ Config::get('app.name') }} &copy; Tous droits réservés
                </div>
            </footer>
            
        </div>

    </body>
</html>
