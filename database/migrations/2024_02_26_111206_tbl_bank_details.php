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
        Schema::create('tbl_bank_details', function (Blueprint $table) {
            $table->id('tbl_bank_details_id');
            $table->integer('tbl_user_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('city')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('account_no',18)->unique();
            $table->integer('add_by')->nullable();
            $table->date('add_date')->nullable();
            $table->time('add_time')->nullable();
            $table->integer('update_by')->nullable();
            $table->date('update_date')->nullable();
            $table->time('update_time')->nullable();
            $table->string('flag')->default('show');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bank_details');
    }
};
