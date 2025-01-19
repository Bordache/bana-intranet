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
            $table->unsignedBigInteger('rank_id')->after('rank');
            $table->foreign('rank_id')->references('id')->on('ranks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_details', function (Blueprint $table) {
            $table->dropColumn('rank_id');
        });
    }
};
