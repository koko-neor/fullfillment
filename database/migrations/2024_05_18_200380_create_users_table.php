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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username');
            $table->string('password');
            $table->foreignId('role_id')->nullable()->constrained('roles', 'role_id');
            $table->foreignId('organization_id')->nullable()->constrained('organizations', 'organization_id');
            $table->boolean('is_superadmin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
