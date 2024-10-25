<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Story Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500"
                        required>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Create
                    Story</button>
            </form>
        </div>
    </div>
</x-app-layout>
