<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Pending',
            'Completed',
            'Failed',
            'Refunded',
            'Cancelled'
        ];

        foreach ($statuses as $status) {
            PaymentStatus::create(['status_name' => $status]);
        }
    }
}
