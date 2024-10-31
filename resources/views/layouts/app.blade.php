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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col" x-data="{ open: false, openNotifications: false }">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-md fixed top-0 w-full z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Left Side: Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('feed') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                        </a>
                    </div>

                    <!-- Middle: Search Bar -->
                    <form action="{{ route('search') }}" method="GET" class="flex items-center">
                        <input type="text" name="query"
                            placeholder="Rechercher des publications ou des utilisateurs..."
                            class="px-4 py-2 border rounded-md" required>
                        <button type="submit"
                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Rechercher
                        </button>
                    </form>

                    <!-- Right Side: Links and Profile -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('feed') }}" class="text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h18M3 7h18M3 11h18m0 8H3M3 15h18" />
                            </svg>
                        </a>
                        <a href="{{ route('profile.show', auth()->id()) }}" class="text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.318c2.636 0 4.758 1.5 5.5 3.682C17.242 9.864 12 11.25 12 11.25s-5.242-1.386-5.5-3.25c.742-2.182 2.864-3.682 5.5-3.682z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21V11.25s4.242-1.386 5.5-3.25" />
                            </svg>
                        </a>
                        <a href="{{ route('publication.create') }}" class="text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5v14" />
                            </svg>
                        </a>
                        <!-- New Story Button -->
                        <a href="{{ route('story.create') }}" class="text-gray-700 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.318c2.636 0 4.758 1.5 5.5 3.682C17.242 9.864 12 11.25 12 11.25s-5.242-1.386-5.5-3.25c.742-2.182 2.864-3.682 5.5-3.682z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 21V11.25s4.242-1.386 5.5-3.25" />
                            </svg>
                        </a>

                        <!-- Notifications Dropdown -->
                        <div class="relative" @click.away="openNotifications = false">
                            <button type="button" class="flex items-center focus:outline-none"
                                @click="openNotifications = !openNotifications; markNotificationsAsRead()">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-gray-700 hover:text-gray-900" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14H6a2.032 2.032 0 01-1.595.595L3 17h5m3-3V9a4 4 0 00-8 0v8H7v1h10v-1h1v-1H7" />
                                </svg>
                                @if (auth()->user()->notifications()->where('is_read', false)->count() > 0)
                                    <span class="text-red-500 text-xs font-bold ml-1">
                                        {{ auth()->user()->notifications()->where('is_read', false)->count() }}
                                    </span>
                                @endif
                            </button>

                            <!-- Notifications Dropdown Menu -->
                            <div x-show="openNotifications" x-transition
                                class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2">
                                @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                                    <div
                                        class="px-4 py-2 border-b text-sm {{ $notification->is_read ? 'text-gray-600' : 'text-gray-800 font-semibold' }}">
                                        {{ $notification->message }}
                                        <span
                                            class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <p class="px-4 py-2 text-sm text-gray-500">Aucune notification.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Script to mark notifications as read -->
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
                                    .then(data => console.log('Notifications marked as read'))
                                    .catch(error => console.error('Error:', error));
                            }
                        </script>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button type="button" class="flex items-center focus:outline-none" @click="open = !open">
                                <img src="{{ Storage::url(auth()->user()->profile_photo) }}"
                                    class="h-8 w-8 rounded-full">
                            </button>
                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="{{ route('edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Messages Link -->
            <a href="{{ route('messages') }}" class="text-gray-700 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h5m-5 4h10M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                </svg>
            </a>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow mt-16">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="mt-20">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
