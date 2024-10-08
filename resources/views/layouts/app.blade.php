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
        <!-- Scripts -->
        <script defer src="{{ asset('custom.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-800 bg-opacity-15">
        
        @include('layouts.navigation')
        
        <div class="sm:ml-64 flex flex-col h-screen">

            <div class=" flex-grow flex-shrink-0">
                @if ($title != null)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto mt-14 py-6 px-4 sm:px-6 lg:px-8">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __($title) }}
                            </h2>
                        </div>
                    </header>
                @endif
                <main>
                
                    <div class="pt-4">
                        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
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

            <footer class="bg-gray-300 flex-shrink-0 mt-3">
                <div class="max-w-7xl mx-auto mt-3 p-4 sm:px-6 lg:px-8 text-center font-bold">
                    {{ Config::get('app.name') }} &copy; Tous droits réservés
                </div>
            </footer>
            
        </div>

    </body>
</html>
