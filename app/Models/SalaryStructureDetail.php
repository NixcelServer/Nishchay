<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStructureDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_sal_details';
    public $timestamps = false;
    
    protected $primaryKey = 'tbl_user_id';

    protected $attributes = [
        'tbl_sal_detail_id' => null,
        'tbl_user_id' => null,
        'actual_gross' => null,
        'basic' => null,
        'hra' => null,
        'special_allowance' => null,
        'medical_allowance' => null,
        'statutory_bonus' => null,
        'payable_gross_salary' => null,
        'pf' => null,
        'tds' => null,
        'pt' => null,
        'net_salary' => null,
        'ctc' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show', // Assuming 'show' is the default value for 'flag'
    ];

}
