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
            $table->bigInteger('totalmeals')->default(0);
            $table->text('dailybazar')->default(0);
            $table->bigInteger('totalbazar')->default(0);
            $table->text('other_expence')->default(0);
            $table->bigInteger('expence_total')->default(0);
            $table->float('meal_rate')->default(0);
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
