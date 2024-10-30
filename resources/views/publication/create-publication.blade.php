<x-app-layout>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('publication.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="caption" class="block text-gray-700">Caption</label>
                    <input type="text" name="caption" id="caption"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500"
                        required>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Create
                    Publication</button>
            </form>
        </div>
    </div>
</x-app-layout>
