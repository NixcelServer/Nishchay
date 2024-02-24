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
        Schema::create('mst_tbl_users', function (Blueprint $table) {
            $table->id('tbl_user_id');
            $table->string('first_name')->required();
            $table->string('middle_name');
            $table->string('last_name')->required();
            $table->string('email')->unique()->required();
            $table->string('password')->required();
            $table->integer('tbl_role_id')->required();
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
        Schema::dropIfExists('mst_tbl_users');
    }
};
