<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousEmploymentDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_prev_emp_details';
    public $timestamps = false;

    protected $attributes = [
        'tbl_prev_emp_detail_id' => null,
        'tbl_user_id' => null,
        'company_name' => null,
        'start_date' => null,
        'end_date' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'flag' => 'show', // Assuming 'show' is the default value for 'flag'
    ];
}
