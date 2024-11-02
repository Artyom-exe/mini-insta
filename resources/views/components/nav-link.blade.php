@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-3 pt-2 text-sm font-semibold text-black focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 pt-2 text-sm font-medium text-gray-500 hover:text-black focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
