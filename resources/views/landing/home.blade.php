<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Love & Styles Rental System</title>

    <link rel="shortcut icon" href="{{ asset('storage/images/lsrs_logo.png') }}?v=1" type="image/png">

    @vite('resources/css/app.css')
</head>
<body class="h-screen flex flex-col">

    <!-- Hero Section -->
    <section class="relative flex-1 flex">

        <!-- Background Collage -->
        <div class="absolute inset-0">
            <img src="{{ asset('storage/images/landing_background.png') }}" alt="Collage" 
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        {{-- <!-- Lady Image (Floating) -->
        <div class="absolute bottom-0 left-16 z-10">
        <img src="{{ asset('storage/images/landing_character.png') }}" 
         alt="Main Visual" 
         class="w-[500px] md:w-[650px] drop-shadow-2xl">
        </div> --}}


        <!-- Content (shifted to the right) -->
        <div class="relative flex flex-1 ml-[100px]">
            <!-- Left: Tagline -->
            <div class="flex flex-col justify-end p-12 text-white w-1/2">
                <h2 class="text-4xl md:text-5xl font-bold leading-snug">
                    Your Trusted Partner <br> in Timeless Style.
                </h2>
            </div>

            <!-- Right: Login Card -->
            
    </section>

    


    <!-- Footer Section -->
    <footer class="bg-white py-4 px-6 flex items-center justify-center space-x-4 shadow-inner">
        <img src="{{ asset('storage/images/pod_logo.png') }}" alt="Logo" class="w-12 h-12">
        <p class="text-gray-700 max-w-lg text-sm">
            Most trusted by people for delivering timeless style and elegant formal wear 
            for every occasion.
        </p>
    </footer>

</body>
</html>
