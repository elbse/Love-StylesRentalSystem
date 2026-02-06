<div class="relative w-full rounded-2xl shadow-lg overflow-hidden {{ $background }} border border-gray-300">
    <!-- Header with title, search, and filter -->
    <div class="flex items-center justify-between gap-4 p-6">
        <!-- Title -->
        <h2 class="text-xl font-semibold text-gray-900">Active Rentals</h2>
        
        <!-- Search and Filter -->
        <div class="flex items-center gap-3">
            <!-- Search bar -->
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Search by customer, item, or ID..." 
                    class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <!-- Filter dropdown -->
            <div class="relative">
                <select class="appearance-none pl-4 pr-9 py-2 border border-gray-300 rounded-lg bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                    <option value="">Filter Status</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="overdue">Overdue</option>
                </select>
                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-600 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Content section -->
    <div class="relative text-white">
        {{ $slot }}
    </div>
</div>