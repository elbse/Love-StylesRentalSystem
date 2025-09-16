<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('rental_id');
            $table->foreignId('reservation_id')->constrained('reservations', 'reservation_id')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('inventories', 'item_id')->onDelete('cascade');
            $table->foreignId('released_by')->constrained('users', 'user_id')->onDelete('cascade');
            $table->dateTime('released_date');
            $table->dateTime('due_date');
            $table->dateTime('return_date');
            $table->enum('status', ['rented', 'returned', 'overdue'])->default('rented');
            $table->decimal('penalty_fee', 10,2)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
