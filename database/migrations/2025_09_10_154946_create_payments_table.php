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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->foreignId('rental_id')->constrained('rentals', 'rental_id')->onDelete('cascade');
            $table->decimal('amount', 10,2)->nullable(false);
            $table->enum('payment_method', ['cash', 'card', 'bank_transfer'])->nullable(false);
            $table->dateTime('payment_date')->nullable(false)->useCurrent();
            $table->foreignId('processed_by')->constrained('users', 'user_id')->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
