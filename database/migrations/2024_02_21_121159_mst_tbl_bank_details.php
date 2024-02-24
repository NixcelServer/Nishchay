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
        Schema::create('mst_tbl_bank_details', function (Blueprint $table) {
            $table->id('tbl_bank_details_id');
            $table->integer('tbl_user_id');
            $table->string('bank_name')->required();
            $table->string('branch')->required();
            $table->string('city')->required();
            $table->string('ifsc')->required();
            $table->string('account_no')->unique();
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->integer('update_by');
            $table->date('update_date');
            $table->time('update_time');
            $table->string('flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_tbl_bank_details');
    }
};
