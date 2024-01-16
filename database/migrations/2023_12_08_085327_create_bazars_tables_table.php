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
        Schema::create('bazars_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('month')->nullable();
            $table->date("date")->nullable();
            $table->string('total');
            $table->text('details');
            $table->unsignedInteger('status', 1)->default(0);
            $table->enum('role', ['manager', 'mate'])->default('mate');
            $table->string('batch');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('create_at', 8)->nullable();
            $table->string('update_at', 8)->nullable();
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bazars_tables');
    }
};
