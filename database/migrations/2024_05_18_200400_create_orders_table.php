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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('organization_id')->constrained('organizations', 'organization_id');
            $table->foreignId('warehouse_id')->constrained('warehouses', 'warehouse_id');
            $table->string('type')->nullable();
            $table->string('marketplace')->nullable();
            $table->string('status')->nullable();
            $table->string('seller_comments')->nullable();
            $table->string('warehouse_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
