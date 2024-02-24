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
        Schema::create('mst_tbl_employee_details', function (Blueprint $table) {
            $table->id('tbl_employee_detail_id');
            $table->integer('tbl_user_id');
            $table->integer('offer_letter_no')->unique();
            $table->string('title');
            $table->string('first_name')->required();
            $table->string('middle_name');
            $table->string('last_name')->required();
            $table->string('gender');
            $table->date('birth_date')->required();
            $table->integer('current_age');
            $table->string('country')->required();
            $table->string('state')->required();
            $table->string('city');
            $table->integer('pincode')->required();
            $table->string('permanent_address')->required();
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->integer('role_id');
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
        Schema::dropIfExists('mst_tbl_employee_details');
    }
};
