@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center mt-4 py-2 px-6 bg-white/85 rounded-full hover:bg-white/85 shadow-inner  text-black font-bold italic '
            : 'flex items-center mt-4 py-2 px-6 text-gray-100 hover:bg-emerald-400/0 transition duration-500 hover:text-black rounded-e-full';
@endphp

<a {{ $attributes->merge(['class' => '' . $classes]) }}>
    {{ $icon ?? '' }}
    <span class="mx-3">{{ $slot }}</span>
</a>
