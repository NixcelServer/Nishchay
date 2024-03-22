<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'tbl_docs';
    protected $primaryKey = 'tbl_doc_id';
    public $timestamps = false;
}
