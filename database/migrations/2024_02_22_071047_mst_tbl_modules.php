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
        Schema::create('mst_tbl_modules', function (Blueprint $table) {
            $table->id('tbl_module_id');
            $table->string('module_name')->required();
            $table->string('module_path')->required();
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
        Schema::dropIfExists('mst_tbl_modules');
    }
};
