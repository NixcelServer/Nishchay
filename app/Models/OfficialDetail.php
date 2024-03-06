<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_official_details';
    protected $primaryKey = 'tbl_user_id';
    public $timestamps = false;

    protected $attributes = [
        'tbl_official_detail_id' => null,
        'tbl_user_id' => null,
        'official_email_id' => null,
        'work_location' => null,
        'reporting_manager_id' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show', // Assuming 'show' is the default value for 'flag'
    ];
}
