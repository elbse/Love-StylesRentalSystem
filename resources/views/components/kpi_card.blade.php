<div class="relative w-72 h-40 rounded-2xl shadow-lg p-5 overflow-hidden {{ $background }}">

    <!-- Background symbol -->
    <div class="absolute inset-0 flex items-center justify-center opacity-20 text-purple-300 text-[10rem] font-extrabold select-none">
        {{ $symbol ?? '₱' }}
    </div>

    <!-- Top right icon -->
    <div class="absolute top-4 right-4 {{ $color }} rounded-full w-12 h-12 flex items-center justify-center shadow-md">
        <i class="{{ $icon }} text-white text-xl"></i>
    </div>

    <div class="relative text-white">
        {{ $slot }}
    </div>
</div>

{{-- color="bg-gradient-to-r from-[#A4B1FF] to-[#5E72E4]" --}}