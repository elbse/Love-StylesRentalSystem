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
        
        /* Ensure topbar and dropdown have proper z-index */
        .topbar-container {
            position: relative;
            z-index: 1000;
        }
        
        /* Ensure user dropdown appears above everything */
        .user-dropdown {
            z-index: 99999 !important;
        }
        
        /* Force dropdown to be on top of everything */
        .user-dropdown [x-show] {
            z-index: 99999 !important;
        }
        
        /* Additional z-index fixes for dropdown */
        .user-dropdown > div {
            z-index: 99999 !important;
        }
        
        /* Ensure dropdown menu is always visible with fixed positioning */
        .user-dropdown .fixed {
            z-index: 999999 !important;
            position: fixed !important;
        }
        
        /* Override any conflicting z-index values */
        .user-dropdown * {
            z-index: 999999 !important;
        }
        
        /* Ensure the dropdown appears above everything */
        .user-dropdown [x-show] {
            position: fixed !important;
            z-index: 999999 !important;
        }
        
        /* Hide scrollbars */
        ::-webkit-scrollbar {
            display: none;
        }
        
        /* For Firefox */
        html {
            scrollbar-width: none;
        }
        
        /* Ensure scrolling still works */
        body {
            -ms-overflow-style: none;
        }
    </style>
</head>
<body class="flex h-screen" style="background-color: #D7C4E4;">

    <x-sidebar />


     <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-0 ml-64 relative">

        <div class="topbar-container">
            <x-topbar :title="$title ?? null" />
        </div>


 <!-- Page Content -->
        <main class="flex-1 min-h-0 p-6 overflow-y-auto" style="background-color: #D7C4E4;">
            {{ $slot }}
        </main>
    </div>

    
</body>
</html>