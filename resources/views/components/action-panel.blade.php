<div class="space-y-4">
    <!-- Management Section -->
    <div class="bg-gray-800 text-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-lg">Management</h3>
            <i class="fas fa-sliders-h text-gray-400"></i>
        </div>
        <div class="flex flex-row space-x-2">
            
            <x-button :href="route('customers.create')" class="w-xl hover:bg-purple-800 hover:text-black">New</x-button>
            <x-button :href="route('customers.create')" class="w-xl hover:bg-purple-800 hover:text-black">Reports</x-button>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-purple-700 text-white rounded-lg shadow-md p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold text-lg">Quick Actions</h3>
            <i class="fas fa-bolt"></i>
        </div>
        <div class="flex flex-col space-y-2">
            <x-button class="bg-purple-600 text-black hover:bg-purple-800 hover:text-black">Item</x-button>
            <x-button :href="route('bookings.index')" class="bg-purple-600 text-black hover:bg-purple-800 hover:text-black">Book</x-button>
            <x-button :href="route('billing.index')" class="bg-purple-600 text-black hover:bg-purple-800 hover:text-black">Pay</x-button>
            <x-button class="bg-purple-600 text-black hover:bg-purple-800 hover:text-black">Return</x-button>
        </div>
    </div>
</div>
