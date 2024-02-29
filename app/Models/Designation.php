<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'mst_tbl_designations';
    protected $primaryKey = 'tbl_designation_id';
    public $timestamps = false;
}
