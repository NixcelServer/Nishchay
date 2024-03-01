<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskDetail;
use App\Helpers\EncryptionDecryptionHelper;
use Illuminate\Support\Facades\Date;

class DevController extends Controller
{
    //upon log in show dashboard
    public function dashboard()
    {
         return view('frontend_home.dashboard');           
    }

    //show tasks
    public function showTasks()
    {
        $userdetails = session('user');
        $user_id = $userdetails->tbl_user_id;

        $tasks = TaskDetail::where('tbl_user_id', $user_id)->where('flag', 'show')->get();

        foreach ($tasks as $task) {
            // Encode the task ID using the helper function
            $task->encrypted_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_id, 'encrypt');
        }

        return view('dev.showTasks',compact('tasks'));
    }
}
