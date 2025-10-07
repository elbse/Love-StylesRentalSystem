<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create inventory statuses first
        $statuses = ['Available', 'Rented', 'Maintenance', 'Retired'];
        foreach ($statuses as $status) {
            InventoryStatus::firstOrCreate(['status_name' => $status]);
        }

        // Create sample inventory items
        $items = [
            ['item_type' => 'Gown', 'name' => 'Evening Gown - Black', 'size' => 'M', 'color' => 'Black', 'design' => 'Elegant', 'rental_price' => '2500.00'],
            ['item_type' => 'Suit', 'name' => 'Suit - Navy Blue', 'size' => 'L', 'color' => 'Navy Blue', 'design' => 'Professional', 'rental_price' => '1800.00'],
            ['item_type' => 'Gown', 'name' => 'Wedding Dress - White', 'size' => 'S', 'color' => 'White', 'design' => 'Classic', 'rental_price' => '5000.00'],
            ['item_type' => 'Gown', 'name' => 'Cocktail Dress - Red', 'size' => 'M', 'color' => 'Red', 'design' => 'Modern', 'rental_price' => '2200.00'],
            ['item_type' => 'Suit', 'name' => 'Tuxedo - Black', 'size' => 'XL', 'color' => 'Black', 'design' => 'Classic', 'rental_price' => '3000.00'],
            ['item_type' => 'Gown', 'name' => 'Prom Dress - Pink', 'size' => 'S', 'color' => 'Pink', 'design' => 'Elegant', 'rental_price' => '2800.00'],
            ['item_type' => 'Suit', 'name' => 'Business Suit - Gray', 'size' => 'M', 'color' => 'Gray', 'design' => 'Professional', 'rental_price' => '2000.00'],
            ['item_type' => 'Gown', 'name' => 'Bridesmaid Dress - Blue', 'size' => 'L', 'color' => 'Blue', 'design' => 'Elegant', 'rental_price' => '1500.00'],
            ['item_type' => 'Gown', 'name' => 'Formal Gown - Gold', 'size' => 'M', 'color' => 'Gold', 'design' => 'Luxurious', 'rental_price' => '3500.00'],
            ['item_type' => 'Suit', 'name' => 'Dinner Jacket - Burgundy', 'size' => 'L', 'color' => 'Burgundy', 'design' => 'Elegant', 'rental_price' => '1200.00'],
        ];

        foreach ($items as $item) {
            Inventory::create([
                'item_type' => $item['item_type'],
                'name' => $item['name'],
                'size' => $item['size'],
                'color' => $item['color'],
                'design' => $item['design'],
                'rental_price' => $item['rental_price'],
                'item_condition' => 'good',
                'status_id' => InventoryStatus::where('status_name', 'Available')->first()->status_id,
            ]);
        }
    }
}
