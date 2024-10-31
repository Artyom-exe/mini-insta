<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détail de la Story') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Affichage de la story -->
                <div class="mb-4">
                    <img src="{{ Storage::url($story->image_url) }}" alt="Story Image"
                        class="w-full h-auto rounded-lg shadow">
                </div>

                <!-- Informations sur la story -->
                <div class="mb-4">
                    <p class="font-semibold text-gray-700">
                        <a href="{{ route('profile.show', $story->user->id) }}" class="text-blue-500 hover:underline">
                            {{ $story->user->name }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-500">Expirera le :
                        {{ \Carbon\Carbon::parse($story->expires_at)->format('d/m/Y H:i') }}</p>
                </div>

                <!-- Section des likes -->
                <div class="flex items-center space-x-2">
                    <form
                        action="{{ auth()->user()->hasLikedStory($story) ? route('unlike.story', $story->id) : route('like.story', $story->id) }}"
                        method="POST">
                        @csrf
                        @if (auth()->user()->hasLikedStory($story))
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">
                                Unlike
                            </button>
                        @else
                            <button type="submit" class="text-blue-500 hover:underline">
                                Like
                            </button>
                        @endif
                    </form>
                    <span class="text-gray-500">{{ $story->likes->count() }} likes</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
