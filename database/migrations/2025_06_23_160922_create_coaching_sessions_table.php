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
        Schema::create('coaching_sessions', function (Blueprint $table) {
            $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('coach_id')->constrained();
    $table->dateTime('session_date');
    $table->dateTime('start_time');
    $table->dateTime('end_time');
    $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaching_sessions');
    }
};
