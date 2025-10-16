<div class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden relative p-3">
  <div class="relative">
    <img src="{{ asset('storage/images/red-ball-gown.jpg') }}" alt="Red Ball Gown" class="w-full h-64 object-cover rounded-lg">
    <span class="absolute top-2 right-2 w-3 h-3 bg-green-500 rounded-full"></span>
  </div>
  <div class="mt-3">
    <h2 class="text-lg font-semibold text-gray-800">Red Ball Gown 
      <span class="text-sm text-gray-500 italic font-normal">Small</span>
    </h2>
    <p class="text-sm text-gray-500">RG001</p>
    <p class="text-xl font-bold text-purple-600 mt-1">3,000Php</p>
  </div>
  <div class="flex justify-between mt-3">
    <button class="bg-purple-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-purple-700 transition">
      Reserve
    </button>
    <button class="border border-gray-400 text-gray-700 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition">
      View
    </button>
  </div>

  <div class="relative text-white">
    {{ $slot }}
  </div>
</div>
@props([
    'image' => 'red-ball-gown.jpg',
    'name' => 'Red Ball Gown',
    'size' => 'Small',
    'code' => 'RG001',
    'price' => '3,000Php',
    'status' => 'available', // available, reserved, out-of-stock
])