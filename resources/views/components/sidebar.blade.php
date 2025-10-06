<aside class="fixed left-0 top-0 z-50 h-screen w-64 bg-gray-800 shadow-xl">
    <!-- Logo -->
    <div class="flex items-center gap-3 border-b border-gray-700 px-6 py-5">
        <img 
            src="{{ asset('storage/images/lsrs_logo.png') }}" 
            alt="LSRS Logo" 
            class="h-12 w-12 object-contain"
        >
        <div class="flex flex-col">
            <span class="text-sm font-bold text-white">Love & Styles</span>
            <span class="text-xs text-gray-400">Rental System</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col gap-1 p-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : '' }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Rentals with Dropdown -->
        <div class="rentals-dropdown-container">
            <button id="rentals-toggle" 
                    class="sidebar-link flex w-full items-center justify-between gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('rentals.*') || request()->routeIs('release.*') || request()->routeIs('return.*') ? 'bg-gray-700 text-white' : '' }}">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="font-medium">Rentals</span>
                </div>
                <svg id="rentals-arrow" class="h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <!-- Dropdown Items -->
            <div id="rentals-dropdown" class="rentals-dropdown-content ml-4 mt-1 space-y-1" style="display: none;">
                <!-- All Rentals -->
                <a href="{{ route('rentals.index') }}" 
                   class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-gray-400 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('rentals.index') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="font-medium">All Rentals</span>
                </a>
                
                <!-- Release -->
                <a href="{{ route('release.index') }}" 
                   class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-gray-400 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('release.*') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span class="font-medium">Release</span>
                </a>
                
                <!-- Return -->
                <a href="{{ route('return.index') }}" 
                   class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-gray-400 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('return.*') ? 'bg-gray-700 text-white' : '' }}">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                    </svg>
                    <span class="font-medium">Return</span>
                </a>
            </div>
        </div>

        <!-- Billing -->
        <a href="{{ route('billing.index') }}" 
           class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('billing.*') ? 'bg-gray-700 text-white' : '' }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">Billing</span>
        </a>

        <!-- Inventory -->
        <a href="{{ route('inventory.index') }}" 
           class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('inventory.*') ? 'bg-gray-700 text-white' : '' }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <span class="font-medium">Inventory</span>
        </a>

        <!-- Customer -->
        <a href="{{ route('customer.index') }}" 
           class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('customer.*') ? 'bg-purple-600 text-white' : '' }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <span class="font-medium">Customer</span>
        </a>

        <!-- Bookings -->
        <a href="{{ route('bookings.index') }}" 
           class="sidebar-link flex items-center gap-3 rounded-lg px-4 py-3 text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('bookings.*') ? 'bg-gray-700 text-white' : '' }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="font-medium">Bookings</span>
        </a>
     </nav>
 </aside>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rentalsToggle = document.getElementById('rentals-toggle');
    const rentalsDropdown = document.getElementById('rentals-dropdown');
    const rentalsArrow = document.getElementById('rentals-arrow');
    
    // Check if we're on a rentals-related page
    const isRentalsPage = {{ request()->routeIs('rentals.*') || request()->routeIs('release.*') || request()->routeIs('return.*') ? 'true' : 'false' }};
    
    // Initialize dropdown state immediately
    if (isRentalsPage) {
        rentalsDropdown.style.display = 'block';
        rentalsDropdown.style.opacity = '1';
        rentalsDropdown.style.transform = 'scale(1)';
        rentalsArrow.style.transform = 'rotate(180deg)';
    } else {
        rentalsDropdown.style.display = 'none';
        rentalsDropdown.style.opacity = '0';
        rentalsDropdown.style.transform = 'scale(0.95)';
        rentalsArrow.style.transform = 'rotate(0deg)';
    }
    
    // Add CSS transitions
    rentalsDropdown.style.transition = 'opacity 0.2s ease-out, transform 0.2s ease-out';
    
    // Toggle dropdown
    rentalsToggle.addEventListener('click', function(e) {
        e.preventDefault();
        
        const isOpen = rentalsDropdown.style.display === 'block';
        
        if (isOpen) {
            // Close dropdown
            rentalsDropdown.style.opacity = '0';
            rentalsDropdown.style.transform = 'scale(0.95)';
            rentalsArrow.style.transform = 'rotate(0deg)';
            
            setTimeout(() => {
                rentalsDropdown.style.display = 'none';
            }, 200);
        } else {
            // Open dropdown
            rentalsDropdown.style.display = 'block';
            rentalsDropdown.style.opacity = '0';
            rentalsDropdown.style.transform = 'scale(0.95)';
            
            // Force reflow
            rentalsDropdown.offsetHeight;
            
            rentalsDropdown.style.opacity = '1';
            rentalsDropdown.style.transform = 'scale(1)';
            rentalsArrow.style.transform = 'rotate(180deg)';
        }
    });
});
</script>
