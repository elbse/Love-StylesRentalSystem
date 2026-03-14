<x-layout :title="'Item Details'">

    <div class="max-w-2xl mx-auto">

        {{-- Back Button --}}
        <a href="{{ route('inventories.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-purple-600 transition-colors duration-150 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Inventory
        </a>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <div>
                    <h2 class="text-base font-semibold text-gray-900">Item Details</h2>
                    <p class="text-xs text-gray-400 mt-0.5">View and edit this inventory item</p>
                </div>
                <span class="text-xs text-gray-400 font-medium">{{ $inventory->code }}</span>
            </div>

            <form method="POST" action="{{ route('inventories.update', $inventory->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-5 space-y-5">

                    {{-- Current Image + Upload --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Image</label>
                        <div class="flex items-center gap-4">
                            <img
                                id="imagePreview"
                                src="{{ asset('storage/images/' . $inventory->image) }}"
                                alt="{{ $inventory->name }}"
                                class="w-24 h-24 object-cover rounded-xl border border-gray-200"
                            />
                            <div>
                                <label for="imageUpload"
                                       class="cursor-pointer inline-flex items-center gap-2 px-3 py-2 border border-gray-200 rounded-lg text-xs text-gray-600 hover:bg-gray-50 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    Change Image
                                </label>
                                <input id="imageUpload" type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event)" />
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- Name & Size --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Attire Name</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $inventory->name) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Size</label>
                            <input
                                type="text"
                                name="size"
                                value="{{ old('size', $inventory->size) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                        </div>
                    </div>

                    {{-- Color & Price --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Color</label>
                            <input
                                type="text"
                                name="color"
                                value="{{ old('color', $inventory->color) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Rental Fee</label>
                            <input
                                type="number"
                                name="rental_fee"
                                value="{{ old('rental_fee', $inventory->rental_fee) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                        </div>
                    </div>

                    {{-- Status & Condition --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                            <select
                                name="status"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="available"    @selected(old('status', $inventory->status) === 'available')>Available</option>
                                <option value="reserved"     @selected(old('status', $inventory->status) === 'reserved')>Reserved</option>
                                <option value="out-of-stock" @selected(old('status', $inventory->status) === 'out-of-stock')>Out of Stock</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Condition</label>
                            <input
                                type="text"
                                name="condition"
                                value="{{ old('condition', $inventory->condition) }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" />
                        </div>
                    </div>

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3">
                            <ul class="text-xs text-red-600 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-lg px-4 py-3 text-xs text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-gray-100 bg-gray-50">
                    <a href="{{ route('inventories.index') }}"
                       class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-200 rounded-lg hover:bg-white transition-colors duration-150">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition-colors duration-200">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('imagePreview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-layout>