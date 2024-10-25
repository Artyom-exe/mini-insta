<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="flex items-center">
                <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile Photo" class="h-24 w-24 rounded-full">
                <div class="ml-6">
                    <h1 class="text-xl font-semibold">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->bio }}</p>
                </div>
            </div>

            <h2 class="mt-8 text-2xl font-bold">Publications</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                @foreach ($user->publications as $publication)
                    <div class="bg-white shadow-sm rounded-lg">
                        <img src="{{ Storage::url($publication->image_url) }}" alt="Publication Image"
                            class="w-full h-64 object-cover">
                        <div class="p-4">
                            <p>{{ $publication->caption }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
