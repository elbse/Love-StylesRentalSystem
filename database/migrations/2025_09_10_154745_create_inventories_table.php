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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id('item_id');
            $table->enum('item_type', ['Gown', 'Suit'])->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('size');
            $table->string('color');
            $table->string('design');
            $table->string('rental_price')->nullable(false);
            $table->enum('item_condition', ['good', 'damaged', 'under repair', 'retired'])->default('good');
            $table->foreignId('status_id')->constrained('inventory_status', 'status_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
