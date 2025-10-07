<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love & Styles Rental System</title>

    <link rel="shortcut icon" href="{{ asset('storage/images/lsrs_logo.png') }}?v=1" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>
<body class="h-screen flex flex-col overflow-hidden">

    <!-- Hero Section -->
    <section class="relative flex-1">

        <!-- Background Collage -->
        <div class="absolute inset-0">
            <img src="{{ asset('storage/images/container.png') }}" alt="Collage" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/30"></div>
        </div>

        <!-- Content Wrapper -->
        <div class="relative h-full flex items-center justify-between px-16 z-10">
            
            <!-- Left: Image + Tagline -->
            <div class="relative flex flex-col justify-center text-white max-w-3xl">
                <!-- Larger Image -->
                <img src="{{ asset('storage/images/main_visual.png') }}" 
                    alt="Model" 
                    class="w-[150%] max-w-none drop-shadow-2xl relative z-0 left-[-20%] ">

                <!-- Quote Text Overlapping the Image -->
                <h2 class="absolute top-180 left-4 text-6xl md:text-7xl font-bold leading-tight font-inria z-10 drop-shadow-lg">
                    Your Trusted Partner<br>in Timeless Style.
                </h2>
            </div>


            <!-- Right: Login Card -->
            <div class="flex items-center -mt-90 mr-2">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer Badge - Bottom Right Corner -->
        <div class="absolute right-8 bg-white rounded-2xl py-4 px-6 flex items-center space-x-4 shadow-2xl max-w-md -mt-80 mr-2">

            <img src="{{ asset('storage/images/pod_logo.png') }}" alt="Logo" class="w-14 h-14 flex-shrink-0">
            <p class="text-gray-800 text-sm leading-relaxed">
                Most trusted by people for delivering timeless style and elegant formal wear 
                for every occasion.
            </p>
        </div>
    </section>

</body>
</html>