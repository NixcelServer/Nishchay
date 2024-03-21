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
            $table->id('tbl_id');
            $table->integer('tbl_user_id');
            $table->integer('tbl_doc_type_id');
            $table->integer('doc_name');
            $table->string('doc_path');
            
            
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
