<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_additional_details';
    public $timestamps = false;

    protected $attributes = [
        'tbl_user_id' => null,
        'employment_status' => null,
        'technology' => null,
        'module' => null,
        'join_date' => null,
        'position_change_date' => null,
        'position_change_status' => null,
        'exit_date' => null,
        'fnf_payable_date' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show',
    ];
}
