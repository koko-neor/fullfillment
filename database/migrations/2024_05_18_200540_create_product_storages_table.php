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
        Schema::create('product_storages', function (Blueprint $table) {
            $table->id('storage_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->foreignId('block_id')->constrained('storage_blocks', 'block_id');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_storages');
    }
};
