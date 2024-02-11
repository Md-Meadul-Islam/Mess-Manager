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
        Schema::create('tolets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('title', 100);
            $table->string('from_month', 100);
            $table->string('details');
            $table->string('address');
            $table->string('contacts', 100);
            $table->string('photo_1')->default('toletdefault.png');
            $table->string('photo_2')->default('toletdefault.png');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tolets');
    }
};
