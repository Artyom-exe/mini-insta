<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-4">Votre Fil d'Actualité</h1>

        <!-- Section des Stories -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Stories des utilisateurs que vous suivez</h2>
            <div class="flex space-x-4 overflow-x-auto">
                @foreach ($followedStories as $story)
                    <div class="bg-white shadow-sm rounded-lg p-4 w-40">
                        <a href="{{ route('story.show', $story->id) }}">
                            <img src="{{ Storage::url($story->image_url) }}" alt="Story Image"
                                class="w-full h-32 object-cover rounded">
                        </a>
                        <div class="mt-2 text-center">
                            <p class="font-semibold">
                                <a href="{{ route('profile.show', $story->user->id) }}">
                                    {{ $story->user->name }}
                                </a>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section des publications des utilisateurs suivis -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Publications des utilisateurs que vous suivez</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($followedPublications as $publication)
                    <div class="bg-white shadow-sm rounded-lg p-4">
                        <a href="{{ route('publication.show', $publication->id) }}">
                            <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                                class="w-full h-64 object-cover rounded">
                        </a>
                        <div class="mt-2">
                            <p class="font-semibold">
                                <a href="{{ route('profile.show', $publication->user->id) }}">
                                    {{ $publication->user->name }}
                                </a>
                            </p>
                            <p>{{ $publication->caption }}</p>
                            <p class="text-gray-500 text-sm">{{ $publication->likes->count() }} likes</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section des publications les plus likées -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Publications les plus likées</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($popularPublications as $publication)
                    <div class="bg-white shadow-sm rounded-lg p-4">
                        <a href="{{ route('publication.show', $publication->id) }}">
                            <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                                class="w-full h-64 object-cover rounded">
                        </a>
                        <div class="mt-2">
                            <p class="font-semibold">
                                <a href="{{ route('profile.show', $publication->user->id) }}">
                                    {{ $publication->user->name }}
                                </a>
                            </p>
                            <p>{{ $publication->caption }}</p>
                            <p class="text-gray-500 text-sm">{{ $publication->likes->count() }} likes</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
