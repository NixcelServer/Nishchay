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
        Schema::create('mst_tbl_auditlog_details', function (Blueprint $table) {
            $table->id('tbl_auditlog_detail_id');
            $table->string('activity_name')->required();
            $table->integer('activity_by')->required();
            $table->date('activity_date')->required();
            $table->time('activity_time')->required();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_tbl_auditlog_details');
    }
};
