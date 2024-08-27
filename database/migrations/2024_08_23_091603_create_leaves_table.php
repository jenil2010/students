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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_apply_by')->index();
            $table->foreign('leave_apply_by')->references('id')->on('users');
            $table->text('reason');
            $table->date('leave_from');
            $table->date('leave_to');
            $table->unsignedBigInteger('approve_by')->index()->nullable();
            $table->foreign('approve_by')->references('id')->on('users');
            $table->text('note');
            $table->string('leave_status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
