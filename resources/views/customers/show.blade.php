<x-layout title="View Customer">
    <div class="w-full p-4 md:p-5">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden relative">
            
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5 pointer-events-none" style="z-index: 1;">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, #6366f1 2px, transparent 2px), radial-gradient(circle at 75% 75%, #8b5cf6 2px, transparent 2px); background-size: 40px 40px;"></div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 px-5 md:px-6 py-6 border-b border-gray-200 relative">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-white">Customer Details</h2>
                        <p class="text-sm text-white/80 mt-1">View customer information and measurements</p>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 relative" style="background: linear-gradient(rgba(255,255,255,0.6), rgba(255,255,255,0.6)), url('{{ asset('storage/images/Vector_34.png') }}') no-repeat; background-size: 920px 620px; z-index: 2;">
                
                <!-- Overdue Rental Alert -->
                @if($customer->hasOverdueRentals())
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="mb-6 p-4 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg" 
                         role="alert" 
                         aria-live="polite">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-red-800">Overdue Rentals Alert</h3>
                                <p class="text-sm text-red-700 mt-1">This customer has {{ $customer->getOverdueRentals()->count() }} overdue rental(s) and cannot rent new items until all overdue items are returned.</p>
                            </div>
                            <button @click="show = false" class="flex-shrink-0 text-red-600 hover:text-red-800 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
              
                @if($customer)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
                        <!-- Left side: Customer Info -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-4 rounded-xl border border-purple-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div class="flex items-center space-x-4">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->full_name ?? 'User') }}&background=random&color=fff&size=128" alt="Customer" class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                                    <div>
                                        <h4 class="text-2xl font-bold text-gray-900">{{ $customer->full_name }}</h4>
                                        <p class="text-sm text-gray-600 font-medium">Customer ID: {{ $customer->customer_id }}</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-6 rounded-xl border border-gray-200 shadow-sm space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-semibold text-gray-600">Email:</span>
                                            <span class="text-sm text-gray-900 ml-2">{{ $customer->email }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-semibold text-gray-600">Contact Number:</span>
                                            <span class="text-sm text-gray-900 ml-2">{{ $customer->contact_number }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-semibold text-gray-600">Address:</span>
                                            <span class="text-sm text-gray-900 ml-2">{{ $customer->address }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-semibold text-gray-600">Status:</span>
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
                                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $class }} ml-2">
                                                {{ $status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side: Measurements -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-5 rounded-xl border border-emerald-200 shadow-sm">
                                <div class="flex items-center gap-3 pb-3 border-b border-emerald-200 mb-5">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900">Measurements</h3>
                                </div>

                                @php
                                    $measurements = is_array($customer->measurement) ? $customer->measurement : (is_string($customer->measurement) ? json_decode($customer->measurement, true) : []);
                                @endphp
                                <div class="space-y-4">
                                    @if(!empty($measurements['size']))
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                        <span class="text-sm font-semibold text-gray-600">Size:</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $measurements['size'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['height']))
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                        <span class="text-sm font-semibold text-gray-600">Height:</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $measurements['height'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['chest']))
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                        <span class="text-sm font-semibold text-gray-600">Chest:</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $measurements['chest'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['waist']))
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                        <span class="text-sm font-semibold text-gray-600">Waist:</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $measurements['waist'] }}</span>
                                    </div>
                                    @endif
                                    @if(!empty($measurements['hips']))
                                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                                        <span class="text-sm font-semibold text-gray-600">Hips:</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $measurements['hips'] }}</span>
                                    </div>
                                    @endif
                                    @if(empty(array_filter($measurements)))
                                    <div class="text-center p-6 bg-gray-50 rounded-lg border border-gray-200">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-gray-500 text-sm font-medium">No measurements recorded</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rental History Section -->
                    <div class="mt-8">
                        <div class="bg-gradient-to-br from-slate-50 to-gray-50 p-6 rounded-xl border border-gray-200 shadow-sm">
                            <div class="flex items-center gap-3 pb-4 border-b border-gray-200 mb-6">
                                <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01M9 12h.01M12 12h.01M15 12h.01M12 8h.01M9 8h.01M7 8h.01"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">Rental History</h3>
                            </div>

                            <!-- Rental History Table -->
                            <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
                                <table class="min-w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700">
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Rental ID</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Item</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Rental Date</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Return Date</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                                            <th class="px-6 py-4 text-left text-sm font-semibold">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @php
                                            $statusColors = [
                                                'Active' => 'bg-blue-100 text-blue-800',
                                                'Overdue' => 'bg-red-100 text-red-800',
                                                'Cancelled' => 'bg-gray-100 text-gray-800',
                                                'Returned' => 'bg-purple-100 text-purple-800'
                                            ];
                                        @endphp
                                        @if($rentals->count() > 0)
                                            @foreach($rentals as $rental)
                                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">#R{{ str_pad($rental->rental_id, 3, '0', STR_PAD_LEFT) }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $rental->reservation->item->name ?? 'Unknown Item' }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $rental->released_date->format('M d, Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 text-sm text-gray-900">
                                                        {{ $rental->return_date ? $rental->return_date->format('M d, Y') : '—' }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        @php
                                                            $statusColor = $statusColors[$rental->status->status_name] ?? 'bg-gray-100 text-gray-800';
                                                        @endphp
                                                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                                            {{ $rental->status->status_name }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                                        ₱{{ number_format($rental->payments->sum('amount'), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                                    <div class="flex flex-col items-center">
                                                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                        </svg>
                                                        <p class="text-lg font-medium text-gray-400">No rental history found</p>
                                                        <p class="text-sm text-gray-400 mt-1">This customer hasn't made any rentals yet</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Rental Statistics -->
                            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-blue-500 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-blue-600">Total Rentals</p>
                                            <p class="text-2xl font-bold text-blue-900">{{ $totalRentals }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border border-green-200 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-green-500 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-green-600">Total Spent</p>
                                            <p class="text-2xl font-bold text-green-900">₱{{ number_format($totalSpent, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl border border-yellow-200 shadow-sm">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-yellow-500 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-yellow-600">Active Rentals</p>
                                            <p class="text-2xl font-bold text-yellow-900">{{ $activeRentals }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 sm:justify-end">
                        <a href="{{ route('customers.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-3 border-2 border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-500/20 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to List
                        </a>
                        <a href="{{ route('customers.edit', $customer->customer_id) }}"
                           class="inline-flex items-center justify-center px-8 py-3 border-2 border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-purple-500/20 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Customer
                        </a>
                    </div>
                @else
                    <div class="text-center p-12">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Customer Not Found</h3>
                        <p class="text-gray-600 mb-6">The customer you're looking for doesn't exist or has been removed.</p>
                        <a href="{{ route('customers.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border-2 border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-purple-500/20 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Customers
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>