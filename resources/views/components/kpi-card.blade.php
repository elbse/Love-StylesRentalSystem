<div class="relative w-full h-32 rounded-2xl shadow-lg p-4 overflow-hidden {{ $background }}">

    <!-- Background symbol -->
    <div class="absolute inset-0 flex items-center justify-center opacity-30 text-white text-8xl font-extrabold select-none">
        @if(Str::endsWith($symbol, ['.png', '.jpg', '.jpeg', '.svg', '.gif']))
            <img src="{{ $symbol }}" alt="symbol" class="w-full h-full object-contain opacity-30">
        @else
            {{ $symbol ?? '₱' }}
        @endif
    </div>

    <!-- Top right icon -->
    <div class="absolute top-3 right-3 {{ $color }} rounded-full w-10 h-10 flex items-center justify-center shadow-md opacity-70">
        <img src="{{ $symbol }}" alt="symbol" class="w-6 h-4 object-contain">
    </div>

    <div class="relative text-white">
        {{ $slot }}
    </div>
</div>

