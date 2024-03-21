<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $table = 'mst_tbl_doc_type';

    protected $primaryKey = 'tbl_doc_type_id';

    public $timestamps = false;
}
