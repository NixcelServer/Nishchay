<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpfEssiDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_epf_essi_details';
    public $timestamps = false;

    protected $attributes = [
        'tbl_epf_essi_detail_id' => null,
        'tbl_user_id' => null,
        'uan' => null,
        'old_epf_no' => null,
        'nixcel_epf_no' => null,
        'nixcel_essi_no' => null,
        'nominee_name' => null,
        'relation_with_nominee' => null,
        'add_by' => null,
        'add_date' => null,
        'add_time' => null,
        'update_by' => null,
        'update_date' => null,
        'update_time' => null,
        'flag' => 'show'
    ];
}
