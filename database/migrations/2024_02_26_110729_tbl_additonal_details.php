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
        Schema::create('tbl_additional_details', function (Blueprint $table) {
            $table->id('tbl_addtional_detail_id');
            $table->integer('tbl_user_id')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('technology')->nullable();
            $table->string('module')->nullable();
            $table->date('join_date')->nullable();
            $table->date('position_change_date')->nullable();
            $table->string('position_change_status')->nullable();
            $table->date('exit_date')->nullable();
            $table->date('fnf_payable_date')->nullable();
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
        Schema::dropIfExists('tbl_additional_details');
    }
};
 
