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
        Schema::create('tbl_sal_details', function (Blueprint $table) {
            $table->id('tbl_sal_detail_id');
            $table->integer('tbl_user_id');
            $table->integer('actual_gross');
            $table->integer('basic');
            $table->integer('hra');
            $table->integer('special_allowance');
            $table->integer('medical_allowance');
            $table->integer('statutory_bonus');
            $table->integer('payable_gross_salary');
            $table->integer('pf');
            $table->integer('tds');
            $table->integer('pt');
            $table->integer('net_salary');
            $table->integer('ctc');
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
        Schema::dropIfExists('tbl_sal_details');
    }
};
