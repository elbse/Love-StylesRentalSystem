<x-layout >

    <form action="{{ route('customers.store') }}" enctype="multipart/form-data" method="POST"
      class="space-y-4 p-6 rounded-[20px] shadow-md m-4 border border-gray-300 bg-white">
    @csrf
    <h2 class="text-xl font-bold mb-4">Create Customer</h2>

    <div class="grid grid-cols-2 gap-8">
        <!-- Left side: Customer Info -->
        <div class="space-y-4">

              <div>
                <label for="photo" class="block">Customer Photo:</label>
                <input type="file" name="photo" id="photo" 
                class="border rounded w-full p-2 bg-white">
            </div>

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
                <label for="notes" class="block">Notes:</label>
                <textarea type="text" name="notes" id="notes" class="border rounded w-full p-2"></textarea>
            </div>

            
        </div>

        <!-- Right side: Measurements -->
        <div class="space-y-4 bg-[#DBACFF] p-6 items-center border rounded-[20px] w-[400px] ml-[150px]">
            <h4 class="font-semibold ">Measurements</h4>

            <div>
                <label for="size" class="block">Size:</label>
                <select name="size" id="size" 
                        class="border rounded w-[300px] p-2 text-gray-500 bg-white">
                    <option value="" disabled selected>eg. Medium</option>
                    <option value="XS">Extra Small</option>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                    <option value="XL">Extra Large</option>
                </select>
            </div>

            <div>
                <label for="height" class="block">Height:</label>
                <input name="height" id="height" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 152cm">
            </div>

            <div>
                <label for="bust" class="block">Bust:</label>
                <input name="bust" id="bust" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 34in">
            </div>

            <div>
                <label for="waist" class="block">Waist:</label>
                <input name="waist" id="waist" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 26in">
            </div>

            <div>
                <label for="hips" class="block">Hips:</label>
                <input name="hips" id="hips" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 36in">
            </div>
        </div>
    </div>
        {{-- <div>
            <label for="status_id" class="block">Status:</label>
            <select name="status_id" id="status_id" class="border rounded w-full p-2">
                @foreach($statuses as $status)
                    <option value="{{ $status->status_id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Customer</button>

        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Cancel</button>
    </form>
</x-layout>
