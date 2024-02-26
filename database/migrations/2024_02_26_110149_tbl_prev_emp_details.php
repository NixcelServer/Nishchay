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
            $table->integer('tbl_user_id');
            $table->string('company_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->string('flag');
            
            
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
