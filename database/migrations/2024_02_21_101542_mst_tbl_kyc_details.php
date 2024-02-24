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
        Schema::create('mst_tbl_kyc_details', function (Blueprint $table) {
            $table->id('tbl_kyc_detail_id');
            $table->integer('aadharcard_no')->unique()->required();
            $table->integer('pancard_no')->unique()->required();
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->string('flag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_tbl_kyc_details');
    }
};
