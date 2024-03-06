<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
     //show tasks
     public function showTasks()
     {
        //  $userdetails = session('user');
        //  $user_id = $userdetails->tbl_user_id;
 
        //  $tasks = TaskDetail::where('tbl_user_id', $user_id)->where('flag', 'show')->get();
 
        //  foreach ($tasks as $task) {
        //      // Encode the task ID using the helper function
        //      $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
        //  }
 
         return view('frontend_tasks.showTasks');
        //  ,compact('tasks'));
     }

    public function viewTask($enc_task_id)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_details_id',$dec_task_id)->first();

        return view('frontend_tasks.viewTask',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    }

    public function updateTaskStatus(Request $request)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        $task->task_status = $request->task_status;
        $task->task_solution = $request->task_solution;
        $task->update_date = Date::now()->toDateString();
        $task->update_time = Date::now()->toTimeString();
        $task->save();
    }
     
    public function transferTaskForm($enc_task_id)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        return view('frontend_tasks.transferTask',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    }
     
    public function transferTask(Request $request)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        $task->remark = $request->remark;
        $task->transferred_status = 'pending';
        $task->save;

    }



    public function showReassignedTasks()
    {
        $reassigned_tasks; 
    }

    public function showInProgressTasks()
    {
         $userdetails = session('user');
         $user_id = $userdetails->tbl_user_id;
 
         $tasks = TaskDetail::where('tbl_user_id', $user_id)->where('flag', 'show')->where('status','in progress')->get();

         foreach($tasks as $task)
         {
            // Encode the task ID using the helper function
            $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
         }

         return view('frontend_tasks.inProgressTasks',['tasks'=>$tasks]);

    }

    // public function completedTasks()
    // {
    //     $userdetails = session('user');
    //     $user_id = $userdetails->tbl_user_id;
 
    //     $tasks = TaskDetail::where('tbl_user_id', $user_id)->where('flag', 'show')->where('status','completed')->get();

    //     foreach($tasks as $task)
    //     {
    //         // Encode the task ID using the helper function
    //         $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
    //     }

    //     return view('frontend_tasks.completedTasks',['tasks'=>$tasks]);

    // }

    //show create task form
    public function createTask()
    {
        $roles = RoleModule::where('tbl_module_id',20)->get();
        $users = User::whereIn('tbl_role_id', $roles->pluck('id'))->get();

        foreach($users as $user)
        {
            $user->enc_user_id = EncryptionDecryptionHelper::encdecId($user->mst_tbl_users,'encrypt');
        }
        return view('frontend_tasks.createTask',['users'=>$users]);

    }


    public function PendingTasks()
    {
        return view('frontend_tasks.pending_tasks');

    }
    public function CompletedTasks()
    {
        return view('frontend_tasks.completed_tasks');

    }
    
    
    public function InprogessTasks()
    {
        return view('frontend_tasks.inprogress_tasks');

    }
    public function ReassignedTasks()
    {
        return view('frontend_tasks.reassigned_tasks');

    }
    public function ViewTasks()
    {
        return view('frontend_tasks.view_task_page');

    }

    
    
    
}
