@props([
    'icon' => null,
    'symbol' => null,
    'color' => 'bg-black',
    'background' => 'bg-white'
])

<div class="relative w-full h-32 rounded-2xl shadow-sm border p-4 overflow-hidden {{ $background }} border-gray-100">

    <!-- Background watermark (optional) -->
    @if($symbol)
    <div class="absolute inset-0 flex items-center justify-center opacity-10 text-8xl select-none text-gray-400">
        <i class="{{ $symbol }}"></i>
    </div>
    @endif

    <!-- Top right icon -->
    @if($icon)
    <div class="absolute top-3 right-3 {{ $color }} rounded-full w-10 h-10 flex items-center justify-center shadow-md text-white">
        <i class="{{ $icon }}"></i>
    </div>
    @endif

    <div class="relative text-gray-800">
        {{ $slot }}
    </div>

</div>