<x-layout title="View Customer">
    <div class="max-w-6xl mx-auto p-4 md:p-5">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-5 md:px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Customer Details</h2>
                <p class="text-xs md:text-sm text-gray-600 mt-1">View customer information and measurements</p>
            </div>

            <div class="p-5 md:p-6">
              
                @if($customer)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left side: Customer Info -->
                        <div class="space-y-4">
                            <div class="pb-2 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->full_name ?? 'User') }}&background=random&color=fff&size=128" alt="Customer" class="w-16 h-16 rounded-full border">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ $customer->full_name }}</h4>
                                        <p class="text-sm text-gray-600">Customer ID: {{ $customer->customer_id }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Email:</span>
                                        <span class="text-sm text-gray-900">{{ $customer->email }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Contact Number:</span>
                                        <span class="text-sm text-gray-900">{{ $customer->contact_number }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Address:</span>
                                        <span class="text-sm text-gray-900">{{ $customer->address }}</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Status:</span>
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side: Measurements -->
                        <div class="space-y-4">
                            <div class="bg-gradient-to-br from-slate-50 to-gray-50 p-5 rounded-xl border border-gray-200 shadow-sm">
                                <div class="flex items-center gap-2 pb-3 border-b border-gray-200 mb-4">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900">Measurements</h3>
                                </div>

                                @php
                                    $measurements = is_array($customer->measurement) ? $customer->measurement : (is_string($customer->measurement) ? json_decode($customer->measurement, true) : []);
                                @endphp
                                <div class="space-y-3">
                                    @if(!empty($measurements['size']))
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Size:</span>
                                        <span class="text-sm text-gray-900">{{ $measurements['size'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['height']))
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Height:</span>
                                        <span class="text-sm text-gray-900">{{ $measurements['height'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['chest']))
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Chest:</span>
                                        <span class="text-sm text-gray-900">{{ $measurements['chest'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['waist']))
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Waist:</span>
                                        <span class="text-sm text-gray-900">{{ $measurements['waist'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['hips']))
                                    <div>
                                        <span class="text-sm font-medium text-gray-600">Hips:</span>
                                        <span class="text-sm text-gray-900">{{ $measurements['hips'] }}</span>
                                    </div>
                                    @endif
                                    @if(empty(array_filter($measurements)))
                                    <p class="text-gray-500 text-sm">No measurements recorded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental History Section -->
                    <div class="mt-8">
                        <div class="bg-gradient-to-br from-slate-50 to-gray-50 p-5 rounded-xl border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-2 pb-3 border-b border-gray-200 mb-4">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01M9 12h.01M12 12h.01M15 12h.01M12 8h.01M9 8h.01M7 8h.01"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900">Rental History</h3>
                            </div>

                            <!-- Rental History Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-700">
                                            <th class="px-4 py-3 text-left text-sm font-medium">Rental ID</th>
                                            <th class="px-4 py-3 text-left text-sm font-medium">Item</th>
                                            <th class="px-4 py-3 text-left text-sm font-medium">Rental Date</th>
                                            <th class="px-4 py-3 text-left text-sm font-medium">Return Date</th>
                                            <th class="px-4 py-3 text-left text-sm font-medium">Status</th>
                                            <th class="px-4 py-3 text-left text-sm font-medium">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @php
                                            $statusColors = [
                                                'Active' => 'bg-blue-100 text-blue-800',
                                                'Completed' => 'bg-green-100 text-green-800',
                                                'Overdue' => 'bg-red-100 text-red-800',
                                                'Cancelled' => 'bg-gray-100 text-gray-800',
                                                'Returned' => 'bg-purple-100 text-purple-800'
                                            ];
                                        @endphp
                                        @if($rentals->count() > 0)
                                            @foreach($rentals as $rental)
                                                <tr>
                                                    <td class="px-4 py-3 text-sm text-gray-900">#R{{ str_pad($rental->rental_id, 3, '0', STR_PAD_LEFT) }}</td>
                                                    <td class="px-4 py-3 text-sm text-gray-900">
                                                        {{ $rental->reservation->item->name ?? 'Unknown Item' }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-900">
                                                        {{ $rental->released_date->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-900">
                                                        {{ $rental->return_date ? $rental->return_date->format('M d, Y') : '—' }}
                                                    </td>
                                                    <td class="px-4 py-3">
                                                        @php
                                                            $statusColor = $statusColors[$rental->status->status_name] ?? 'bg-gray-100 text-gray-800';
                                                        @endphp
                                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                                            {{ $rental->status->status_name }}
                                                        </span>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-900">
                                                        ₱{{ number_format($rental->payments->sum('amount'), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                                    <div class="flex flex-col items-center">
                                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                        </svg>
                                                        <p class="text-sm">No rental history found</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Rental Statistics -->
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-blue-100 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-600">Total Rentals</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $totalRentals }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-green-100 rounded-lg">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-600">Total Spent</p>
                                            <p class="text-lg font-semibold text-gray-900">₱{{ number_format($totalSpent, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg border border-gray-200">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-yellow-100 rounded-lg">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-600">Active Rentals</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $activeRentals }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('customers.index') }}" 
                        class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                            Back to List
                        </a>
                        <a href="{{ route('customers.edit', $customer->customer_id) }}"
                        class="inline-flex items-center justify-center px-6 py-2.5 border border-slate-600 rounded-lg text-sm font-medium text-white bg-slate-600 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                            Edit
                        </a>
                    </div>
                @else
                    <p class="text-red-600">Customer not found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>