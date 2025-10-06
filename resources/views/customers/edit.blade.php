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
                <form method="POST" action="{{ route('customers.update', ['customer_id' => $customer->customer_id]) }}" class="mt-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="full_name" name="full_name" type="text" value="{{ old('full_name', $customer->full_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('full_name') border-red-500 @enderror" required>
                        @error('full_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $customer->email) }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('email') border-red-500 @enderror" required>
                        @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input id="address" name="address" type="text" value="{{ old('address', $customer->address) }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('address') border-red-500 @enderror" required>
                        @error('address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="text" value="{{ old('contact_number', $customer->contact_number) }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('contact_number') border-red-500 @enderror" required>
                        @error('contact_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                            <input id="size" name="size" type="text" value="{{ old('size', $customer->measurement['size'] ?? $customer->measurement['chest'] ?? '') }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('size') border-red-500 @enderror">
                            @error('size')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="height" class="block text-sm font-medium text-gray-700">Height</label>
                            <input id="height" name="height" type="text" value="{{ old('height', $customer->measurement['height'] ?? '') }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('height') border-red-500 @enderror">
                            @error('height')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="bust" class="block text-sm font-medium text-gray-700">Bust/Chest</label>
                            <input id="bust" name="bust" type="text" value="{{ old('bust', $customer->measurement['chest'] ?? '') }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('bust') border-red-500 @enderror">
                            @error('bust')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="waist" class="block text-sm font-medium text-gray-700">Waist</label>
                            <input id="waist" name="waist" type="text" value="{{ old('waist', $customer->measurement['waist'] ?? '') }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('waist') border-red-500 @enderror">
                            @error('waist')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="hips" class="block text-sm font-medium text-gray-700">Hips</label>
                            <input id="hips" name="hips" type="text" value="{{ old('hips', $customer->measurement['hips'] ?? '') }}" class="mt-1 block w-full border rounded-md px-3 py-2 @error('hips') border-red-500 @enderror">
                            @error('hips')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-2">
                        <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md">Save Changes</button>
                    </div>
                </form>
                @else
                <p class="text-red-600">Customer not found.</p>
                @endif
            </div>
        </div>
    </div>
</x-layout>
