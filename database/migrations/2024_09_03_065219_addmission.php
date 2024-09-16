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
        Schema::create('addmission', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->char('gender')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('address')->nullable();
            $table->string('village')->nullable();
            $table->string('adhaar_number')->nullable();
            $table->string('nationality')->nullable();
            $table->boolean('is_any_illness')->nullable()->default(0);
            $table->text('illness_description')->nullable();
            $table->string('vehicle')->nullable()->default(0);
            $table->boolean('is_have_helmet')->default(0);
            $table->string('vehicle_number')->nullable();
            $table->longText('licence_doc_url')->nullable();
            $table->longText('rcbook_front_doc_url')->nullable(); 
            $table->longText('rcbook_back_doc_url')->nullable(); 
            $table->text('father_full_name')->nullable(); 
            $table->text('father_phone')->nullable(); 
            $table->text('father_occupation')->nullable(); 
            $table->text('mother_full_name')->nullable(); 
            $table->text('mother_phone')->nullable(); 
            $table->text('mother_occupation')->nullable();
            $table->decimal('annual_income', 15, 2)->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('semester')->nullable();
            $table->string('institute_name')->nullable();
            $table->integer('year_of_addmission')->nullable();
            $table->date('addmission_date')->nullable();
            $table->time('college_start_time')->nullable();
            $table->time('college_end_time')->nullable();
            $table->string('college_fees_receipt_no')->nullable();
            $table->date('college_fees_receipt_date')->nullable();
            $table->date('arriving_date')->nullable();
            $table->longText('student_photo_url')->nullable(); 
            $table->longText('parent_photo_url')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
