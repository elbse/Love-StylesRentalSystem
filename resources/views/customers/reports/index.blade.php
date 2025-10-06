<x-layout title="Customer Reports">
    <div class="max-w-7xl mx-auto p-4 md:p-6">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Customer Reports</h2>
                        <p class="text-sm text-gray-600 mt-1">Comprehensive analytics and insights</p>
                    </div>
                    <div class="flex space-x-3">
                        <!-- Date Range Filter -->
                        <form method="GET" action="{{ route('customers.reports.index') }}" class="flex items-center space-x-2">
                            <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <span class="text-gray-500">to</span>
                            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm">
                                Filter
                            </button>
                        </form>
                        
                        <form method="GET" action="{{ route('customers.reports.export') }}" class="inline">
                            <input type="hidden" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
                            <input type="hidden" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Export CSV
                            </button>
                        </form>
                        <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Customers
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Customers -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Customers</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($totalCustomers) }}</p>
                        <p class="text-sm text-green-600 mt-1">+{{ $newCustomersThisMonth }} this month</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Rentals -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Rentals</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($activeRentals) }}</p>
                        <p class="text-sm text-red-600 mt-1">{{ $overdueRentals }} overdue</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-900">₱{{ number_format($totalRevenue, 2) }}</p>
                        <p class="text-sm text-green-600 mt-1">₱{{ number_format($monthlyRevenue, 2) }} this month</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Average Rental Value -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Avg. Rental Value</p>
                        <p class="text-3xl font-bold text-gray-900">₱{{ number_format($averageRentalValue, 2) }}</p>
                        <p class="text-sm text-gray-600 mt-1">Per rental</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Trends Chart - Full Width -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Trends (Last 12 Months)</h3>
                <canvas id="monthlyTrendsChart" width="800" height="300"></canvas>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Rental Status Distribution -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Rental Status Distribution</h3>
                <canvas id="rentalStatusChart" width="400" height="200"></canvas>
            </div>

            <!-- Customer Status Distribution -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Status Distribution</h3>
                <canvas id="customerStatusChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Top Customers -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Customers by Revenue</h3>
                <div class="space-y-3">
                    @foreach($topCustomers as $index => $customerData)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-purple-600">#{{ $index + 1 }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $customerData['customer']->full_name }}</p>
                                    <p class="text-sm text-gray-600">{{ $customerData['rental_count'] }} rentals</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">₱{{ number_format($customerData['total_spent'], 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Overdue Rentals Section -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Overdue Rentals</h3>
                @if($overdueRentalsCollection->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Released Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Overdue</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penalty Fee</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($overdueRentalsCollection as $rental)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-red-600">
                                                            {{ substr($rental->reservation->customer->full_name ?? 'Unknown', 0, 2) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $rental->reservation->customer->full_name ?? 'Unknown Customer' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        ID: {{ $rental->reservation->customer->customer_id ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $rental->reservation->item->name ?? 'Unknown Item' }}</div>
                                            <div class="text-sm text-gray-500">{{ $rental->reservation->item->item_type ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $rental->released_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $rental->due_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                {{ now()->diffInDays($rental->due_date) }} days
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">
                                            ₱{{ number_format($rental->penalty_fee, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="mx-auto h-12 w-12 text-gray-400">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No Overdue Rentals</h3>
                        <p class="mt-1 text-sm text-gray-500">All rentals are up to date!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detailed Statistics -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Detailed Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600">{{ $completedRentals }}</p>
                        <p class="text-sm text-gray-600">Completed Rentals</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="p-4 bg-green-50 rounded-lg">
                        <p class="text-2xl font-bold text-green-600">{{ $activeCustomers }}</p>
                        <p class="text-sm text-gray-600">Active Customers</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <p class="text-2xl font-bold text-purple-600">{{ $totalItems }}</p>
                        <p class="text-sm text-gray-600">Total Items</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Trends Chart
        const monthlyData = @json($monthlyData);
        const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
        new Chart(monthlyTrendsCtx, {
            type: 'line',
            data: {
                labels: monthlyData.map(item => item.month),
                datasets: [
                    {
                        label: 'Customers',
                        data: monthlyData.map(item => item.customers),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Rentals',
                        data: monthlyData.map(item => item.rentals),
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Revenue (₱)',
                        data: monthlyData.map(item => item.revenue),
                        borderColor: 'rgb(245, 158, 11)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });

        // Rental Status Chart
        const rentalStatusData = @json($rentalStatusData->values());
        const rentalStatusCtx = document.getElementById('rentalStatusChart').getContext('2d');
        new Chart(rentalStatusCtx, {
            type: 'doughnut',
            data: {
                labels: rentalStatusData.map(item => item.status),
                datasets: [{
                    data: rentalStatusData.map(item => item.count),
                    backgroundColor: [
                        'rgb(59, 130, 246)',   // Active - Blue
                        'rgb(16, 185, 129)',   // Completed - Green
                        'rgb(239, 68, 68)',    // Overdue - Red
                        'rgb(107, 114, 128)',  // Cancelled - Gray
                        'rgb(147, 51, 234)'    // Returned - Purple
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Customer Status Chart
        const customerStatusData = @json($customerStatusData->values());
        const customerStatusCtx = document.getElementById('customerStatusChart').getContext('2d');
        new Chart(customerStatusCtx, {
            type: 'pie',
            data: {
                labels: customerStatusData.map(item => item.status),
                datasets: [{
                    data: customerStatusData.map(item => item.count),
                    backgroundColor: [
                        'rgb(16, 185, 129)',   // Active - Green
                        'rgb(107, 114, 128)',  // Deactivated - Gray
                        'rgb(107, 114, 128)',  // Inactive - Gray
                        'rgb(245, 158, 11)',   // Pending - Yellow
                        'rgb(239, 68, 68)'     // Cancelled - Red
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-layout>
