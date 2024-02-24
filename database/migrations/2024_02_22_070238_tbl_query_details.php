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
        Schema::create('tbl_query_details', function (Blueprint $table) {
            $table->id('tbl_query_detail_id');
            $table->string('query_description')->required();
            $table->string('query_solution');
            $table->date('query_answered_date');
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
        Schema::dropIfExists('tbl_query_details');
    }
};
