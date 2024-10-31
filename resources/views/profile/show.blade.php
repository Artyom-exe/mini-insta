<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <!-- Photo de profil de l'utilisateur -->
                <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile Photo" class="h-24 w-24 rounded-full">
                <div class="ml-6">
                    <h1 class="text-xl font-semibold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->bio }}</p>

                    <!-- Boutons Suivre / Se Désabonner -->
                    @if (auth()->id() !== $user->id)
                        <div class="mt-4">
                            @if (auth()->user()->isFollowing($user))
                                <!-- Bouton Se Désabonner -->
                                <form action="{{ route('unfollow', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Se désabonner
                                    </button>
                                </form>
                            @else
                                <!-- Bouton Suivre -->
                                <form action="{{ route('follow', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Suivre
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Lien vers la conversation privée -->
                        <div class="mt-4">
                            <a href="{{ route('messages.conversation', $user->id) }}"
                                class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                Envoyer un message
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section des publications -->
            <h2 class="mt-8 text-2xl font-bold">Publications</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                @forelse ($user->publications as $publication)
                    <div class="bg-white shadow-sm rounded-lg">
                        <a href="{{ route('publication.show', $publication->id) }}">
                            <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                                class="w-full h-64 object-cover rounded">
                        </a>
                        <div class="p-4">
                            <p>{{ $publication->caption }}</p>
                            <p class="text-gray-500 text-sm">Publié le {{ $publication->created_at->format('d M Y') }}
                            </p>
                            <p class="text-gray-500 text-sm">{{ $publication->likes_count }} likes</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600">Aucune publication disponible.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
