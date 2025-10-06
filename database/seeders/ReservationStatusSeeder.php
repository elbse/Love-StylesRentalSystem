<?php

namespace Database\Seeders;

use App\Models\ReservationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Pending',
            'Confirmed',
            'Cancelled',
            'Completed',
            'Expired'
        ];

        foreach ($statuses as $status) {
            ReservationStatus::create(['status_name' => $status]);
        }
    }
}
