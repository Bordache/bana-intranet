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
            $table->string('exact_assignment')->nullable();
            $table->date('interruption_start_date')->nullable();
            $table->date('interruption_end_date')->nullable();
            $table->string('military_status')->nullable();
            $table->string('military_status_reference')->nullable();
            $table->string('military_driver_license')->nullable();
            $table->text('other_information')->nullable();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->string('driver_license')->nullable();
            $table->text('practiced_sport')->nullable();
            $table->text('hobbies')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_details', function (Blueprint $table) {
            $table->dropColumn([
                'exact_assignment',
                'interruption_start_date',
                'interruption_end_date',
                'military_status',
                'military_status_reference',
                'military_driver_license',
                'other_information',
            ]);
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['driver_license', 'practiced_sport', 'hobbies']);
        });
    }
};
