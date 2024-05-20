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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('organization_id')->constrained('organizations', 'organization_id');
            $table->foreignId('warehouse_id')->constrained('warehouses', 'warehouse_id');
            $table->string('name')->nullable();
            $table->string('article')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->string('weight')->nullable();
            $table->string('manufacturer')->nullable();
            $table->text('sku')->nullable();
            $table->text('location')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
