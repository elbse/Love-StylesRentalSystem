<x-layout>


    <h1 class="text-2xl font-bold text-gray-800 mb-6">Key Performance Indicators</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Total Customers</h3>
        </x-kpi-card>

        <x-kpi-card icon="fa-solid fa-boxes-packing" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Active Rentals</h3>
            </x-kpi-card>

        <x-kpi-card icon="fa-solid fa-box" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Inventory Items</h3>
            </x-kpi-card>

        <x-kpi-card icon="fa-solid fa-peso-sign" color="bg-black"  background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Revenue</h3>
            </x-kpi-card>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-6">

        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Active Users</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Rented Items</h3>
            </x-kpi-card>

         <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Available Items</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Pending Reservations</h3>
            </x-kpi-card>

         <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Damaged Items</h3>
            </x-kpi-card>

        <x-kpi-card icon="fa-solid fa-file-lines" color="bg-black"  background="bg-white">
                <h3 class="text-sm text-gray-700 font-semibold">Total Invoices</h3>
            </x-kpi-card>

    </div>



    <h1 class="text-2xl font-bold text-gray-800 mb-6">Analytics & Performance</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        {{-- Daily Revenue Chart --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Daily Revenue (Last 30 Days)</h2>
            <div class="relative" style="height: 220px;">
                <canvas id="dailyRevenueChart"></canvas>
            </div>
        </div>

        {{-- Weekly Rental Activity Chart --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Weekly Rental Activity (Last 12 Weeks)</h2>
            <div class="relative" style="height: 220px;">
                <canvas id="weeklyRentalChart"></canvas>
            </div>
        </div>

        {{-- Item Status Distribution --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Item Status Distribution</h2>
            <div class="flex items-center justify-center" style="height: 220px;">
                <canvas id="itemStatusChart"></canvas>
            </div>
        </div>

        {{-- Rental Status Distribution --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Rental Status Distribution</h2>
            <div class="flex items-center justify-center" style="height: 220px;">
                <canvas id="rentalStatusChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Top 5 Most Rented Items</h2>
            <div class="flex items-center justify-center" style="height: 220px;">
                <canvas id="rentalStatusChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h2 class="text-sm font-semibold text-gray-700 mb-4">Top 5 Most Active</h2>
            <div class="flex items-center justify-center" style="height: 220px;">
                <canvas id="rentalStatusChart"></canvas>
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.font.size   = 11;
        Chart.defaults.color       = '#6b7280';

        // ── Daily Revenue (dummy data) ───────────────────────────────────────
        const revenueLabels = [
            'Jan 05','Jan 06','Jan 07','Jan 08','Jan 09','Jan 10','Jan 11','Jan 12',
            'Jan 13','Jan 14','Jan 15','Jan 16','Jan 17','Jan 18','Jan 19','Jan 20',
            'Jan 21','Jan 22','Jan 23','Jan 24','Jan 25','Jan 26','Jan 27','Jan 28',
            'Jan 29','Jan 30','Jan 31','Feb 01','Feb 02','Feb 03'
        ];
        const revenueData = [
            1200, 850, 1400, 960, 1100, 780, 1350, 1500, 900, 1250,
            1600, 1050, 1300, 870, 1450, 1100, 980, 1700, 1200, 1400,
            1050, 800, 1550, 1300, 950, 1650, 1100, 1400, 1200, 1800
        ];

        new Chart(document.getElementById('dailyRevenueChart'), {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Revenue',
                    data: revenueData,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.08)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 1.5,
                    tension: 0.3,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', align: 'end', labels: { boxWidth: 12, padding: 16 } },
                    tooltip: { callbacks: { label: ctx => ' ₱' + Number(ctx.raw).toLocaleString() } }
                },
                scales: {
                    x: { grid: { color: '#f3f4f6' }, ticks: { maxRotation: 45, minRotation: 45 } },
                    y: { grid: { color: '#f3f4f6' }, beginAtZero: true, ticks: { callback: val => '₱' + val.toLocaleString() } }
                }
            }
        });

        // ── Weekly Rental Activity (dummy data) ─────────────────────────────
        const rentalLabels = [
            'W47 (Nov 17)','W48 (Nov 24)','W49 (Dec 01)','W50 (Dec 08)',
            'W51 (Dec 15)','W52 (Dec 22)','W1 (Dec 29)','W2 (Jan 05)',
            'W3 (Jan 12)','W4 (Jan 19)','W5 (Jan 26)','W6 (Feb 02)'
        ];
        const rentalData = [8, 12, 7, 15, 10, 18, 6, 14, 11, 16, 9, 13];

        new Chart(document.getElementById('weeklyRentalChart'), {
            type: 'bar',
            data: {
                labels: rentalLabels,
                datasets: [{
                    label: 'Rentals',
                    data: rentalData,
                    backgroundColor: 'rgba(139,92,246,0.75)',
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', align: 'end', labels: { boxWidth: 12, padding: 16 } }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { maxRotation: 45, minRotation: 45 } },
                    y: { grid: { color: '#f3f4f6' }, beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });

        // ── Item Status Distribution (dummy data) ────────────────────────────
        new Chart(document.getElementById('itemStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Available', 'Rented', 'Damaged'],
                datasets: [{
                    data: [42, 25, 8],
                    backgroundColor: ['#22c55e', '#f59e0b', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, padding: 16 } }
                }
            }
        });

        // ── Rental Status Distribution (dummy data) ──────────────────────────
        new Chart(document.getElementById('rentalStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Active', 'Returned', 'Overdue'],
                datasets: [{
                    data: [10, 25, 38, 5],
                    backgroundColor: ['#f59e0b', '#3b82f6', '#22c55e', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, padding: 16 } }
                }
            }
        });

    });
    </script>
    @endpush

</x-layout>