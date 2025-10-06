<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerStatus;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Seed some customer statuses if none exist
        if (CustomerStatus::count() === 0) {
            CustomerStatus::factory()->create([
                'status_name' => 'Active',
                'reason' => 'Default',
            ]);
            CustomerStatus::factory()->create([
                'status_name' => 'Deactivated',
                'reason' => 'Created by seeder',
            ]);
        }

        // Create customers (will pick existing status_id or create via factory)
        Customer::factory()->count(20)->create();
    }
}
