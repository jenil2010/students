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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreign('addmission_id')->references('student_id')->on('addmission');
            $table->bigInteger('serial_number')->nullable();
            $table->string('financial_year')->nullable();
            $table->string('donation_type');
            $table->unsignedBigInteger('addmission_id')->index();
            $table->string('student_name');
            $table->string('father_name');
            $table->string('address');
            $table->string('fees_amount');
            $table->string('payment_type');
            $table->string('bank_name')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('payment_method');
            $table->date('paid_at');
            $table->tinyInteger('status')->default(0)->comment("1 => Paid, 0 => UnPaid");
            $table->string('transaction_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
