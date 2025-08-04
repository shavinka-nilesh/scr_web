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
        Schema::table('coaches', function (Blueprint $table) {
            // Add the foreign key column (nullable if you already have coaches without a sport type)
            $table->unsignedBigInteger('sport_type_id')->nullable()->after('id');

            // Add the foreign key constraint
            $table->foreign('sport_type_id')
                  ->references('id')
                  ->on('sport_types')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coaches', function (Blueprint $table) {
             // Drop foreign key + column
            $table->dropForeign(['sport_type_id']);
            $table->dropColumn('sport_type_id');
        });
    }
};
