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
        Schema::create('student_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedBigInteger('addmission_id')->index();
            $table->foreign('addmission_id')->references('id')->on('addmission');
            $table->string('addmission_year');
            $table->unsignedBigInteger('hostel_id')->index();
            $table->foreign('hostel_id')->references('id')->on('hostels');
            $table->string('room_id');
            $table->unsignedBigInteger('bed_id');
            $table->foreign('bed_id')->references('id')->on('beds');
            $table->string('is_bed_release')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_map');
    }
};
