@props([
    'image' => 'red-ball-gown.jpg',
    'name' => 'Red Ball Gown',
    'size' => 'Small',
    'code' => 'RG001',
    'price' => '3,000Php',
    'status' => 'available',
])

@php
    $statusConfig = match($status) {
        'available'    => ['dot' => 'bg-green-400', 'text' => 'Available',    'badge' => 'bg-green-50 text-green-600'],
        'reserved'     => ['dot' => 'bg-yellow-400','text' => 'Reserved',     'badge' => 'bg-yellow-50 text-yellow-600'],
        'out-of-stock' => ['dot' => 'bg-red-400',   'text' => 'Out of Stock', 'badge' => 'bg-red-50 text-red-500'],
        default        => ['dot' => 'bg-gray-400',  'text' => 'Unknown',      'badge' => 'bg-gray-50 text-gray-500'],
    };
@endphp

<div class="group bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden flex flex-col">

    {{-- Image --}}
    <div class="relative overflow-hidden">
        <img
            src="{{ asset('storage/images/' . $image) }}"
            alt="{{ $name }}"
            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300"
        />

        {{-- Status Badge --}}
        <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $statusConfig['badge'] }} backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
            {{ $statusConfig['text'] }}
        </span>
    </div>

    {{-- Details --}}
    <div class="flex flex-col flex-1 p-4">
        <div class="flex-1">
            <p class="text-xs text-gray-400 font-medium tracking-wide uppercase mb-1">{{ $code }}</p>
            <h2 class="text-sm font-semibold text-gray-900 leading-snug">
                {{ $name }}
                <span class="text-xs text-gray-400 font-normal normal-case">· {{ $size }}</span>
            </h2>
            <p class="text-lg font-bold text-purple-600 mt-2">{{ $price }}</p>
        </div>

        {{-- Action Button --}}
        <button class="mt-4 w-full bg-purple-600 hover:bg-purple-700 active:bg-purple-800 text-white text-xs font-semibold py-2.5 rounded-xl transition-colors duration-150 tracking-wide">
            View Details
        </button>
    </div>

    {{ $slot }}

</div>