<x-layout>

    <form action="{{ route('customers.store') }}" method="POST" class="space-y-4">
        @csrf
        <h2 class="text-xl font-bold">Create Customer</h2>

        <div>
            <label for="full_name" class="block">Customer Name:</label>
            <input type="text" name="full_name" id="full_name" class="border rounded w-full p-2">
        </div>

        <div>
            <label for="email" class="block">Email:</label>
            <input type="email" name="email" id="email" class="border rounded w-full p-2">
        </div>

        <div>
            <label for="address" class="block">Address:</label>
            <input type="text" name="address" id="address" class="border rounded w-full p-2">
        </div>

        <div>
            <label for="contact_number" class="block">Contact Number:</label>
            <input type="text" name="contact_number" id="contact_number" class="border rounded w-full p-2">
        </div>

        <div>
            <label for="measurement" class="block">Measurement (JSON):</label>
            <textarea name="measurement" id="measurement" class="border rounded w-full p-2" rows="3"></textarea>
        </div>

        {{-- <div>
            <label for="status_id" class="block">Status:</label>
            <select name="status_id" id="status_id" class="border rounded w-full p-2">
                @foreach($statuses as $status)
                    <option value="{{ $status->status_id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Customer</button>
    </form>
</x-layout>
