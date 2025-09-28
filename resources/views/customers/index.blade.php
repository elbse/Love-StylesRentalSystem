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

    <div> 
    <a href="{{ route('customers.create') }}" class="text-blue-500 hover:underline">Create New Customer </a>
    
    </div>


</x-layout>
