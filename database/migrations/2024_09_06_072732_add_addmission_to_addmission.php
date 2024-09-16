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
        Schema::table('addmission', function (Blueprint $table) {
            $table->tinyInteger('is_fees_paid')->comment("1 => Paid, 0 => UnPaid")->after('arriving_date');
            $table->tinyInteger('is_admission_confirm')->comment("1 => Confirm, 0 => Not Confirm")->after('is_fees_paid');
            $table->string('note')->nullable()->after('is_admission_confirm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addmission', function (Blueprint $table) {
            //
        });
    }
};
