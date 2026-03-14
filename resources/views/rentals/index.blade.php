<x-layout :title="$title">

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}" background="bg-white">
            <h3 class="text-sm text-black">Total Customers</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}" background="bg-white">
            <h3 class="text-sm text-black">Total Customers</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}" background="bg-white">
            <h3 class="text-sm text-black">Total Customers</h3>
        </x-kpi-card>
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}" background="bg-white">
            <h3 class="text-sm text-black">Total Customers</h3>
        </x-kpi-card>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-lg shadow-md mb-6">

        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <div>
                <h2 class="text-base font-semibold text-gray-900">All Rentals</h2>
                <p class="text-xs text-gray-400 mt-0.5">View and manage all rental inventory</p>
            </div>
        </div>

        {{-- Search + Filters --}}
        <div class="px-4 py-3 border-b border-gray-100">
            <form method="GET" action="{{ route('rentals.index') }}" class="flex flex-col md:flex-row gap-3 items-end">

                {{-- Search Input --}}
                <div class="flex-1 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Search by name, size or category..."
                           class="w-full border border-gray-200 rounded-lg pl-9 pr-9 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    @if(request('q'))
                        <a href="{{ route('rentals.index', array_filter(request()->except('page', 'q'))) }}"
                           class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </div>

                {{-- Status Filter --}}
                <div class="w-full md:w-44">
                    <select name="status"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">All Statuses</option>
                        <option value="Active"   {{ request('status') == 'Active'   ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200">
                    Search
                </button>

                {{-- Reset --}}
                <a href="{{ route('rentals.index') }}"
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm rounded-lg transition-colors duration-200">
                    Reset
                </a>

            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Rental ID</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Customer Name</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Attire</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Release Date</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Expected Return Date</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Actual Return Date</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Penalty</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Status</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    {{-- @forelse($rentals as $rental) --}}
                    <tr class="hover:bg-gray-50 transition-colors duration-100">
                        <td class="py-3 px-4 font-semibold text-gray-900">Sample Item</td>
                        <td class="py-3 px-4 text-gray-600">Tuxedo</td>
                        <td class="py-3 px-4 text-gray-600">M</td>
                        <td class="py-3 px-4 text-gray-600">P3000</td>
                        <td class="py-3 px-4">
                            <span class="text-green-600 font-medium">Active</span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors duration-150" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <button class="text-gray-400 hover:text-red-500 transition-colors duration-150" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    {{-- @empty
                    <tr>
                        <td colspan="6" class="py-8 px-4 text-center text-gray-400">No rentals found.</td>
                    </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>

        {{-- Pagination (uncomment when ready) --}}
        {{-- @if($rentals->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $rentals->links() }}
        </div>
        @endif --}}

    </div>

</x-layout>