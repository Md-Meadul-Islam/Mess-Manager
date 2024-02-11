<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('username', 15)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 25)->unique();
            $table->string('otp', 6)->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('photo', 50)->default('default.png');
            $table->text('address')->nullable();
            $table->enum('role', ['admin', 'manager', 'mate'])->default('manager');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->rememberToken();
            $table->string('batch', 50);
            $table->string('create_at', 8)->nullable();
            $table->string('update_at', 8)->nullable();
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
