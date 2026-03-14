<x-layout :title="$title">

    <div class="bg-white rounded-lg shadow-md mb-6">

        {{-- Header --}}
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <div>
                <h2 class="text-base font-semibold text-gray-900">All Reservations</h2>
                <p class="text-xs text-gray-400 mt-0.5">View and manage all booking records</p>
            </div>
            {{-- Changed from <a> to <button> to trigger modal --}}
            <button
                onclick="document.getElementById('reservationModal').classList.remove('hidden')"
                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                New Reservation
            </button>
        </div>

        {{-- Search --}}
        <div class="px-4 py-3 border-b border-gray-100">
            <form method="GET" action="{{ route('bookings.index') }}">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l3.817 3.817a1 1 0 01-1.414 1.414l-3.817-3.817A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input type="text"
                           name="q"
                           value="{{ request('q') }}"
                           placeholder="Search by customer attire..."
                           class="w-full border border-gray-200 rounded-lg pl-9 pr-9 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    @if(request('q'))
                        <a href="{{ route('bookings.index', array_filter(request()->except('page', 'q'))) }}"
                           class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Customer</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Reservation ID</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Start Date</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">End Date</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Amount</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Status</th>
                        <th class="text-left text-gray-500 font-medium py-3 px-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50 transition-colors duration-100">
                        <td class="py-3 px-4 font-semibold text-gray-900">Charisse Priego</td>
                        <td class="py-3 px-4 text-gray-600">RV0001</td>
                        <td class="py-3 px-4 text-gray-600">01/01/2026</td>
                        <td class="py-3 px-4 text-gray-600">03/01/2026</td>
                        <td class="py-3 px-4 text-gray-600">P3000</td>
                        <td class="py-3 px-4">
                            <span class="text-green-600 font-medium">Completed</span>
                        </td>
                        <td class="py-3 px-4">
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

    {{-- Modal Overlay --}}
    <div id="reservationModal"
         class="hidden fixed inset-0 z-50 flex items-center justify-center"
         onclick="if(event.target === this) closeModal()">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>

        {{-- Modal Card --}}
        <div class="relative bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">

            {{-- Modal Header --}}
            <div class="mb-5">
                <h3 class="text-lg font-bold text-gray-900">Create New Reservation</h3>
                <p class="text-xs text-gray-400 mt-0.5">Fill in the booking details</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf

                {{-- Customer & Attire --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Customer</label>
                        <input
                            type="text"
                            name="customer"
                            placeholder="Rho Alphonce Jornadal"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Attire</label>
                        <input
                            type="text"
                            name="attire"
                            placeholder="Blue Suit"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                </div>

                {{-- Start Date & End Date --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Start Date</label>
                        <input
                            type="date"
                            name="start_date"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">End Date</label>
                        <input
                            type="date"
                            name="end_date"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <button
                        type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200">
                        Create Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('reservationModal').classList.add('hidden');
        }

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>

</x-layout>