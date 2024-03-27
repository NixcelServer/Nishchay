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
        Schema::create('tbl_docs', function (Blueprint $table) {
            $table->id('tbl_doc_id');
            $table->integer('tbl_user_id');
            $table->integer('tbl_doc_type_id');
            $table->string('doc_name');
            $table->string('doc_path');
            $table->string('doc_status');
            $table->integer('add_by');
            $table->date('add_date');
            $table->time('add_time');
            $table->integer('verified_by');
            $table->date('verified_date');
            $table->time('verified_time');
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
        Schema::dropIfExists('tbl_docs');
    }
};
