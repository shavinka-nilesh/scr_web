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
        Schema::table('bookings', function (Blueprint $table) {
             // assuming coaches.id is unsignedBigInteger
            $table->unsignedBigInteger('coach_id')->after('facility_id')->nullable();

            // if you want to enforce referential integrity:
            $table->foreign('coach_id')
                  ->references('id')->on('coaches')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
              $table->dropForeign(['coach_id']);
            $table->dropColumn('coach_id');
        });
    }
};
