<x-layout :title="$title">

    {{-- Search Bar --}}
    <x-search-bar
    route="bookings.index"
    label="Search Reservations"
    placeholder="Search by name, size or category"
    :filters="[
        ['name' => 'status', 'label' => 'Filter by Status', 'options' => [
            ['value' => 'Active',   'label' => 'Active'],
            ['value' => 'Inactive', 'label' => 'Inactive'],
        ]],
    ]"
    />

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">Customer</th>
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">Reservation ID</th>
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">Start Date</th>
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">End Date</th>
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">Amount</th>
                        <th class="text-left text-gray-500 font-medium pb-3 pr-6">Status</th>
                        <th class="text-left text-gray-500 font-medium pb-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50 transition-colors duration-100">
                        <td class="py-3 pr-6 font-semibold text-gray-900">Charisse Priego</td>
                        <td class="py-3 pr-6 text-gray-600">RV0001</td>
                        <td class="py-3 pr-6 text-gray-600">01/01/2026</td>
                        <td class="py-3 pr-6 text-gray-600">03/01/2026</td>
                        <td class="py-3 pr-6 text-gray-600">P3000</td>
                        <td class="py-3 pr-6">
                            <span class="text-green-600 font-medium">Completed</span>
                        </td>
                        <td class="py-3">
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
                </tbody>
            </table>
        </div>
    </div>

</x-layout>