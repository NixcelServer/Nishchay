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
        Schema::create('tbl_kyc_details', function (Blueprint $table) {
            $table->id('tbl_kyc_detail_id');
            $table->string('aadharcard_no', 12)->unique()->required();
            $table->string('pancard_no', 10)->unique()->required();
            $table->integer('add_by')->nullable();
            $table->date('add_date')->nullable();
            $table->time('add_time')->nullable();
            $table->string('flag')->default('show');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kyc_details');
    }
};
