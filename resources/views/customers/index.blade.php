<x-layout :title="$title">

    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="m-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mb-4 text-xl font-bold">Customer Management</h2>

    <div class="flex gap-6 ">
        <x-kpi-card icon="fas fa-calendar-check" color="bg-[#C16BFF]" symbol="images/vector_peso.png"  background="bg-gradient-to-r from-[#C16BFF] to-[#6A0DAD]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">120</p>
            <p class="text-sm text-gray-300">75%</p>
        </x-kpi-card>

        <x-kpi-card icon="fas fa-tshirt" color="bg-[#A4B1FF]" symbol="images/vector_cash.png"  background="bg-gradient-to-r from-[#A4B1FF] to-[#5E72E4]">
            <h3 class="text-sm text-gray-200">Formal Wears</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="fas fa-tshirt" color="bg-[#FF0000]" symbol="images/vector_sms.png"  background="bg-gradient-to-r from-[#FF0000] to-[#650606]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="images/vector_check.png" color="bg-[#77FF90]" symbol="images/vector_check.png"  background="bg-gradient-to-r from-[#77FF90] to-[#35B73E]">
            <h3 class="text-sm text-gray-200">Cancellation</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

    </div>

    {{-- <div> 
    <a href="{{ route('customers.create') }}" class="text-blue-500 hover:underline">Create New Customer </a>
    
    </div> --}}
    
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
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Size</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customers as $customer)
                <tr>
                    <td class="px-4 py-3 flex items-center space-x-2">
                        <img src="{{ asset('images/avatar.png') }}" alt="User" class="w-8 h-8 rounded-full border">
                        <span>{{ $customer->full_name }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $customer->contact_number }}</td>
                    <td class="px-4 py-3">{{ $customer->email }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-700">{{ $customer->status_id }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @php($m = $customer->measurement)
                        {{ is_array($m) ? ($m['chest'] ?? ($m['size'] ?? '—')) : '—' }}
                    </td>
                    <td class="px-4 py-3">
                        <button class="text-gray-600 hover:text-purple-600">⋮</button>
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

    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-600">
            Showing
            <span class="font-semibold">{{ $customers->firstItem() ?? 0 }}</span>
            to
            <span class="font-semibold">{{ $customers->lastItem() ?? 0 }}</span>
            of
            <span class="font-semibold">{{ $customers->total() }}</span>
            customers
        </div>

        <div class="flex items-center gap-2">
            <form method="GET" action="{{ route('customers.index') }}" class="flex items-center gap-2">
                <label for="per_page" class="text-sm text-gray-600">Rows per page</label>
                <select id="per_page" name="per_page" class="border rounded-md px-2 py-1 text-sm" onchange="this.form.submit()">
                    <option value="5" {{ ($perPage ?? 5) == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ ($perPage ?? 5) == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ ($perPage ?? 5) == 15 ? 'selected' : '' }}>15</option>
                </select>
            </form>

            {{ $customers->links() }}
        </div>
    </div>
    

    


</x-layout>
