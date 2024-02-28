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
        Schema::create('tbl_epf_essi_details', function (Blueprint $table) {
            $table->id('tbl_epf_essi_detail_id');
            $table->integer('tbl_user_id')->nullable();
            $table->string('uan')->unique();
            $table->string('old_epf_no')->unique();
            $table->string('nixcel_epf_no')->unique();
            $table->string('nixcel_essi_no')->unique();
            $table->string('nominee_name')->nullable();
            $table->string('relation_with_nominee')->nullable();
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
        Schema::dropIfExists('tbl_epf_essi_details');
    }
};
