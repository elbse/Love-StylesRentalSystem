<x-layout :title="$title">
<script src="//unpkg.com/alpinejs" defer></script>
<style>
[x-cloak]{ display: none !important; }

/* Custom Pagination Styling */
.pagination-wrapper .pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 4px;
}

.pagination-wrapper .pagination li {
    display: inline-block;
}

.pagination-wrapper .pagination a,
.pagination-wrapper .pagination span {
    display: inline-block;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
}

.pagination-wrapper .pagination a:hover {
    background-color: #ecfdf5;
    border-color: #059669;
    color: #059669;
}

.pagination-wrapper .pagination .active span {
    background-color: #059669;
    border-color: #059669;
    color: white;
    font-weight: 600;
}

.pagination-wrapper .pagination .disabled span {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

.pagination-wrapper .pagination .disabled a {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

.pagination-wrapper .pagination .disabled a:hover {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
}
</style>


    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="m-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2 mb-6">
        <x-kpi-card icon="fas fa-calendar-check" color="bg-[#C16BFF]" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-gradient-to-r from-[#C16BFF] to-[#6A0DAD]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">120</p>
            <p class="text-sm text-gray-300">75%</p>
        </x-kpi-card>

        <x-kpi-card icon="fas fa-tshirt" color="bg-[#A4B1FF]" symbol="{{ asset('storage/images/vector_cash.png') }}"  background="bg-gradient-to-r from-[#A4B1FF] to-[#5E72E4]">
            <h3 class="text-sm text-gray-200">Formal Wears</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="fas fa-tshirt" color="bg-[#FF0000]" symbol="{{ asset('storage/images/vector_sms.png') }}"  background="bg-gradient-to-r from-[#FF0000] to-[#650606]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="{{ asset('storage/images/vector_check.png') }}" color="bg-[#77FF90]" symbol="{{ asset('storage/images/vector_check.png') }}"  background="bg-gradient-to-r from-[#77FF90] to-[#35B73E]">
            <h3 class="text-sm text-gray-200">Cancellation</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

    </div>

    <!-- Search and Filter Bar -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <form method="GET" action="{{ route('customers.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
            <!-- Search Input -->
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Customers</label>
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

            <!-- Status Filter -->
            <div class="w-full md:w-48">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Filter by Status</label>
                <select name="status" 
                        id="status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">All Statuses</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Deactivated" {{ request('status') == 'Deactivated' ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-2">
                <button type="submit" 
                        class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    Search
                </button>
                <a href="{{ route('customers.index') }}" 
                   class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="m-4 grid grid-cols-4 gap-8 -ml-1">

        <div class="bg-white rounded-xl shadow-md overflow-hidden col-span-3">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-4">
        <h2 class="text-xl font-semibold">Customers</h2>
    </div>

    

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-purple-100 text-gray-700">
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Contact No.</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Size</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customers as $customer)

                
                <tr>
                    <td class="px-4 py-3 flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->full_name ?? 'User') }}&background=random&color=fff&size=64" alt="User" class="w-8 h-8 rounded-full border">
                        <span>{{ $customer->full_name }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $customer->contact_number }}</td>
                    <td class="px-4 py-3">{{ $customer->email }}</td>
                    <td class="px-4 py-3">
                        @php
                            $statusColors = [
                                'Active' => 'bg-green-600 text-white',
                                'Deactivated' => 'bg-gray-500 text-white',
                                'Inactive' => 'bg-gray-500 text-white',
                                'Pending' => 'bg-yellow-500 text-white',
                                'Cancelled' => 'bg-red-600 text-white',
                            ];
                            $status = $customer->status->status_name ?? 'Unknown';
                            $class = $statusColors[$status] ?? 'bg-blue-600 text-white';
                        @endphp

                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $class }}">
                            {{ $status }}
                        </span>
                    </td>



                    <td class="px-4 py-3">
                        @php($m = $customer->measurement)
                        {{ is_array($m) ? ($m['chest'] ?? ($m['size'] ?? '—')) : '—' }}
                    </td>
                   <td class="px-4 py-3 text-center">

                <div x-data="{ open: false }" class="flex justify-center">
                    <x-action-button 
                        :entity-id="$customer->customer_id"
                        :entity-name="$customer->full_name"
                        title="Customer Actions"
                        :actions="[
                            ['label' => 'View', 'url' => route('customers.show', $customer->customer_id), 'method' => 'GET'],
                            ['label' => 'Edit', 'url' => route('customers.edit', $customer->customer_id), 'method' => 'GET'],
                            ((($customer->status->status_name ?? '') === 'Deactivated') || (($customer->status->status_name ?? '') === 'Inactive'))
                                ? ['label' => 'Reactivate', 'method' => 'MODAL', 'full' => true]
                                : ['label' => 'Deactivate', 'method' => 'MODAL', 'full' => true],
                        ]"
                    />
                </div>
                </td>  

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No customers found.</td>
                </tr>
                @endforelse
            </tbody>
                </table>
            </div>
        </div>

        <x-action-panel class="col-start-1" />

    </div>

    <!-- Pagination and Results Info -->
    <div class="bg-white rounded-lg shadow-md p-4 mt-6">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
            <!-- Results Info -->
            <div class="text-sm text-gray-600">
                <span class="font-medium text-gray-900">Showing</span>
                <span class="font-semibold text-purple-600">{{ $customers->firstItem() ?? 0 }}</span>
                <span class="font-medium text-gray-900">to</span>
                <span class="font-semibold text-purple-600">{{ $customers->lastItem() ?? 0 }}</span>
                <span class="font-medium text-gray-900">of</span>
                <span class="font-semibold text-purple-600">{{ $customers->total() }}</span>
                <span class="font-medium text-gray-900">customers</span>
            </div>

            <!-- Pagination Controls -->
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- Rows per page selector -->
                <form method="GET" action="{{ route('customers.index') }}" class="flex items-center gap-2">
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <label for="per_page" class="text-sm font-medium text-gray-700">Rows per page:</label>
                    <select id="per_page" 
                            name="per_page" 
                            class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                            onchange="this.form.submit()">
                        <option value="5" {{ ($perPage ?? 10) == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ ($perPage ?? 10) == 15 ? 'selected' : '' }}>15</option>
                        <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25</option>
                    </select>
                </form>

                <!-- Pagination Links -->
                <div class="pagination-wrapper">
                    {{ $customers->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    

<script>
window.customerStatusMap = @json($customers->pluck('status.status_name','customer_id'));
</script>

<div 
    x-data="{ 
        open: false, 
        customerId: '', 
        customerName: '',
        mode: 'deactivate',
        deactivateUrl: '{{ route('customers.deactivate') }}',
        reactivateUrl: '{{ route('customers.reactivate') }}'
    }" 
    
    x-on:open-deactivate-modal.window=" 
        open = true; 
        customerId = $event.detail.id; 
        customerName = $event.detail.name; 
        mode = (window.customerStatusMap && (window.customerStatusMap[customerId] === 'Deactivated' || window.customerStatusMap[customerId] === 'Inactive')) ? 'reactivate' : 'deactivate';
    " 
    x-cloak 
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" 
    x-show="open"
>
    <div class="bg-white p-6 rounded-xl shadow-md w-96">
        <h2 class="text-lg font-bold mb-3" x-text="mode === 'reactivate' ? 'Reactivate Customer' : 'Deactivate Customer'"></h2>
        <p class="text-sm mb-4">
            <span x-show="mode !== 'reactivate'">Are you sure you want to deactivate </span>
            <span x-show="mode === 'reactivate'">Are you sure you want to reactivate </span>
            <span class="font-semibold" x-text="customerName"></span>?
        </p>

        <form method="POST" x-bind:action="mode === 'reactivate' ? reactivateUrl : deactivateUrl">
            @csrf
            <input type="hidden" name="customer_id" x-model="customerId">
            <input type="hidden" name="customer_name" x-model="customerName">

            <input 
                type="password" 
                name="password" 
                class="w-full border p-2 mb-3 rounded @error('password') border-red-500 @enderror" 
                placeholder="Enter your password" 
                required
            >
            @error('password')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror

            <div class="flex justify-end space-x-2">
                <button type="button" @click="open = false" class="px-3 py-1 bg-gray-300 rounded">
                    Cancel
                </button>
                <button type="submit" class="px-3 py-1 bg-yellow-500 text-white rounded" x-text="mode === 'reactivate' ? 'Confirm Reactivation' : 'Confirm Deactivation'"></button>
            </div>
        </form>
    </div>
</div>


</x-layout>
