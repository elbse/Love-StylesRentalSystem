<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love and Styles Rental System</title>

    <link rel="shortcut icon" href="{{ asset('lsrs_logo.png') }}?v=1" type="image/png">


    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="flex h-screen bg-gray-100">

    <aside class="w-64   flex flex-col">

        <!-- Logo -->
        <div class="flex items-center justify-center py-6 border-b border-gray-700">
            <img src="{{ asset('images/lsrs_logo.png') }}" alt="Logo" class="w-10 h-10 mr-2">
            <span class="font-bold text-lg leading-tight text-black">
                Love & Styles <br>
                Rental System
            </span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2 bg-gray-900 text-white" >

            <a href="{{ route('dashboard') }}"
                class="flex items-center p-2 rounded hover:bg-gray-800 
                {{ request()->routeIs('dashboard') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-home mr-3"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('rentals.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800
                {{ request()->routeIs('rentals.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-box mr-3"></i>
                <span>Rentals</span>
            </a>

            {{-- <a href="{{ route('releases.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800
                {{ request()->routeIs('releases.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-upload mr-3"></i>
                <span>Release</span>
            </a> --}}

            {{-- <a href="{{ route('returns.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800  
                {{ request()->routeIs('returns.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-undo mr-3"></i>
                <span>Return</span>
            </a> --}}

            <a href="{{ route('billings.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800
                {{ request()->routeIs('billings.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-file-invoice-dollar mr-3"></i>
                <span>Billing</span>
            </a>

            <a href="{{ route('inventories.index') }}" class="flex items-center p-2 rounded hover:bg-gray-800
                {{ request()->routeIs('inventories.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-warehouse mr-3"></i>
                <span>Inventory</span>
            </a>

            <a href="{{ route('customers.index') }}"
                class="flex items-center p-2 rounded hover:bg-gray-800 
                {{ request()->routeIs('customers.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-users mr-3"></i>
                <span>Customer</span>
            </a>

            <a href="{{ route('bookings.index')}}" class="flex items-center p-2 rounded hover:bg-gray-800
                {{ request()->routeIs('bookings.*') ? 'bg-purple-700' : '' }}">
                <i class="fas fa-calendar-check mr-3"></i>
                <span>Bookings</span>
            </a>
        </nav>

        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-700 bg-gray-900">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center p-2 rounded bg-purple-600 hover:bg-purple-700 text-white">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span>Log out</span>
            </button>
        </form>
    </aside>


     <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-0">

        <!-- Top Bar -->
        <header class="relative flex items-center justify-between bg-white/0 shadow px-6 py-3 h-[94px] overflow-hidden">
        <!-- Background Image -->
        <img src="/images/topbar_background.png" 
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
                <img src="images/avatar.png" alt="User" class="w-8 h-8 rounded-full">
                <span class="font-medium text-white">{{Auth::user()->name}}</span>
            </div>

            </div>
        </header>


 <!-- Page Content -->
        <main class="flex-1 min-h-0 p-6 bg-gray-100 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    
</body>
</html>