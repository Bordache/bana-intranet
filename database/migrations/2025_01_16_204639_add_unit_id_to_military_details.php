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
        Schema::table('military_details', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->after('unit_assignment');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_details', function (Blueprint $table) {
            $table->dropColumn(['unit_id']);
        });
    }
};
