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
            $table->id('tbl_epf_essi__detail_id');
            $table->integer('tbl_user_id');
            $table->string('uan')->unique();
            $table->string('old_epf_no')->unique();
            $table->string('nixcel_epf_no')->unique();
            $table->string('nixcel_essi_no')->unique();
            $table->string('nominee_name')->required();
            $table->string('relation_with_nominee')->required();
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
        Schema::dropIfExists('tbl_epf_essi_details');
    }
};
