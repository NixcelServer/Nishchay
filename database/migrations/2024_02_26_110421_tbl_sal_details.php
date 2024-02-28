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
            $table->integer('tbl_user_id')->nullable();
            $table->integer('actual_gross')->nullable();
            $table->integer('basic')->nullable();
            $table->integer('hra')->nullable();
            $table->integer('special_allowance')->nullable();
            $table->integer('medical_allowance')->nullable();
            $table->integer('statutory_bonus')->nullable();
            $table->integer('payable_gross_salary')->nullable();
            $table->integer('pf')->nullable();
            $table->integer('tds')->nullable();
            $table->integer('pt')->nullable();
            $table->integer('net_salary')->nullable();
            $table->integer('ctc')->nullable();
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
        Schema::dropIfExists('tbl_sal_details');
    }
};
