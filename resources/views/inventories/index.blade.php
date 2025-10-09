<x-layout :title="$title">

 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 mb-6">
        <!-- Total Customers -->
        <x-kpi-card icon="fas fa-users" color="bg-[#C16BFF]" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-gradient-to-r from-[#C16BFF] to-[#6A0DAD]">
            <h3 class="text-sm text-gray-200">Total Customers</h3>
            {{-- <p class="text-3xl font-bold">{{ number_format($totalCustomers) }}</p>
            <p class="text-sm text-gray-300">{{ $newCustomersThisMonth }} new this month</p> --}}
        </x-kpi-card>

        <!-- Active Customers -->
        <x-kpi-card icon="fas fa-user-check" color="bg-[#A4B1FF]" symbol="{{ asset('storage/images/vector_cash.png') }}"  background="bg-gradient-to-r from-[#A4B1FF] to-[#5E72E4]">
            <h3 class="text-sm text-gray-200">Active Customers</h3>
            {{-- <p class="text-3xl font-bold">{{ number_format($activeCustomers) }}</p>
            <p class="text-sm text-gray-300">{{ $totalCustomers > 0 ? round(($activeCustomers / $totalCustomers) * 100, 1) : 0 }}% of total</p> --}}
        </x-kpi-card>

        <!-- Active Rentals -->
        <x-kpi-card icon="fas fa-tshirt" color="bg-[#77FF90]" symbol="{{ asset('storage/images/vector_check.png') }}"  background="bg-gradient-to-r from-[#77FF90] to-[#35B73E]">
            <h3 class="text-sm text-gray-200">Active Rentals</h3>
            {{-- <p class="text-3xl font-bold">{{ number_format($activeRentals) }}</p>
            <p class="text-sm text-gray-300">{{ $totalRentals > 0 ? round(($activeRentals / $totalRentals) * 100, 1) : 0 }}% of total</p> --}}
        </x-kpi-card>

        <!-- Overdue Rentals -->
        <x-kpi-card icon="fas fa-exclamation-triangle" color="bg-[#FF6B6B]" symbol="{{ asset('storage/images/vector_sms.png') }}"  background="bg-gradient-to-r from-[#FF6B6B] to-[#E53E3E]">
            <h3 class="text-sm text-gray-200">Overdue Rentals</h3>
            {{-- <p class="text-3xl font-bold">{{ number_format($overdueRentals) }}</p>
            <p class="text-sm text-gray-300">{{ $activeRentals > 0 ? round(($overdueRentals / $activeRentals) * 100, 1) : 0 }}% of active</p> --}}
        </x-kpi-card>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <form method="GET" action="{{ route('customers.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <!-- Search Input -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Inventory</label>
                <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </span>
                    <input type="text" 
                           id="search"
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Search by name, email, or contact" 
                           class="w-full border border-gray-300 rounded-lg pl-10 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
            @if(request('q'))
                        <a href="{{ route('customers.index', array_filter(request()->except('page', 'q'))) }}" 
                           class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600" 
                           title="Clear search">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif
        </div>
            </div>


</x-layout>