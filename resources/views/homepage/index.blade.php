<x-guest-layout>
    <section class="flex flex-col items-center">
        @foreach ($publications as $publication)
            <x-publication :publication="$publication">
            </x-publication>
        @endforeach
    </section>
</x-guest-layout>
