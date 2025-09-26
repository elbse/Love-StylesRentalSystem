<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love and Styles Rental System</title>

    @vite('resources/css/app.css')
</head>
<body class="flex h-screen bg-gray-100">

    <aside class="w-64   flex flex-col">

        <!-- Logo -->
        <div class="flex items-center justify-center py-6 border-b border-gray-700">
            <img src="images/lsrs_logo.png" alt="Logo" class="w-10 h-10 mr-2">
            <span class="font-bold text-lg leading-tight text-black">
                Love & Styles <br>
                Rental System
            </span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2 bg-gray-900 text-white" >
            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-home mr-3"></i>
                <span>Dashboard</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-box mr-3"></i>
                <span>Rentals</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-upload mr-3"></i>
                <span>Release</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-undo mr-3"></i>
                <span>Return</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-file-invoice-dollar mr-3"></i>
                <span>Billing</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-warehouse mr-3"></i>
                <span>Inventory</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded hover:bg-gray-800">
                <i class="fas fa-users mr-3"></i>
                <span>Customer</span>
            </a>

            <a href="#" class="flex items-center p-2 rounded bg-purple-700 hover:bg-purple-800">
                <i class="fas fa-calendar-check mr-3"></i>
                <span>Bookings</span>
            </a>
        </nav>
    </aside>


     <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <header class="flex items-center justify-between bg-white shadow px-6 py-3">
            <!-- Left: Page Title -->
            <h1 class="text-xl font-semibold text-gray-800">
                Reservation & Booking
            </h1>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bell"></i>
                </button>

                <button class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-cog"></i>
                </button>

                <div class="flex items-center space-x-2">
                    <img src="/user-avatar.jpg" alt="User" class="w-8 h-8 rounded-full">
                    <span class="font-medium text-gray-700">Charisse</span>
                </div>
            </div>
        </header>

 <!-- Page Content -->
        <main class="flex-1 p-6 bg-gray-100">
            {{ $slot }}
        </main>
    </div>

    
</body>
</html>