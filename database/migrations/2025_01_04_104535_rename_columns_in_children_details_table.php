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
        Schema::table('children_details', function (Blueprint $table) {
            $table->renameColumn('full_name', 'child_full_name');
            $table->renameColumn('birth_date', 'child_birth_date');
            $table->renameColumn('birth_place', 'child_birth_place');
            $table->renameColumn('gender', 'child_gender');
            $table->renameColumn('status', 'child_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children_details', function (Blueprint $table) {
            $table->renameColumn('child_full_name', 'full_name');
            $table->renameColumn('child_birth_date', 'birth_date');
            $table->renameColumn('child_birth_place', 'birth_place');
            $table->renameColumn('child_gender', 'gender');
            $table->renameColumn('child_status', 'status');
        });
    }
};
