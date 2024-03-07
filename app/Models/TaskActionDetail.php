<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActionDetail extends Model
{
    use HasFactory;
    protected $table = 'tbl_task_action_details';
    public $timestamps = false;
}
