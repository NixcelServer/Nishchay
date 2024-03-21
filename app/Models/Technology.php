<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $table = 'mst_tbl_technologies';
    protected $primaryKey = 'tbl_tech_id';
    public $timestamps = false;
}
