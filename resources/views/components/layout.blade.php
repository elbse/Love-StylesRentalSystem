<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love and Styles Rental System</title>

    <link rel="shortcut icon" href="{{ asset('storage/images/lsrs_logo.png') }}?v=1" type="image/png">


    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Prevent layout shifts and improve sidebar stability */
        body {
            overflow-x: hidden;
        }
        
        /* Smooth transitions for sidebar interactions */
        .sidebar-link {
            will-change: background-color, color;
        }
        
        /* Ensure dropdown animations are smooth */
        [x-cloak] {
            display: none !important;
        }
        
        /* JavaScript dropdown styles */
        .rentals-dropdown-content {
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
            transform-origin: top;
        }
        
        /* Prevent layout shifts */
        .rentals-dropdown-container {
            position: relative;
        }
    </style>
</head>
<body class="flex h-screen bg-gray-100">

    <x-sidebar />


     <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-0 ml-64 relative">

        <x-topbar :title="$title ?? null" />


 <!-- Page Content -->
        <main class="flex-1 min-h-0 p-6 bg-gray-100 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    
</body>
</html>