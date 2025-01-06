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
        Schema::table('spouse_details', function (Blueprint $table) {
            $table->renameColumn('name', 'spouse_name');
            $table->renameColumn('maiden_name', 'spouse_maiden_name');
            $table->renameColumn('firstname', 'spouse_firstname');
            $table->renameColumn('birth_date', 'spouse_birth_date');
            $table->renameColumn('birth_place', 'spouse_birth_place');
            $table->renameColumn('profession', 'spouse_profession');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spouse_details', function (Blueprint $table) {
            $table->renameColumn('spouse_name', 'name');
            $table->renameColumn('spouse_maiden_name', 'maiden_name');
            $table->renameColumn('spouse_firstname', 'firstname');
            $table->renameColumn('spouse_birth_date', 'birth_date');
            $table->renameColumn('spouse_birth_place', 'birth_place');
            $table->renameColumn('spouse_profession', 'profession');
        });
    }
};
