<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $table = 'mst_tbl_depts';
    public $timestamps = false;
    protected $primaryKey = 'tbl_dept_id';

    use HasFactory;
}
