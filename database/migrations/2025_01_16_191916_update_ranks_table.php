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
        Schema::table('ranks', function (Blueprint $table) {
            $table->renameColumn('name', 'rank_name');
            $table->renameColumn('abbreviate', 'rank_abbreviate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ranks', function (Blueprint $table) {
            $table->renameColumn('rank_name', 'name');
            $table->renameColumn('rank_abbreviate', 'abbreviate');
        });
    }
};
