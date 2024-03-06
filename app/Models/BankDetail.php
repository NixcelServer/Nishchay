<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_bank_details';
    public $timestamps = false;
    protected $primaryKey = 'tbl_user_id';

    protected $attributes = [
        'tbl_user_id' => null,
        'bank_name' => null,
        'branch' => null,
        'city' => null,
        'ifsc' => null,
        'account_no' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show',
    ];
}
