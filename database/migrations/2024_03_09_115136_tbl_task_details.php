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
        Schema::create('tbl_task_details', function (Blueprint $table) {
            $table->id('tbl_task_detail_id');
            $table->string('task_description')->required();
            $table->integer('selected_user_id')->required();
            $table->date('task_delivery_date');
            $table->date('task_completion_date');
            $table->string('task_status')->nullable();
            $table->string('task_solution')->nullable();
            $table->string('remark')->nullable();
            $table->string('transferred_status')->nullable();
            $table->integer('add_by');
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
        Schema::dropIfExists('tbl_task_details');
    }
};