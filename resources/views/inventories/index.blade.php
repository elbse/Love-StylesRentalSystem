<x-layout :title="$title">

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
            <h3 class="text-sm text-black">Available</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
            <h3 class="text-sm text-black">Rented Out</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
            <h3 class="text-sm text-black">Reserved</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
            <h3 class="text-sm text-black">Total Items</h3>
        </x-kpi-card>
    </div>

    {{-- Inventory Section --}}
    <div class="bg-white rounded-lg shadow-md mb-6">

        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <div>
                <h2 class="text-base font-semibold text-gray-900">All Items</h2>
                <p class="text-xs text-gray-400 mt-0.5">View and manage all inventory items</p>
            </div>
            <button
                onclick="document.getElementById('itemModal').classList.remove('hidden')"
                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Add Item
            </button>
        </div>

        {{-- Search --}}
        <div class="px-4 py-3 border-b border-gray-100">
            <form method="GET" action="">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Search by attire name..."
                           class="w-full border border-gray-200 rounded-lg pl-9 pr-9 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    @if(request('q'))
                        <a href="{{ route('inventories.index', array_filter(request()->except('page', 'q'))) }}"
                           class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Item Cards --}}
        <div class="p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                <x-item-card
                    image="red-ball-gown.jpg"
                    name="Red Ball Gown"
                    size="Small"
                    code="RG001"
                    price="3,000Php"
                    status="available"
                />
                {{-- Loop your items here later: @foreach($items as $item) <x-item-card ... /> @endforeach --}}
            </div>
        </div>

    </div>

    {{-- Modal Overlay --}}
    <div id="itemModal"
         class="hidden fixed inset-0 z-50 flex items-center justify-center"
         onclick="if(event.target === this) closeItemModal()">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>

        {{-- Modal Card --}}
        <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6">

            {{-- Close Button --}}
            <button
                onclick="closeItemModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            {{-- Modal Header --}}
            <div class="mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Add New Attire</h3>
                <p class="text-xs text-gray-400 mt-0.5">Enter attire details</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('inventories.store') }}">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Attire Name</label>
                        <input type="text" name="attire_name" placeholder="Classic Tuxedo Set"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Category</label>
                        <input type="text" name="category" placeholder="Suit"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Size</label>
                        <input type="text" name="size" placeholder="Large"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Color</label>
                        <input type="text" name="color" placeholder="Black"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Rental Fee</label>
                        <input type="number" name="rental_fee" placeholder="1200"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Condition</label>
                    <input type="text" name="condition" placeholder="Good"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" onclick="closeItemModal()"
                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200">
                        Add Attire
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeItemModal() {
            document.getElementById('itemModal').classList.add('hidden');
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeItemModal();
        });
    </script>

</x-layout>