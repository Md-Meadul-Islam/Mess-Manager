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
            $table->string('title', 100);
            $table->string('from_month', 100);
            $table->string('details');
            $table->string('address');
            $table->string('contacts', 100);
            $table->string('photo_1')->default('toletdefault.png');
            $table->string('photo_2')->default('toletdefault.png');
            $table->timestamps();
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
