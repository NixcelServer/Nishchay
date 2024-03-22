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
        Schema::create('mst_tbl_technologies', function (Blueprint $table) {
            $table->id('tbl_tech_id');
            $table->string('tech_name');
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->integer('deleted_by');
            $table->date('deleted_date');
            $table->time('deleted_time');
            $table->string('flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_tbl_technologies');
    }
};
