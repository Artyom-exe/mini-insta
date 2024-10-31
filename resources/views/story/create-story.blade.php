<!-- resources/views/story/create-story.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une nouvelle Story') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Champ d'image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium">Image de la Story</label>
                        <input type="file" name="image" id="image"
                            class="mt-1 block w-full text-sm text-gray-500" required>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Publier la Story
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
