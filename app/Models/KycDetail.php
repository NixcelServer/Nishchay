<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_kyc_details';
    public $timestamps = false;

    protected $attributes = [
        'tbl_kyc_detail_id' => null,
        'aadharcard_no' => null,
        'pancard_no' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'flag' => 'show'
    ];
}
