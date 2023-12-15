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
        Schema::create('monthly_tables', function (Blueprint $table) {
            $table->id();
            $table->text('user_id')->nullable();
            $table->string('month')->default(now()->format("M-Y"));
            $table->text('dailymeals')->default(0);
            $table->bigInteger('totalmeals')->nullable();
            $table->text('dailybazar')->default(0);
            $table->bigInteger('totalbazar')->nullable();
            $table->text('other_expence')->nullable();
            $table->bigInteger('expence_total')->nullable();
            $table->float('meal_rate')->nullable();
            $table->string('batch')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_tables');
    }
};
