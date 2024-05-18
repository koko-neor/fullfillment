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
        Schema::create('order_tasks', function (Blueprint $table) {
            $table->id('task_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('assigned_to')->constrained('users', 'user_id');
            $table->string('task_type')->nullable();
            $table->string('status')->nullable();
            $table->string('comments')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_tasks');
    }
};
