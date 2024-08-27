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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable()->index();
            $table->unsignedBigInteger('country_id')->index();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->date('dob');
            $table->string('gender', 20);
            $table->text('address');
            $table->string('village');
            $table->string('is_any_illness')->default(0);
            $table->string('illness_description')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->tinyInteger('status')->default(1)->comment("1 => Active, 0 => Inactive");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
