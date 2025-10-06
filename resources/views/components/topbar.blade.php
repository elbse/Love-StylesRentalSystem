<!-- Top Bar -->
<header class="relative flex items-center justify-between bg-white/0 shadow px-6 py-3 h-[94px] overflow-hidden">
    <!-- Background Image -->
    <img src="{{ asset('storage/images/topbar_background.png') }}" 
        alt="Collage" 
        class="absolute inset-0 w-full h-full object-cover -z-10">

    <!-- Left: Page Title -->
    @props(['title' => null])

    @php
        $autoTitle = Route::currentRouteName()
            ? ucwords(str_replace('.', ' ', Route::currentRouteName()))
            : 'Default Title';
    @endphp

    <h1 class="flex items-center text-2xl font-semibold text-white relative z-10">
        {{ $title ?? $autoTitle }}
    </h1>

    <!-- Right: Actions -->
    <div class="flex items-center space-x-4 relative z-10">
        <button class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-bell"></i>
        </button>

        <button class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-cog"></i>
        </button>

        <!-- User Dropdown -->
        <div class="relative user-dropdown" x-data="{ 
            open: false,
            positionDropdown() {
                if (this.open) {
                    const button = this.$refs.button;
                    const dropdown = this.$refs.dropdown;
                    if (button && dropdown) {
                        const rect = button.getBoundingClientRect();
                        dropdown.style.top = (rect.bottom + 8) + 'px';
                        dropdown.style.right = (window.innerWidth - rect.right) + 'px';
                    }
                }
            }
        }" x-init="
            $watch('open', value => {
                if (value) {
                    $nextTick(() => positionDropdown());
                }
            });
        ">
            <button @click="open = !open" 
                    x-ref="button"
                    class="flex items-center space-x-2 text-white hover:text-gray-200 transition-colors duration-200">
                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <span class="font-medium">{{Auth::user()->name}}</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="fixed w-48 bg-white rounded-lg shadow-xl py-1 z-[999999]"
                 style="display: none; top: 100px; right: 20px;"
                 x-ref="dropdown">
                
                <!-- User Info -->
                <div class="px-4 py-2 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">{{Auth::user()->name}}</p>
                    <p class="text-xs text-gray-500">{{Auth::user()->email}}</p>
                </div>
                
                <!-- Profile Link -->
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile
                </a>
                
                <!-- Settings Link -->
                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Settings
                </a>
                
                <!-- Divider -->
                <div class="border-t border-gray-100 my-1"></div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
