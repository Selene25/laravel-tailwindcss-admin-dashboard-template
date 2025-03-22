<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles        

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
    </head>

    <body class="font-inter antialiased bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400">
        <main class="bg-white dark:bg-gray-900">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 relative">
                <img id="background" class="absolute inset-0 w-full h-full object-cover" src="{{ asset('images/bg.png') }}" alt="Laravel background" />
            
                    <!-- Header -->
                    <div class="relative z-10">
                        <a class="block" href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/z.png') }}" alt="logo" class="w-30 h-30">
                        </a>
                    </div>

                    @if (Route::currentRouteName() == 'register')
                        <div class="relative z-10 w-full max-w-4xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                            {{ $slot }}
                        </div>
                    @elseif (Route::currentRouteName() == 'login')
                        <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                            {{ $slot }}
                        </div>
                    @else
                        {{ $slot }}
                    @endif
                </div>
        </main>
        @livewireScriptConfig
    </body>
</html>
