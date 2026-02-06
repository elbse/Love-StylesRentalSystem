<x-layout :title="$title">
<script src="//unpkg.com/alpinejs" defer></script>
<style>
[x-cloak]{ display: none !important; }

/* Modal Overlay Fix */
.modal-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    z-index: 9999 !important;
}

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
    <div x-data="{ 
        show: true, 
        countdown: 5,
        startCountdown() {
            this.countdown = 5;
            const timer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    this.show = false;
                    clearInterval(timer);
                }
            }, 1000);
        }
    }" 
         x-init="startCountdown()"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mx-4 mb-6 p-5 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg" 
         role="status" 
         aria-live="polite">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
                <div class="p-2 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-green-800">Operation Successful!</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full" x-text="`Auto-close in ${countdown}s`"></span>
                        <button @click="show = false" class="text-green-600 hover:text-green-800 transition-colors duration-200 p-1 rounded-full hover:bg-green-100">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div x-data="{ 
        show: true, 
        countdown: 6,
        startCountdown() {
            this.countdown = 6;
            const timer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    this.show = false;
                    clearInterval(timer);
                }
            }, 1000);
        }
    }" 
         x-init="startCountdown()"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mx-4 mb-6 p-5 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg" 
         role="alert" 
         aria-live="polite">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
                <div class="p-2 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-red-800">Operation Failed!</h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full" x-text="`Auto-close in ${countdown}s`"></span>
                        <button @click="show = false" class="text-red-600 hover:text-red-800 transition-colors duration-200 p-1 rounded-full hover:bg-red-100">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div x-data="{ 
        show: true, 
        countdown: 8,
        startCountdown() {
            this.countdown = 8;
            const timer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    this.show = false;
                    clearInterval(timer);
                }
            }, 1000);
        }
    }" 
         x-init="startCountdown()"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mx-4 mb-6 p-5 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg" 
         role="alert" 
         aria-live="polite">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <div class="p-2 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-red-800">
                        @if($errors->has('password'))
                            Authentication Failed
                        @else
                            Validation Errors
                        @endif
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full" x-text="`Auto-close in ${countdown}s`"></span>
                        <button @click="show = false" class="text-red-600 hover:text-red-800 transition-colors duration-200 p-1 rounded-full hover:bg-red-100">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                @if($errors->has('password'))
                    <div class="space-y-3">
                        <p class="text-sm text-red-700">
                            <strong>Password Verification Failed:</strong> The password you entered is incorrect.
                        </p>
                        <div class="bg-red-100 border border-red-200 rounded-lg p-3">
                            <h4 class="text-sm font-medium text-red-800 mb-2">What to do next:</h4>
                            <ul class="text-xs text-red-700 space-y-1">
                                <li class="flex items-start gap-2">
                                    <span class="text-red-500 mt-1">•</span>
                                    <span>Double-check your password and try again</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-red-500 mt-1">•</span>
                                    <span>Make sure Caps Lock is not enabled</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-red-500 mt-1">•</span>
                                    <span>Contact your administrator if you've forgotten your password</span>
                                </li>
                            </ul>
                        </div>
                        <p class="text-xs text-red-600">
                            <strong>Security Note:</strong> This action requires password verification to prevent unauthorized changes to customer accounts.
                        </p>
                    </div>
                @else
                    <div class="space-y-2">
                        <p class="text-sm text-red-700 mb-3">
                            <strong>Please correct the following issues:</strong>
                        </p>
                        <ul class="space-y-2">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-700 flex items-start gap-2">
                                    <span class="text-red-500 mt-1">•</span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
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
                        {{ is_array($m) ? ($m['size'] ?? ($m['chest'] ?? '—')) : '—' }}
                    </td>
                   <td class="px-4 py-3 text-center">

                <div x-data="{ open: false }" class="flex justify-center">
                    <x-action-button 
                        :entity-id="$customer->customer_id"
                        :entity-name="$customer->full_name"
                        :entity-email="$customer->email"
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

<!-- Premium Action Modal with Theme Integration -->
<div 
    x-data="{ 
        open: false, 
        customerId: '', 
        customerName: '',
        customerEmail: '',
        mode: 'deactivate',
        deactivateUrl: '{{ route('customers.deactivate') }}',
        reactivateUrl: '{{ route('customers.reactivate') }}',
        isLoading: false,
        showPassword: false,
        passwordError: false,
        password: ''
    }" 
    
    x-on:open-deactivate-modal.window=" 
        open = true; 
        customerId = $event.detail.id; 
        customerName = $event.detail.name; 
        customerEmail = $event.detail.email || '';
        mode = (window.customerStatusMap && (window.customerStatusMap[customerId] === 'Deactivated' || window.customerStatusMap[customerId] === 'Inactive')) ? 'reactivate' : 'deactivate';
        isLoading = false;
        passwordError = false;
        password = '';
    " 
    x-cloak 
    class="modal-overlay flex items-center justify-center bg-black/50 backdrop-blur-sm" 
    x-show="open"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click.self="open = false"
>
    <div 
        class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 transform transition-all duration-500 overflow-hidden relative z-[10000]"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 scale-90 translate-y-8"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-90 translate-y-8"
    >
        <!-- Gradient Header -->
        <div class="relative px-8 py-6 text-white overflow-hidden"
             :class="mode === 'reactivate' ? 'bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500' : 'bg-gradient-to-r from-red-500 via-rose-500 to-pink-500'">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 20px 20px;"></div>
            </div>
            
            <div class="relative flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/20 backdrop-blur-sm rounded-2xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="mode === 'reactivate'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            <path x-show="mode !== 'reactivate'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold" 
                            x-text="mode === 'reactivate' ? 'Reactivate Customer' : 'Deactivate Customer'">
                        </h2>
                        <p class="text-white/80 text-sm">Customer Management Action</p>
                    </div>
                </div>
                <button @click="open = false" 
                        class="p-2 hover:bg-white/20 rounded-xl transition-all duration-200 backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="px-8 py-6">
            <!-- Customer Info Card -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-6 mb-6 border border-purple-100">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode('Customer') }}&background=C16BFF&color=fff&size=64" 
                             alt="Customer" class="w-16 h-16 rounded-2xl border-4 border-white shadow-lg">
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-2 border-white flex items-center justify-center"
                             :class="mode === 'reactivate' ? 'bg-green-500' : 'bg-red-500'">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path x-show="mode === 'reactivate'" fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                <path x-show="mode !== 'reactivate'" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900" x-text="customerName"></h3>
                        <p class="text-purple-600 font-medium" x-text="customerEmail" x-show="customerEmail"></p>
                        <div class="flex items-center mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                ID: <span x-text="customerId"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Description -->
            <div class="mb-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg"
                             :class="mode === 'reactivate' ? 'bg-gradient-to-r from-green-400 to-emerald-500' : 'bg-gradient-to-r from-red-400 to-rose-500'">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="mode === 'reactivate'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                <path x-show="mode !== 'reactivate'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-gray-900 mb-2" 
                            x-text="mode === 'reactivate' ? 'Reactivation Details' : 'Deactivation Details'">
                        </h4>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-700 leading-relaxed">
                                <span x-show="mode !== 'reactivate'">
                                    <span class="font-semibold text-red-600">Deactivation</span> will prevent this customer from making new reservations and rentals. Existing active rentals will remain unaffected.
                                </span>
                                <span x-show="mode === 'reactivate'">
                                    <span class="font-semibold text-green-600">Reactivation</span> will restore full access for this customer to make new reservations and rentals in the system.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Verification -->
            <form method="POST" 
                  x-bind:action="mode === 'reactivate' ? reactivateUrl : deactivateUrl" 
                  @submit="isLoading = true; passwordError = false"
                  @submit.prevent="
                    if (password.length < 1) {
                        passwordError = true;
                        isLoading = false;
                        return;
                    }
                    $el.submit();
                  ">
                @csrf
                <input type="hidden" name="customer_id" x-model="customerId">
                <input type="hidden" name="customer_name" x-model="customerName">

                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-900 mb-3">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Password Verification
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                x-model="password"
                                :type="showPassword ? 'text' : 'password'"
                                class="w-full px-6 py-4 border-2 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-lg"
                                :class="passwordError ? 'border-red-300 bg-red-50' : 'border-gray-300 hover:border-purple-300'"
                                placeholder="Enter your password to confirm" 
                                required
                                @input="passwordError = false"
                            >
                            <button type="button" 
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-purple-600 transition-colors duration-200">
                                <svg x-show="!showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPassword" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                                </svg>
                            </button>
                        </div>
                        <div x-show="passwordError" class="mt-2 p-3 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-sm text-red-700 font-medium">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Password is required to confirm this action.
                            </p>
                        </div>
                        <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-xl">
                            <p class="text-xs text-blue-700 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="font-medium">Security Notice:</span> This action requires password verification to prevent unauthorized changes to customer accounts.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <button type="button" 
                            @click="open = false" 
                            :disabled="isLoading"
                            class="px-6 py-3 text-sm font-bold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-500/20 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        Cancel
                    </button>
                    <button type="submit" 
                            :disabled="isLoading || password.length < 1"
                            class="px-8 py-3 text-sm font-bold text-white rounded-xl focus:outline-none focus:ring-4 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-3 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                            :class="mode === 'reactivate' ? 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:ring-green-500/20' : 'bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 focus:ring-red-500/20'">
                        <svg x-show="isLoading" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span x-text="isLoading ? 'Processing...' : (mode === 'reactivate' ? 'Confirm Reactivation' : 'Confirm Deactivation')"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


</x-layout>
