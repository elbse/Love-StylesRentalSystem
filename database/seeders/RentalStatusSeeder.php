<?php

namespace Database\Seeders;

use App\Models\RentalStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Active',
            'Completed',
            'Overdue',
            'Cancelled',
            'Returned'
        ];

        foreach ($statuses as $status) {
            RentalStatus::create(['status_name' => $status]);
        }
    }
}
