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
        Schema::table('honorary_distinctions', function (Blueprint $table) {
            $table->renameColumn('title', 'honorary_title');
            $table->renameColumn('promotion', 'honorary_promotion');
            $table->renameColumn('reference', 'honorary_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('honorary_distinctions', function (Blueprint $table) {
            $table->renameColumn('honorary_title', 'title');
            $table->renameColumn('honorary_promotion', 'promotion');
            $table->renameColumn('honorary_reference', 'reference');
        });
    }
};
