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
        Schema::create('mst_tbl_additional_details', function (Blueprint $table) {
            $table->id('tbl_addtional_detail_id');
            $table->integer('tbl_user_id');
            $table->string('employment_status');
            $table->string('technology');
            $table->string('module');
            $table->date('join_date');
            $table->date('position_change_date');
            $table->string('position_change_status');
            $table->date('exit_date');
            $table->date('fnf_payable_date');
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
        Schema::dropIfExists('mst_tbl_additional_details');
    }
};
