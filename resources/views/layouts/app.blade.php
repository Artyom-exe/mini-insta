<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mini-Instagram') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col" x-data="{ open: false, openNotifications: false, openMenu: false }">

        <!-- Navigation Bar -->
        <nav class="bg-white shadow-md fixed top-0 w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">

                    <!-- Left Side: Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('feed') }}">
                            MINI-INSTAGRAM
                        </a>
                    </div>

                    <!-- Middle: Search Bar (only on large screens) -->
                    <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center">
                        <input type="text" name="query" placeholder="Rechercher..."
                            class="px-4 py-2 border rounded-md" required>
                        <button type="submit"
                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Rechercher</button>
                    </form>

                    <!-- Right Side: Navigation Icons for Large Screens -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('feed') }}" class="text-gray-700 hover:text-gray-900">
                            <i class="ri-home-4-line text-xl"></i>
                        </a>
                        <a href="{{ route('messages') }}" class="text-gray-700 hover:text-gray-900">
                            <i class="ri-message-3-line text-xl"></i>
                        </a>
                        <a href="{{ route('publication.create') }}" class="text-gray-700 hover:text-gray-900">
                            <i class="ri-add-circle-line text-xl"></i>
                        </a>
                        <a href="{{ route('story.create') }}" class="text-gray-700 hover:text-gray-900">
                            <i class="ri-history-line text-xl"></i>
                        </a>
                        <div class="relative" @click.away="openNotifications = false">
                            <button type="button" class="flex items-center focus:outline-none"
                                @click="openNotifications = !openNotifications; markNotificationsAsRead()">
                                <i class="ri-notification-3-line text-xl text-gray-700 hover:text-gray-900"></i>
                                @if (auth()->user()->notifications()->where('is_read', false)->count() > 0)
                                    <span class="text-red-500 text-xs font-bold ml-1">
                                        {{ auth()->user()->notifications()->where('is_read', false)->count() }}
                                    </span>
                                @endif
                            </button>
                            <div x-show="openNotifications" x-transition
                                class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2">
                                @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                    <div class="px-4 py-2 border-b text-sm {{ $notification->is_read ? 'text-gray-600' : 'text-gray-800 font-semibold' }}"
                                        @click="markSingleNotificationAsRead('{{ $notification->id }}')">
                                        {{ $notification->message }}
                                        <span
                                            class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <p class="px-4 py-2 text-sm text-gray-500">Aucune notification.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button type="button" class="flex items-center focus:outline-none" @click="open = !open">
                                <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : asset('images/default-profile.png') }}"
                                    class="h-8 w-8 rounded-full">

                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('profile.show', auth()->user()->id) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <a href="{{ route('edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier le
                                    profil</a>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Hamburger Menu -->
                    <div class="md:hidden">
                        <button @click="openMenu = !openMenu"
                            class="text-gray-700 hover:text-gray-900 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="openMenu" x-transition class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('feed') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Accueil</a>
                    <a href="{{ route('messages') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Messages</a>
                    <a href="{{ route('publication.create') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Créer une publication</a>
                    <a href="{{ route('story.create') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ajouter une story</a>

                    <!-- Notifications Link with Count -->
                    <div @click="openNotifications = !openNotifications; markNotificationsAsRead()"
                        class="flex justify-between items-center px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                        <span>Notifications</span>
                        @if (auth()->user()->notifications()->where('is_read', false)->count() > 0)
                            <span class="text-red-500 text-xs font-bold ml-1">
                                {{ auth()->user()->notifications()->where('is_read', false)->count() }}
                            </span>
                        @endif
                    </div>

                    <!-- Notifications Dropdown Menu inside Hamburger Menu -->
                    <div x-show="openNotifications" x-transition class="mt-2 bg-white rounded-md shadow-lg py-2">
                        @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                            <div class="px-4 py-2 border-b text-sm {{ $notification->is_read ? 'text-gray-600' : 'text-gray-800 font-semibold' }}"
                                @click="markSingleNotificationAsRead('{{ $notification->id }}')">
                                {{ $notification->message }}
                                <span
                                    class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="px-4 py-2 text-sm text-gray-500">Aucune notification.</p>
                        @endforelse
                    </div>

                    <!-- Profile Links in Mobile Menu -->
                    <a href="{{ route('profile.show', auth()->user()->id) }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                    <a href="{{ route('edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Modifier le
                        profil</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                </div>
            </div>
        </nav>

        <!-- Script pour marquer toutes les notifications comme lues -->
        <script>
            function markNotificationsAsRead() {
                fetch("{{ route('notifications.read') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(() => {
                        console.log('All notifications marked as read');
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>

        <!-- Page Content -->
        <main class="mt-20">
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white shadow-inner mt-8 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-center">
            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} MINI-INSTAGRAM. Tous droits réservés.</p>
        </div>
    </footer>
</body>

</html>
