<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\TaskDetail;
use App\Models\Role;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use App\Models\AuditLogDetail;
use App\Models\Module;
use App\Models\RoleModule;
use Illuminate\Support\Facades\Date;


class TaskController extends Controller
{
    //
     //show tasks
     public function Tasks()
     {
         $userdetails = session('user');
         $user_id = $userdetails->tbl_user_id;

         $moduleData = session('moduleData');
            $myTasksExist = false;
            $showTasksExist = false;

            foreach ($moduleData as $data) {
                if ($data['module']->module_name === 'My Tasks') {
                    $myTasksExist = true;
                }
                if ($data['module']->module_name === 'Show Tasks') {
                    $showTasksExist = true;
                }

                // If both modules are found, exit the loop early
                if ($myTasksExist && $showTasksExist) {
                    break;
                }
            }

            if ($myTasksExist && $showTasksExist) {
                // Both modules exist
                // Do something...
            } elseif ($myTasksExist) {
                $tasks = TaskDetail::where('selected_user_id', $user_id)->where('task_status','Pending')->where('flag', 'show')->get();
                
                foreach ($tasks as $task) 
                {
                    // Encode the task ID using the helper function
                    $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                    // Query the User model to get the name of the user who assigned the task
                    $assignedUser = User::find($task->add_by);
                    if ($assignedUser) {
                        $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                    }
                }
                    
                    $columnName = "Task Assigned By";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName]);
                        
            } elseif ($showTasksExist) {
                 $tasks = TaskDetail::where('add_by',$user_id)->where('task_status','Pending')->where('flag', 'show')->get();
                 
                foreach($tasks as $task)
                    {
                        // Encode the task ID using the helper function
                        $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                        $assignedUser = User::find($task->selected_user_id);
                        if ($assignedUser) {
                            $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                        }
                    }
                    
                    $columnName = "Task Assigned To";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName]);
             
            } else {
                // Neither module exists
                 // Do something else...
                 return redirect('/dashboard');
            }
     
     }

    public function viewTask($enc_task_id)
    {
      
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();
        
         
        return view('frontend_tasks.view_task_page',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    }

    public function updateMyTaskStatus(Request $request)
    {
        
        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();
        
        $task->task_status = $request->status;
        $task->task_solution = $request->solution;
        $task->update_date = Date::now()->toDateString();
        $task->update_time = Date::now()->toTimeString();
        $task->save();

        return redirect('/Tasks');
    }
     
    public function transferMyTaskForm($enc_task_id)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        return view('frontend_tasks.transferMyTask',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    }
     
    public function transferMyTask(Request $request)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        $task->remark = $request->remark;
        $task->transferred_status = 'Pending';
        $task->save;

        return redirect('/Tasks/mytasks');
    }
 
    

    public function showInProgressTasks()
    {
        
         $userdetails = session('user');
         $user_id = $userdetails->tbl_user_id;

         $moduleData = session('moduleData');
            $myTasksExist = false;
            $showTasksExist = false;

            foreach ($moduleData as $data) {
                if ($data['module']->module_name === 'My Tasks') {
                    $myTasksExist = true;
                }
                if ($data['module']->module_name === 'Show Tasks') {
                    $showTasksExist = true;
                }

                // If both modules are found, exit the loop early
                if ($myTasksExist && $showTasksExist) {
                    break;
                }
            }

            if ($myTasksExist && $showTasksExist) {
                // Both modules exist
                // Do something...
            } elseif ($myTasksExist) {
                $tasks = TaskDetail::where('selected_user_id', $user_id)->where('flag', 'show')->where('task_status','In Progress')->get();
                
                foreach ($tasks as $task) 
                {
                    // Encode the task ID using the helper function
                    $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                    // Query the User model to get the name of the user who assigned the task
                    $assignedUser = User::find($task->add_by);
                    if ($assignedUser) {
                        $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                    }
                }
                    $columnName = "Task Assigned By";
                    $title = "In Progress Tasks";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title]);
                        
            } elseif ($showTasksExist) {
                 $tasks = TaskDetail::where('add_by',$user_id)->where('task_status','In Progress')->where('flag', 'show')->get();
                 
                foreach($tasks as $task)
                    {
                        // Encode the task ID using the helper function
                        $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                        $assignedUser = User::find($task->selected_user_id);
                        if ($assignedUser) {
                            $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                        }
                    }
                    $columnName = "Task Assigned To";
                    $title = "In Progress Tasks";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title]);
             
            } else {
                // Neither module exists
                 // Do something else...
                 return redirect('/dashboard');
            }
 
    }


    public function completedTasks()
    {
        $userdetails = session('user');
        $user_id = $userdetails->tbl_user_id;

        $moduleData = session('moduleData');
           $myTasksExist = false;
           $showTasksExist = false;

           foreach ($moduleData as $data) {
               if ($data['module']->module_name === 'My Tasks') {
                   $myTasksExist = true;
               }
               if ($data['module']->module_name === 'Show Tasks') {
                   $showTasksExist = true;
               }

               // If both modules are found, exit the loop early
               if ($myTasksExist && $showTasksExist) {
                   break;
               }
           }

           if ($myTasksExist && $showTasksExist) {
               // Both modules exist
               // Do something...
           } elseif ($myTasksExist) {
               $tasks = TaskDetail::where('selected_user_id', $user_id)->where('flag', 'show')->where('task_status','Completed')->get();
               
               foreach ($tasks as $task) 
               {
                   // Encode the task ID using the helper function
                   $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                   // Query the User model to get the name of the user who assigned the task
                   $assignedUser = User::find($task->add_by);
                   if ($assignedUser) {
                       $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                   }
               }
                   $columnName = "Task Assigned By";
                   $title = "Completed Tasks";
               return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title]);
                       
           } elseif ($showTasksExist) {
                $tasks = TaskDetail::where('add_by',$user_id)->where('task_status','Completed')->where('flag', 'show')->get();
                
               foreach($tasks as $task)
                   {
                       // Encode the task ID using the helper function
                       $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

                       $assignedUser = User::find($task->selected_user_id);
                        if ($assignedUser) {
                            $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                        }
                   }
                   $columnName = "Task Assigned To";
                   $title = "Completed Tasks";
               return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title]);
            
           } else {
               // Neither module exists
                // Do something else...
                return redirect('/dashboard');
           }

    }






    //mng show task
    public function showTask()
    {
       

    }

    //view particular task
    // public function viewTask($enc_task_id)
    // {
    //     $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
    //     $task = TaskDetail::where('tbl_task_details_id',$dec_task_id)->first();
    //     dd($task);
    //     return view('frontend_tasks.viewTask',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    // }


    //delete a particular task
    public function deleteTask($enc_task_id)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_details_id',$dec_task_id)->first();

        if($task->task_status == 'Completed' || $task->task_status == 'In Progress'){
            return redirect()->back()->withError('task cannot be deleted');
        }
        else{
            $task->flag = 'deleted';
            $task->save();
        }
        return redirect('/Tasks/showtasks');

    }
    //show create task form
    public function createTask()
    {
        $module_ids = [20, 25, 29];
        $roles = RoleModule::whereIn('tbl_module_id', $module_ids)->get();

        $users = User::whereIn('tbl_role_id', $roles->pluck('tbl_role_id'))->get();

        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $emps = EmployeeDetail::whereIn('tbl_user_id',$users->pluck('tbl_user_id'))->where('reporting_manger_id',$mng_id)->get();

        foreach($emps as $emp)
        {
            $emp->enc_user_id = EncryptionDecryptionHelper::encdecId($emp->tbl_user_id,'encrypt');
        }
        return view('frontend_tasks.createTask',['emps'=>$emps]);

    }

    //assign task to the emp
     public function assignTask(Request $request)
     {
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $dec_selected_user_id = EncryptionDecryptionHelper::encdecId($request->selected_user_id,'decrypt');


        $task = new TaskDetail;
        $task->task_description = $request->task_description;
        $task->selected_user_id = $dec_selected_user_id;
        $task->task_delivery_date = $request->delivery_date;
        $task->add_by = $mng_id;
        $task->add_date = Date::now()->toDateString();
        $task->add_time = Date::now()->toTimeString();
        $task->flag = 'show';
        $task->save();

        return redirect('/Tasks/showtasks');
     }

     //completed task
    public function completedTask()
    {
        $tasks = TaskDetail::where('task_status','Completed')->get();
        foreach($tasks as $task)
        {
            // Encode the task ID using the helper function
            $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
        }
         return view('frontend_tasks.completedTask',['tasks'=>$tasks]);
    }

    //in progress task
    public function inProgressTask()
    {
        $tasks = TaskDetail::where('task_status','In Progress')->get();
        foreach($tasks as $task)
        {
            // Encode the task ID using the helper function
            $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
        }
         return view('frontend_tasks.inProgressTask',['tasks'=>$tasks]);
    }


    public function showReassignedTasks()
    {
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $tasks = TaskDetail::where('transferred_status','Pending')->where('flag','show')->where('add_by',$mng_id)->get(); 
        foreach($tasks as $task)
        {
            // Encode the task ID using the helper function
            $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_details_id, 'encrypt');
        }
        return view('frontend_tasks.showReassignedTasks',['tasks'=>$tasks]);
    }


    public function viewReassignTask($enc_task_id)
    {
        $module_ids = [20, 25, 29];
        $roles = RoleModule::whereIn('tbl_module_id', $module_ids)->get();

        $users = User::whereIn('tbl_role_id', $roles->pluck('tbl_role_id'))->get();

        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $emps = EmployeeDetail::whereIn('tbl_user_id',$users->pluck('tbl_user_id'))->where('reporting_manger_id',$mng_id)->get();

        foreach($emps as $emp)
        {
            $emp->enc_user_id = EncryptionDecryptionHelper::encdecId($emp->tbl_user_id,'encrypt');
        }

        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_details_id',$dec_task_id)->first();

        return view('frontend_tasks.viewReassignTask',['task'=>$task,'enc_task_id'=>$enc_task_id,'emps'=>$emps]);

    }

    public function reassignTask(Request $request)
    {
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $dec_selected_user_id = EncryptionDecryptionHelper::encdecId($request->selected_user_id,'decrypt');

        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        
        $task = TaskDetail::where('tbl_task_details_id',$dec_task_id)->first();

        $task->selected_user_id = $dec_selected_user_id;
        $task->task_delivery_date = $request->task_delivery_date;
        $task->task_completion_date = $request->task_completion_date;

         

    }



    public function PendingTasks()
    {
        return view('frontend_tasks.pending_tasks');

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
