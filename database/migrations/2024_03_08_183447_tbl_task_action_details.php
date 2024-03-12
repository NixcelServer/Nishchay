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
        Schema::create('tbl_task_action_details', function (Blueprint $table) {
            $table->id('tbl_action_id');
            $table->integer('tbl_task_detail_id');
            $table->string('action_name');
            $table->integer('action_by');
            $table->date('action_date');
            $table->time('action_time');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_task_action_details');
    }
};
