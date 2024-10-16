<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-white antialiased">
    <div class="min-h-screen flex bg-gray-100 dark:bg-gray-900">

        <!-- Navigation gauche -->
        <aside
            class="w-64 bg-white dark:bg-gray-900 h-screen border-slate-400 border-r l-stone-50 sticky top-0 flex flex-col items-start py-6 px-8">
            <!-- Logo et nom du site -->
            <a href="/"
                class="group font-bold text-3xl flex items-center space-x-4 hover:text-emerald-600 transition">
                <span>Instagram</span>
            </a>

            <!-- Liens de navigation -->
            <nav class="mt-10 space-y-4 flex flex-col">
                <a class="font-bold hover:text-emerald-600 transition" href="#">
                    <x-heroicon-o-home class="w-6 h-6 inline mr-2" /> Home
                </a>
                <a class="font-bold hover:text-emerald-600 transition" href="#">
                    <x-css-search class="w-6 h-6 inline mr-2" /> Search
                </a>
                <a class="font-bold hover:text-emerald-600 transition" href="#">
                    <x-heroicon-o-bell class="w-6 h-6 inline mr-2" /> Notifications
                </a>
                <a class="font-bold hover:text-emerald-600 transition" href="#">
                    <x-heroicon-o-user class="w-6 h-6 inline mr-2" /> Profile
                </a>
            </nav>
        </aside>

        <!-- Contenu principal (publications) -->
        <main class="flex-grow mx-8 py-6">
            <div class="container mx-auto">
                <!-- Slot pour les publications -->
                {{ $slot }}
            </div>
        </main>

        <!-- Suggestions et notifications à droite -->
        <aside class="w-64 bg-white dark:bg-gray-900 py-6 px-8 hidden lg:block">
            <!-- Barre de suggestions -->
            <h2 class="font-bold text-lg mb-4">Suggestions for you</h2>

            <div class="space-y-4">
                <!-- Suggestion d'utilisateur 1 -->
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="ml-4">
                        <span class="font-semibold">user_one</span>
                        <p class="text-sm text-gray-500">Followed by user_two</p>
                    </div>
                    <button class="ml-auto text-emerald-600 font-semibold">Follow</button>
                </div>

                <!-- Suggestion d'utilisateur 2 -->
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="ml-4">
                        <span class="font-semibold">user_two</span>
                        <p class="text-sm text-gray-500">Followed by user_three</p>
                    </div>
                    <button class="ml-auto text-emerald-600 font-semibold">Follow</button>
                </div>

                <!-- ... autres suggestions -->
            </div>
        </aside>
    </div>
</body>

</html>
