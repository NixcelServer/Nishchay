<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_emp_details';
    public $timestamps = false;
    protected $primaryKey = 'tbl_employee_detail_id';

    protected $fillable = [
        // Other fields...
        'address', // Update column name from 'permanent_address' to 'address'
        // Other fields...
    ];

    protected $attributes = [
        'offer_letter_no' => null, // Default to null
        'emp_code' => null, // Default to null
        'title' => null,   // Default to 'show'
        'gender' => null,
        'birth_date' => null,
        'current_age' => null,
        'country' => null,
        'state' => null,
        'city' => null,
        'pincode' => null,
        'permanent_address' => null,
        'tbl_dept_id' => null,
        'tbl_designation_id' => null,
        'tbl_role_id' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show'
    ];  
}
