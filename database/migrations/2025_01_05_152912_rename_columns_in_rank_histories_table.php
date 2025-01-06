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
        Schema::table('rank_histories', function (Blueprint $table) {
            $table->renameColumn('rank', 'history_rank');
            $table->renameColumn('promotion_date', 'history_promotion_date');
            $table->renameColumn('rank_reference', 'history_rank_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rank_histories', function (Blueprint $table) {
            $table->renameColumn('history_rank', 'rank');
            $table->renameColumn('history_promotion_date', 'promotion_date');
            $table->renameColumn('history_rank_reference', 'rank_reference');
        });
    }
};
