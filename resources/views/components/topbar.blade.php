<!-- Top Bar -->

<header class="relative flex items-center justify-between bg-white shadow px-6 py-3 h-[94px] overflow-hidden">
    <!-- Background Image -->

    <!-- Left: Page Title -->
    @props(['title' => null])

    @php
        $autoTitle = Route::currentRouteName()
            ? ucwords(str_replace('.', ' ', Route::currentRouteName()))
            : 'Default Title';
    @endphp

    <div class="flex flex-col">
        <h1 class="text-2xl font-semibold text-black">
            {{ $title ?? $autoTitle }}
        </h1>

        <p class="text-sm text-gray-600 mt-1">
            Welcome to Love & Styles Reservation System
        </p>
    </div>






    {{-- TODO --}}
    {{-- This section needs to be fix since it is unnecessary --}}

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
                
            </div>
        </div>
    </div>
</header>
