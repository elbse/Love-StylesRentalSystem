<x-layout title="Edit Customer">
    <div class="max-w-6xl mx-auto p-4 md:p-5">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-50 to-gray-50 px-5 md:px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900">Edit Customer</h2>
                <p class="text-xs md:text-sm text-gray-600 mt-1">Update customer information and measurements</p>
            </div>

            <div class="p-5 md:p-6">
                @if($customer)
                    <h3 class="text-lg font-semibold mb-4">Editing: {{ $customer->full_name }}</h3>
                    <p class="text-gray-600">Customer ID: {{ $customer->customer_id }}</p>
                    <p class="text-gray-600">Email: {{ $customer->email }}</p>
                    <p class="text-gray-600">Contact: {{ $customer->contact_number }}</p>
                    <!-- Add your edit form here -->
                @else
                    <p class="text-red-600">Customer not found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>