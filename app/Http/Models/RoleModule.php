<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModule extends Model
{
    use HasFactory;
    protected $table = 'tbl_role_modules';
    public $timestamps = false;
    protected $primaryKey = 'tbl_role_module_id';
}
