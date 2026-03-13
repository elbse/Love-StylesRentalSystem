<x-layout :title="$title">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                    <h3 class="text-sm text-black">Available</h3>
                </x-kpi-card>

            <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                    <h3 class="text-sm text-black">Rented Out</h3>
                </x-kpi-card>

            <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                    <h3 class="text-sm text-black">Reserved</h3>
                </x-kpi-card>

            <x-kpi-card icon="fas fa-users" color="bg-black" background="bg-white">
                    <h3 class="text-sm text-black">Total Items</h3>
                </x-kpi-card>
    </div>

    
        <x-search-bar
        route="inventory.index"
        label="Search Inventory"
        placeholder="Search by name, size, or category"
        :filters="[
            [
                'name'        => 'category',
                'label'       => 'Filter by Category',
                'placeholder' => 'All Categories',
                'grouped'     => true,
                'options'     => [
                    ['group' => 'Suits', 'items' => [
                        ['value' => 'tuxedo',           'label' => 'Tuxedo'],
                        ['value' => 'business-suit',    'label' => 'Business Suit'],
                        ['value' => 'wedding-suit',     'label' => 'Wedding Suit'],
                        ['value' => 'three-piece-suit', 'label' => 'Three-Piece Suit'],
                        ['value' => 'casual-suit',      'label' => 'Casual Suit'],
                    ]],
                    ['group' => 'Gowns', 'items' => [
                        ['value' => 'wedding-gown',   'label' => 'Wedding Gown'],
                        ['value' => 'evening-gown',   'label' => 'Evening Gown'],
                        ['value' => 'ball-gown',      'label' => 'Ball Gown'],
                        ['value' => 'prom-gown',      'label' => 'Prom Gown'],
                        ['value' => 'cocktail-dress', 'label' => 'Cocktail Dress'],
                    ]],
                    ['group' => 'Accessories', 'items' => [
                        ['value' => 'ties',      'label' => 'Ties'],
                        ['value' => 'cufflinks', 'label' => 'Cufflinks'],
                        ['value' => 'belts',     'label' => 'Belts'],
                        ['value' => 'scarves',   'label' => 'Scarves'],
                        ['value' => 'hats',      'label' => 'Hats'],
                    ]],
                ],
            ],
        ]"
    />

    <!-- Cards Section -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
            <x-item-card />
            
            
        </div>
    </div>


</x-layout>