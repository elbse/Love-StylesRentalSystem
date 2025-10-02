<x-layout :title="$title">
<script src="//unpkg.com/alpinejs" defer></script>


    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="m-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
    @endif

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
                        <img src="{{ asset('images/avatar.png') }}" alt="User" class="w-8 h-8 rounded-full border">
                        <span>{{ $customer->full_name }}</span>
                    </td>
                    <td class="px-4 py-3">{{ $customer->contact_number }}</td>
                    <td class="px-4 py-3">{{ $customer->email }}</td>
                    <td class="px-4 py-3">
                        @php
                            $statusColors = [
                                'Active' => 'bg-green-600 text-white',
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
                   <td class="px-4 py-3">

                <div x-data="{ open: false }">
                    <x-action-button 
                        :entity-id="$customer->customer_id"
                        :entity-name="$customer->full_name"
                        title="Customer Actions"
                        :actions="[
                            ['label' => 'View', 'url' => route('customers.show', $customer->customer_id), 'method' => 'GET'],
                            ['label' => 'Edit', 'url' => route('customers.edit', $customer->customer_id), 'method' => 'GET'],
                            ['label' => 'Deactivate', 'method' => 'MODAL','full' => true],
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
    

            <div 
    x-data="{ 
        open: @json($errors->has('password')), 
        customerId: '{{ old('customer_id') }}', 
        customerName: '{{ old('customer_name') }}' 
    }"
    x-on:open-deactivate-modal.window="
        open = true; 
        customerId = $event.detail.id; 
        customerName = $event.detail.name;
    "
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
    x-show="open"
>
    <div class="bg-white p-6 rounded-xl shadow-md w-96">
        <h2 class="text-lg font-bold mb-3">Deactivate Customer</h2>
        <p class="text-sm mb-4">
            Enter your password to deactivate 
            <span class="font-semibold" x-text="customerName"></span>.
        </p>

        <form method="POST" action="{{ route('customers.deactivate') }}">
        @csrf
            <input type="hidden" name="customer_id" 
                x-model="customerId"
                value="{{ old('customer_id') }}">
            <input type="hidden" name="customer_name" 
                x-model="customerName"
                value="{{ old('customer_name') }}">


            <input type="password" 
                   name="password" 
                   class="w-full border p-2 mb-3 rounded @error('password') border-red-500 @enderror" 
                   placeholder="Enter your password" required>

            @error('password')
                <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
            @enderror

            <div class="flex justify-end space-x-2">
                <button type="button" @click="open = false" class="px-3 py-1 bg-gray-300 rounded">Cancel</button>
                <button type="submit" class="px-3 py-1 bg-yellow-500 text-white rounded">Confirm</button>
            </div>
        </form>
    </div>
</div>




</x-layout>
