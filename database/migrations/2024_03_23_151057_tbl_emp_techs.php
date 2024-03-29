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
        //
        Schema::create('tbl_emps_techs', function (Blueprint $table) {
            $table->id('tbl_emps_tech_id');
            $table->unsignedBigInteger('tbl_tech_id');
            $table->unsignedBigInteger('tbl_employee_detail_id');
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->integer('deleted_by')->nullabe();
            $table->date('deleted_date')->nullable();
            $table->time('deleted_time')->nullable();
            $table->string('flag');

            $table->foreign('tbl_tech_id')->references('tbl_tech_id')->on('mst_tbl_technologies')->onDelete('cascade');
            $table->foreign('tbl_employee_detail_id')->references('tbl_employee_detail_id')->on('tbl_emp_details')->onDelete('cascade');
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tbl_emps_techs');
    }
};
