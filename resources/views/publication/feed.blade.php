<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($publications as $publication)
                <div class="bg-white shadow-sm rounded-lg">
                    <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                        class="w-full h-64 object-cover">
                    <div class="p-4">
                        <p>{{ $publication->caption }}</p>
                        <a href="{{ route('publication.show', $publication->id) }}" class="text-blue-500">View details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
