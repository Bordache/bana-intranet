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
        Schema::create('military_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('army');
            $table->string('position');
            $table->date('position_date')->nullable();
            $table->string('position_reference')->nullable();
            $table->string('military_registration_number', 6);
            $table->string('military_id_card_number')->nullable();
            $table->string('finance_registration_number')->nullable();
            $table->string('recruitment_origin')->nullable();
            $table->string('recruitment_promotion')->nullable();
            $table->date('service_entry_date');
            $table->string('corps_assignment');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('rank_id');
            $table->date('rank_date')->nullable();
            $table->string('current_function')->nullable();
            $table->string('specialty')->nullable();
            $table->string('exact_assignment')->nullable();
            $table->date('interruption_start_date')->nullable();
            $table->date('interruption_end_date')->nullable();
            $table->string('military_status')->nullable();
            $table->string('military_status_reference')->nullable();
            $table->string('military_driver_license')->nullable();
            $table->text('other_information')->nullable();
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_details');
    }
};
