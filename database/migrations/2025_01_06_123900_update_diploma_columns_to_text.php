<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academic_paths', function (Blueprint $table) {
            $table->text('diploma')->change();
        });

        Schema::table('military_paths', function (Blueprint $table) {
            $table->text('academy_diploma')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_paths', function (Blueprint $table) {
            $table->string('diploma')->change();
        });

        Schema::table('military_paths', function (Blueprint $table) {
            $table->string('academy_diploma')->change();
        });
    }
};
