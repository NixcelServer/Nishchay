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
        Schema::create('tbl_emp_details', function (Blueprint $table) {
            $table->id('tbl_employee_detail_id');
            $table->integer('tbl_user_id')->nullable();
            $table->integer('offer_letter_no')->unique();
            $table->integer('emp_code')->unique();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('current_age')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('permanent_address')->nullable();
            $table->integer('tbl_dept_id')->nullable();
            $table->integer('tbl_designation_id')->nullable();
            $table->integer('tbl_role_id')->nullable();
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
        Schema::dropIfExists('tbl_emp_details');
    }
};
