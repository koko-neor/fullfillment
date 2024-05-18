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
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->id('entry_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->foreignId('warehouse_id')->constrained('warehouses', 'warehouse_id');
            $table->integer('quantity_received')->nullable();
            $table->dateTime('date_received')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_entries');
    }
};
