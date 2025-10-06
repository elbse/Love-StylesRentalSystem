<!-- Top Bar -->
<header class="relative flex items-center justify-between bg-white/0 shadow px-6 py-3 h-[94px] overflow-hidden">
    <!-- Background Image -->
    <img src="{{ asset('storage/images/topbar_background.png') }}" 
        alt="Collage" 
        class="absolute inset-0 w-full h-full object-cover -z-10">

    <!-- Left: Page Title -->
    @props(['title' => null])

    @php
        $autoTitle = Route::currentRouteName()
            ? ucwords(str_replace('.', ' ', Route::currentRouteName()))
            : 'Default Title';
    @endphp

    <h1 class="flex items-center text-2xl font-semibold text-white relative z-10">
        {{ $title ?? $autoTitle }}
    </h1>

    <!-- Right: Actions -->
    <div class="flex items-center space-x-4 relative z-10">
        <button class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-bell"></i>
        </button>

        <button class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-cog"></i>
        </button>

        <div class="flex items-center space-x-2">
            <img src="{{ asset('storage/images/avatar.png') }}" alt="User" class="w-8 h-8 rounded-full">
            <span class="font-medium text-white">{{Auth::user()->name}}</span>
        </div>
    </div>
</header>
