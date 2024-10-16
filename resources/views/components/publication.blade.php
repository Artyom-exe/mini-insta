@props(['publication'])

<div class="full-publi container mb-8 pb-4 border-b border-gray-300 relative w-[500px]">
    <!-- Header de la publication -->
    <div class="head-publi flex items-center justify-between p-4">
        <div class="flex items-center">
            <img class="w-10 h-10 rounded-full" src="{{ Storage::url($publication->user->profile_photo) }}"
                alt="Profile Photo">
            <div class="pl-3">
                <span class="font-semibold text-sm">{{ $publication->user->name }}</span>
                <time class="block text-xs text-gray-500">{{ $publication->created_at->format('H:i') }}</time>
            </div>
        </div>
        <x-heroicon-c-ellipsis-horizontal class="w-6 h-6 text-gray-500" />
    </div>

    <!-- Image de la publication -->
    <figure>
        <img class="w-full max-h-[700px] object-cover aspect-[4/5]" src="{{ Storage::url($publication->image_url) }}"
            alt="Publication Image">
    </figure>

    <!-- Légende de la publication -->
    <div class="p-4">
        <p class="text-sm">
            <span class="font-semibold">{{ $publication->user->name }}</span>
            {{ $publication->caption }}
        </p>
    </div>
</div>
