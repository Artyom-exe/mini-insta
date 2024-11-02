<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-4 text-center">Votre Fil d'Actualité</h1>

        <!-- Section des Stories -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Stories des utilisateurs que vous suivez</h2>
            <div class="flex space-x-4 overflow-x-auto scrollbar-hide">
                @foreach ($followedStories->sortBy('is_viewed') as $story)
                    <div
                        class="flex-shrink-0 w-20 h-20 rounded-full
                        {{ $story->is_viewed ? 'bg-gray-300' : 'bg-gradient-to-tr from-pink-500 to-yellow-500' }} p-1 flex items-center justify-center">
                        <a href="{{ route('story.show', $story->id) }}" class="block bg-white rounded-full p-1">
                            <img src="{{ Storage::url($story->image_url) }}" alt="Story Image"
                                class="w-16 h-16 object-cover rounded-full">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section des publications des utilisateurs suivis -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Publications des utilisateurs que vous suivez</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($followedPublications as $publication)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="flex items-center px-4 py-2">
                            <a href="{{ route('profile.show', $publication->user->id) }}" class="flex-shrink-0">
                                <img src="{{ Storage::url($publication->user->profile_photo) }}" alt="User Image"
                                    class="w-10 h-10 rounded-full">
                            </a>
                            <div class="ml-3">
                                <p class="text-sm font-semibold">
                                    <a href="{{ route('profile.show', $publication->user->id) }}">
                                        {{ $publication->user->name }}
                                    </a>
                                </p>
                                <p class="text-gray-500 text-xs">{{ $publication->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('publication.show', $publication->id) }}">
                            <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                                class="w-full h-64 object-cover">
                        </a>
                        <div class="px-4 py-2">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">{{ $publication->likes->count() }} likes</span>
                            </div>
                            <p class="text-sm">
                                <span class="font-semibold">{{ $publication->user->name }}</span>
                                {{ $publication->caption }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section des publications les plus likées -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Publications les plus likées</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($popularPublications as $publication)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="flex items-center px-4 py-2">
                            <a href="{{ route('profile.show', $publication->user->id) }}" class="flex-shrink-0">
                                <img src="{{ Storage::url($publication->user->profile_photo) }}" alt="User Image"
                                    class="w-10 h-10 rounded-full">
                            </a>
                            <div class="ml-3">
                                <p class="text-sm font-semibold">
                                    <a href="{{ route('profile.show', $publication->user->id) }}">
                                        {{ $publication->user->name }}
                                    </a>
                                </p>
                                <p class="text-gray-500 text-xs">{{ $publication->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ route('publication.show', $publication->id) }}">
                            <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                                class="w-full h-64 object-cover">
                        </a>
                        <div class="px-4 py-2">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">{{ $publication->likes->count() }} likes</span>
                                <span class="text-sm text-gray-500">Voir les commentaires</span>
                            </div>
                            <p class="text-sm">
                                <span class="font-semibold">{{ $publication->user->name }}</span>
                                {{ $publication->caption }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
