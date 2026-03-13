<x-layout :title="$title">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

        <x-kpi-card icon="fas fa-users" color="bg-black" symbol="{{ asset('storage/images/vector_peso.png') }}"  background="bg-white">
                <h3 class="text-sm text-black">Total Customers</h3>
            </x-kpi-card>

    </div>
    
    <x-search-bar
    route="rentals.index"
    label="Search Rentals"
    placeholder="Search by name, size or category"
    :filters="[
        ['name' => 'status', 'label' => 'Filter by Status', 'options' => [
            ['value' => 'Active',   'label' => 'Active'],
            ['value' => 'Inactive', 'label' => 'Inactive'],
        ]],
    ]"
    />




</x-layout>