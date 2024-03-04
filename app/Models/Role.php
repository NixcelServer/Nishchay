<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'mst_tbl_roles';
    public $timestamps = false;
    public $primaryKey = 'tbl_role_id';
}
