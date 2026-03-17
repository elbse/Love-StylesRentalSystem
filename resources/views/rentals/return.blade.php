<x-layout :title="$title ?? 'Return Processing'">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-base font-semibold text-gray-900">Return Processing - R0001</h2>
            <p class="text-xs text-gray-400 mt-0.5">Confirm item return, compute and verify return details here.</p>
        </div>
        <a href="{{ route('rentals.index') }}"
           class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 text-sm rounded-lg transition-colors duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Tracking
        </a>
    </div>

    {{-- Customer Information --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-4">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Customer Information</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-5 py-4">
            <div>
                <p class="text-xs text-gray-400 mb-1">Customer ID</p>
                <p class="text-sm font-medium text-gray-800">C001</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Name</p>
                <p class="text-sm font-medium text-gray-800">Jonathan Sindo</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Contact Number</p>
                <p class="text-sm font-medium text-gray-800">09000000000</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Email</p>
                <p class="text-sm font-medium text-gray-800">jonathan@gmail.com</p>
            </div>
        </div>
    </div>

    {{-- Return Details --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-4">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Return Details</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-5 py-4">
            <div>
                <p class="text-xs text-gray-400 mb-1">Return Date</p>
                <p class="text-sm font-medium text-gray-800">2025-12-17</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Release Date</p>
                <p class="text-sm font-medium text-gray-800">2025-12-12</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Due Date</p>
                <p class="text-sm font-medium text-gray-800">2025-12-19</p>
            </div>
            <div>
                <p class="text-xs text-gray-400 mb-1">Rental Period</p>
                <p class="text-sm font-medium text-gray-800">5 Days</p>
            </div>
        </div>
    </div>

    {{-- Item Condition Assessment --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-4">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Item Condition Assessment</h3>
        </div>
        <div class="px-5 py-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Left: Item + Condition --}}
                <div>
                    <p class="text-xs text-gray-500 font-medium mb-2">Evening Gown - Black</p>
                    <label class="block text-xs text-gray-400 mb-1">Current Condition</label>
                    <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option>Good/Undamaged</option>
                        <option>Minor Damage</option>
                        <option>Major Damage</option>
                        <option>Lost</option>
                    </select>
                </div>

                {{-- Right: Condition Notes --}}
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Condition Notes</label>
                    <textarea rows="3"
                              placeholder="Enter any notes about the item condition..."
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"></textarea>
                </div>

            </div>
        </div>
    </div>

    {{-- Return Details / Financial Summary --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-100 mb-6">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-800">Return Details</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-5 py-4">

            {{-- Left: Financial Breakdown --}}
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Original Deposit</span>
                    <span class="text-gray-800">₱ 2,000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Damage Penalty</span>
                    <span class="text-gray-800">+ ₱ 0</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Extension Fee</span>
                    <span class="text-gray-800">- ₱ 0</span>
                </div>
                <div class="border-t border-gray-100 pt-2 flex justify-between text-sm font-semibold">
                    <span class="text-gray-800">Deposit Return</span>
                    <span class="text-gray-900">₱ 2,000</span>
                </div>
            </div>

            {{-- Right: Checkboxes + Return Notes --}}
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" />
                    Additional payment of ₱200 has been collected
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500" />
                    Return process completed
                </label>
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Return Notes</label>
                    <textarea rows="2"
                              placeholder=""
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"></textarea>
                </div>
            </div>

        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-end gap-3">
        <a href="{{ route('rentals.index') }}"
           class="px-5 py-2 bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 text-sm rounded-lg transition-colors duration-150">
            Cancel
        </a>
        <button type="button"
                class="inline-flex items-center gap-2 px-5 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Confirm Return
        </button>
    </div>

</x-layout>