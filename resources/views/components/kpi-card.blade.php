<div class="relative w-80 h-40 rounded-2xl shadow-lg p-5 overflow-hidden  {{ $background }}">

    <!-- Background symbol -->
    <div class="absolute inset-0 flex items-center justify-center opacity-50 text-white text-[20rem] font-extrabold select-none">
        @if(Str::endsWith($symbol, ['.png', '.jpg', '.jpeg', '.svg', '.gif']))
            <img src="{{ asset($symbol) }}" alt="symbol" class="w-80 h-40 object-contain opacity-50">
        @else
            {{ $symbol ?? '₱' }}
        @endif
    </div>

    <!-- Top right icon -->
    <div class="absolute top-4 right-4 {{ $color }} rounded-full w-12 h-12 flex items-center justify-center shadow-md opacity-50">
        <img src="{{ asset($symbol) }}" alt="symbol" class="w-10 h-6 object-contain">
        
    </div>

    <div class="relative text-white">
        {{ $slot }}
    </div>
</div>

