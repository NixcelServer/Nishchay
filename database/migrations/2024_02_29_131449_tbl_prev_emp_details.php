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
        Schema::create('tbl_prev_emp_details', function (Blueprint $table) {
            $table->id('tbl_prev_empl_detail_id');
            $table->integer('tbl_user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('add_by')->nullable();
            $table->date('add_date')->nullable();
            $table->time('add_time')->nullable();
            $table->string('flag')->default('show');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_prev_emp_details');
    }
};
