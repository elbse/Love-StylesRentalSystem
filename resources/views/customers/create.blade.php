<x-layout >

    @if (session('success'))
    <div id="flash-success" class="m-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('flash-success');
        if (el) {
            setTimeout(function(){ el.style.display = 'none'; }, 3000);
        }
    });
    </script>
    @endif

    @if ($errors->any())
    <div class="m-4 px-4 py-2 rounded bg-red-100 text-red-800 border border-red-300">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
                <input type="text" name="full_name" id="full_name" class="border rounded w-full p-2" value="{{ old('full_name') }}" required>
            </div>

            <div>
                <label for="email" class="block">Email:</label>
                <input type="email" name="email" id="email" class="border rounded w-full p-2" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="address" class="block">Address:</label>
                <input type="text" name="address" id="address" class="border rounded w-full p-2" value="{{ old('address') }}" required>
            </div>

            <div>
                <label for="contact_number" class="block">Contact Number:</label>
                <input type="text" name="contact_number" id="contact_number" class="border rounded w-full p-2" value="{{ old('contact_number') }}" required>
            </div>

            <div>
                <label for="notes" class="block">Notes:</label>
                <textarea type="text" name="notes" id="notes" class="border rounded w-full p-2">{{ old('notes') }}</textarea>
            </div>

            
        </div>

        <!-- Right side: Measurements -->
        <div class="space-y-4 bg-[#DBACFF] p-6 items-center border rounded-[20px] w-[400px] ml-[150px]">
            <h4 class="font-semibold ">Measurements</h4>

            <div>
                <label for="size" class="block">Size:</label>
                <select name="size" id="size" 
                        class="border rounded w-[300px] p-2 text-gray-500 bg-white">
                    <option value="" disabled {{ old('size') ? '' : 'selected' }}>eg. Medium</option>
                    <option value="XS" {{ old('size')=='XS' ? 'selected' : '' }}>Extra Small</option>
                    <option value="S" {{ old('size')=='S' ? 'selected' : '' }}>Small</option>
                    <option value="M" {{ old('size')=='M' ? 'selected' : '' }}>Medium</option>
                    <option value="L" {{ old('size')=='L' ? 'selected' : '' }}>Large</option>
                    <option value="XL" {{ old('size')=='XL' ? 'selected' : '' }}>Extra Large</option>
                </select>
            </div>

            <div>
                <label for="height" class="block">Height:</label>
                <input name="height" id="height" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 152cm" value="{{ old('height') }}">
            </div>

            <div>
                <label for="bust" class="block">Bust:</label>
                <input name="bust" id="bust" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 34in" value="{{ old('bust') }}">
            </div>

            <div>
                <label for="waist" class="block">Waist:</label>
                <input name="waist" id="waist" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 26in" value="{{ old('waist') }}">
            </div>

            <div>
                <label for="hips" class="block">Hips:</label>
                <input name="hips" id="hips" class="border rounded w-[300px] p-2 text-gray-500 bg-white" placeholder="eg. 36in" value="{{ old('hips') }}">
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

        <a href="{{ route('customers.index') }}" class="bg-red-600 text-white px-4 py-2 rounded">Cancel</a>
    </form>
</x-layout>
