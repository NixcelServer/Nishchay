<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mst_tbl_roles', function (Blueprint $table) {
            $table->id('tbl_role_id'); // Auto-incrementing primary key
            $table->string('role_name')->unique();
            $table->date('add_date');
            $table->time('add_time');
            $table->date('updated_date');
            $table->time('updated_time');
            $table->string('flag');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_tbl_roles');
    }
};
