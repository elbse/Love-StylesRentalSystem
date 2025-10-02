@props([
    'href' => null,   // if set, button becomes a link
    'type' => 'button', // default type for <button>
])

@if ($href)
    <a href="{{ $href }}"
       {{ $attributes->merge(['class' => 'block text-center bg-white text-purple-700 font-semibold py-2 px-3 rounded-full shadow hover:bg-gray-100 cursor-pointer']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'block text-center bg-white text-purple-700 font-semibold py-2 px-3 rounded-full shadow hover:bg-gray-100 cursor-pointer']) }}>
        {{ $slot }}
    </button>
@endif

