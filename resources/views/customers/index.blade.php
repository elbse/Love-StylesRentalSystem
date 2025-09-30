<x-layout :title="$title">

    <h2 class="mb-4 text-xl font-bold">Customer Management</h2>

    <div class="flex gap-6 ">
        <x-kpi-card icon="fas fa-calendar-check" color="bg-blue-500" symbol="images/vector_peso.png"  background="bg-gradient-to-r from-[#C16BFF] to-[#6A0DAD]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">120</p>
            <p class="text-sm text-gray-300">75%</p>
        </x-kpi-card>

        <x-kpi-card icon="fas fa-tshirt" color="bg-green-500" symbol="images/vector_cash.png"  background="bg-gradient-to-r from-[#A4B1FF] to-[#5E72E4]">
            <h3 class="text-sm text-gray-200">Formal Wears</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="fas fa-tshirt" color="bg-green-500" symbol="images/vector_sms.png"  background="bg-gradient-to-r from-[#FF0000] to-[#650606]">
            <h3 class="text-sm text-gray-200">Reservations</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

         <x-kpi-card icon="images/vector_check.png" color="bg-green-500" symbol="images/vector_check.png"  background="bg-gradient-to-r from-[#77FF90] to-[#35B73E]">
            <h3 class="text-sm text-gray-200">Cancellation</h3>
            <p class="text-3xl font-bold">85</p>
            <p class="text-sm text-gray-300">40%</p>
        </x-kpi-card>

    </div>

    {{-- <div> 
    <a href="{{ route('customers.create') }}" class="text-blue-500 hover:underline">Create New Customer </a>
    
    </div> --}}
    
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
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Size</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Example Row -->
                <tr>
                    <td class="px-4 py-3 flex items-center space-x-2">
                        <img src="{{ asset('images/avatar.png') }}" 
                             alt="User" 
                             class="w-8 h-8 rounded-full border">
                        <span>Jackie Chan</span>
                    </td>
                    <td class="px-4 py-3">+639090909090</td>
                    <td class="px-4 py-3">jchan@gmail.com</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-700">Good</span>
                    </td>
                    <td class="px-4 py-3">Large</td>
                    <td class="px-4 py-3">
                        <button class="text-gray-600 hover:text-purple-600">⋮</button>
                    </td>
                </tr>


                <!-- More rows go here -->
                    </tbody>
                </table>
            </div>
        </div>

        <x-action-panel class="col-start-1" />

    </div>
    

    


</x-layout>
