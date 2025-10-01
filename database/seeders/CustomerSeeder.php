<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Create a default status
        \App\Models\CustomerStatus::factory()->create([
            'status_name' => 'Active',
            'reason' => 'Default',
        ]);

        // Create 20 customers linked to that status
        \App\Models\Customer::factory(20)->create([
            'status_id' => 1, // ensures FK matches the created status
        ]);
    }
}
