<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicPathsTable extends Migration
{
    public function up()
    {
        Schema::create('academic_paths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('school_name');
            $table->string('duration');
            $table->string('diploma')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_paths');
    }
}
