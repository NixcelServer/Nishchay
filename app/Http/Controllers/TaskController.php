<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\OfficialDetail;
use App\Models\TaskDetail;
use App\Models\Role;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use App\Models\AuditLogDetail;
use App\Models\Module;
use App\Models\TaskActionDetail;
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
            $createNewTask = false;
            $deleteTask = false;

            foreach ($moduleData as $data) {
                if ($data['module']->module_name === 'My Tasks') {
                    $myTasksExist = true;
                }
                if ($data['module']->module_name === 'Show Tasks') {
                    $showTasksExist = true;
                }

                if($data['module']->module_name === 'Create New Task'){
                    $createNewTask = true;
                }

                if($data['module']->module_name === 'Delete Task'){
                    $deleteTask = true;
                }

                // If both modules are found, exit the loop early
                if ($myTasksExist && $showTasksExist && $createNewTask && $deleteTask) {
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
                    $role = "Manager";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'role'=>$role,'createNewTask'=>$createNewTask,'deleteTask'=>$deleteTask]);
             
            } else {
                // Neither module exists
                 // Do something else...
                 return redirect('/dashboard');
            }
     
     }

    public function viewTask($enc_task_id)
    {
        $moduleData = session('moduleData');
        $reassignTask = false;
        $deleteTask = false;

        foreach ($moduleData as $data) {
            if ($data['module']->module_name === 'Reassign Task') {
                $reassignTask = true;
            }
            if ($data['module']->module_name === 'Delete Task') {
                $deleteTask = true;
            }
        }    
        


        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        
        
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        
        
        $assignedUser = User::find($task->selected_user_id);
        if ($assignedUser) {
            $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
        }
        
         $action_details = TaskActionDetail::where('tbl_task_detail_id',$dec_task_id)->get();
         foreach($action_details as $action_detail){
            $assignedUser = User::find($action_detail->action_by);
            if($assignedUser){
                $action_detail->user_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
            }
         
        }
        return view('frontend_tasks.view_task_page',['task'=>$task,'enc_task_id'=>$enc_task_id,'action_details'=>$action_details,'reassignTask'=>$reassignTask,'deleteTask'=>$deleteTask]);
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

        //store details into tbl_task_action_detials
        $userdetails = session('user');
         $user_id = $userdetails->tbl_user_id;

        $action_details = new TaskActionDetail;
        $action_details->tbl_task_detail_id = $dec_task_id;
        $action_details->action_name = $request->action;
        $action_details->action_by = $user_id;
        $action_details->action_date = Date::now()->toDateString();
        $action_details->action_time = Date::now()->toTimeString();
        $action_details->save();
        $task->save();

        //auditlog entry
        $user_details = session('user');
        AuditLogHelper::logDetails('update task status', $user_details->tbl_user_id);

        return redirect('/Tasks');
    }
     
    public function transferMyTaskForm($enc_task_id)
    {
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        return view('frontend_tasks.reassign_tasks',['task'=>$task,'enc_task_id'=>$enc_task_id]);
    }
     
    public function transferMyTask(Request $request)
    {
        
        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        $task->remark = $request->remark;
        $task->transferred_status = 'Pending';
        
        $task->save();

        $user_details = session('user');
        AuditLogHelper::logDetails('reassign task', $user_details->tbl_user_id);

        return redirect('/Tasks');
    }
 
    

    public function showInProgressTasks()
    {
        
         $userdetails = session('user');
         $user_id = $userdetails->tbl_user_id;

         $moduleData = session('moduleData');
            $myTasksExist = false;
            $showTasksExist = false;
            $createNewTask = false;

            foreach ($moduleData as $data) {
                if ($data['module']->module_name === 'My Tasks') {
                    $myTasksExist = true;
                }
                if ($data['module']->module_name === 'Show Tasks') {
                    $showTasksExist = true;
                }

            

                if($data['module']->module_name === 'Create New Task'){
                    $createNewTask = true;
                }
                // If both modules are found, exit the loop early
                if ($myTasksExist && $showTasksExist && $createNewTask) {
                    break;
                }
            }

            if ($myTasksExist && $showTasksExist) {
                // Both modules exist
                // Do something...
            } elseif ($myTasksExist) {
                //$tasks = TaskDetail::where('selected_user_id', $user_id)->where('flag', 'show')->where('task_status','In Progress')->where('transferred_status', '!=', 'Pending')->get();
                $tasks = TaskDetail::where('selected_user_id', $user_id)
                                    ->where('flag', 'show')
                                    ->where('task_status', 'In Progress')
                                    ->where(function ($query) {
                                        $query->where('transferred_status', '!=', 'Pending')
                                            ->orWhereNull('transferred_status');
                                    })
                                    ->get();

                
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
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title,'createNewTask'=>$createNewTask]);
                        
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
                    $role = "Manager";
                return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title,'role'=>$role,'createNewTask'=>$createNewTask]);
             
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
           $createNewTask = false;

           foreach ($moduleData as $data) {
               if ($data['module']->module_name === 'My Tasks') {
                   $myTasksExist = true;
               }
               if ($data['module']->module_name === 'Show Tasks') {
                   $showTasksExist = true;
               }

               if($data['module']->module_name === 'Create New Task'){
                $createNewTask = true;
                }
                // If both modules are found, exit the loop early
                if ($myTasksExist && $showTasksExist && $createNewTask) {
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
               return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title,'createNewTask'=>$createNewTask]);
                       
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
                   $role = "Manager";
               return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'title'=>$title,'role'=>$role,'createNewTask'=>$createNewTask]);
            
           } else {
               // Neither module exists
                // Do something else...
                return redirect('/dashboard');
           }

    }






    //mng show task
    

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
        $user_details = session('user');
        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        if($task->task_status == 'Completed' || $task->task_status == 'In Progress'){
            return redirect()->back()->withError('task cannot be deleted');
        }
        else{
            $task->flag = 'deleted';
            $task->update_by = $user_details->tbl_user_id;
            $task->update_date = Date::now()->toDateString();
            $task->update_time = Date::now()->toTimeString();
            
            $task->save();
        }


        $user_details = session('user');
        AuditLogHelper::logDetails('delete task', $user_details->tbl_user_id);

        return redirect('/Tasks');

    }
    //show create task form
    public function createTask()
    {
        
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

      
        $emps = OfficialDetail::where('reporting_manager_id',$mng_id)->get();

        $empsWithModulesAndNames = [];

        foreach ($emps as $emp) {
            // Retrieve the user associated with the employee
            $user = User::find($emp->tbl_user_id);
        
            if ($user) {
                $enc_user_id = EncryptionDecryptionHelper::encdecId($user->tbl_user_id, 'encrypt');
                // Retrieve the role ID directly from the user object
                $roleId = $user->tbl_role_id;
        
                // Check if either of the module IDs exists for the role
                $roleModules = RoleModule::where('tbl_role_id', $roleId)
                    ->whereIn('tbl_module_id', [20, 25])
                    ->pluck('tbl_module_id')
                    ->toArray();
        
                // If either module ID exists for the role, include the employee and user's name in the result
                if (!empty($roleModules)) {
                    $empsWithModulesAndNames[] = [
                        'employee' => $emp,
                        'user_name' => $user->first_name . ' ' . $user->last_name,
                        'enc_user_id' => $enc_user_id,
                    ];
                }
            }
        }

        $user_details = session('user');
        AuditLogHelper::logDetails('create new task', $user_details->tbl_user_id);

        return view('frontend_tasks.create_task',['empsWithModulesAndNames'=>$empsWithModulesAndNames]);

    }

    //assign task to the emp
     public function assignTask(Request $request)
     {
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $dec_selected_user_id = EncryptionDecryptionHelper::encdecId($request->assigned_to,'decrypt');


        $task = new TaskDetail;
        $task->task_description = $request->task_description;
        $task->selected_user_id = $dec_selected_user_id;
        $task->task_delivery_date = $request->expected_delivery_date;
        $task->add_by = $mng_id;
        $task->task_status ="Pending";
        $task->add_date = Date::now()->toDateString();
        $task->add_time = Date::now()->toTimeString();
        $task->flag = 'show';
        
        $task->save();

        $user_details = session('user');
        AuditLogHelper::logDetails('assign task', $user_details->tbl_user_id);
        
        return redirect('/Tasks');
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
            $task->enc_task_id = EncryptionDecryptionHelper::encdecId($task->tbl_task_detail_id, 'encrypt');

            $assignedUser = User::find($task->selected_user_id);
                   if ($assignedUser) {
                       $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
                   }
        }
        
        $role = "Manager";
        $columnName = "Task Assigned To";
        $reassign = "apply";
        $view = "reassign";
    
        return view('frontend_tasks.showTasks',['tasks'=>$tasks,'columnName'=>$columnName,'role'=>$role,'reassign'=>$reassign]);
    }


    public function viewReassignTask($enc_task_id)
    {
        //  $module_ids = [20, 25];
        //  $roles = RoleModule::whereIn('tbl_module_id', $module_ids)->get();

         
        //  $users = User::whereIn('tbl_role_id', $roles->pluck('tbl_role_id'))->get();
        //  dd($users);

        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

      
        $emps = OfficialDetail::where('reporting_manager_id',$mng_id)->get();

        $empsWithModulesAndNames = [];

        foreach ($emps as $emp) {
            // Retrieve the user associated with the employee
            $user = User::find($emp->tbl_user_id);
        
            if ($user) {
                $enc_user_id = EncryptionDecryptionHelper::encdecId($user->tbl_user_id, 'encrypt');
                // Retrieve the role ID directly from the user object
                $roleId = $user->tbl_role_id;
        
                // Check if either of the module IDs exists for the role
                $roleModules = RoleModule::where('tbl_role_id', $roleId)
                    ->whereIn('tbl_module_id', [20, 25])
                    ->pluck('tbl_module_id')
                    ->toArray();
        
                // If either module ID exists for the role, include the employee and user's name in the result
                if (!empty($roleModules)) {
                    $empsWithModulesAndNames[] = [
                        'employee' => $emp,
                        'user_name' => $user->first_name . ' ' . $user->last_name,
                        'enc_user_id' => $enc_user_id,
                    ];
                }
            }
        }
        
       // dd($empsWithModulesAndNames);
        // Pass $empsWithModulesAndNames to the view or perform further actions
        
        //get data of users and check the role of users
        


        

        $dec_task_id = EncryptionDecryptionHelper::encdecId($enc_task_id,'decrypt');
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();
        $assignedUser = User::find($task->selected_user_id);
        if ($assignedUser) {
            $task->assigned_name = $assignedUser->first_name . ' ' . $assignedUser->last_name;
        }

        return view('frontend_tasks.view_reassign_task',['task'=>$task,'enc_task_id'=>$enc_task_id,'empsWithModulesAndNames'=>$empsWithModulesAndNames]);

    }

    public function reassignTask(Request $request)
    {
        
        $user_details = session('user');
        $mng_id = $user_details->tbl_user_id;

        $dec_selected_user_id = EncryptionDecryptionHelper::encdecId($request->assigned_to,'decrypt');

        $dec_task_id = EncryptionDecryptionHelper::encdecId($request->input('enc_task_id'),'decrypt');
        
        $task = TaskDetail::where('tbl_task_detail_id',$dec_task_id)->first();

        $task->selected_user_id = $dec_selected_user_id;
        $task->task_delivery_date = $request->expected_delivery_date;
        $task->add_date = Date::now()->toDateString();
        $task->add_time = Date::now()->toTimeString();
        $task->transferred_status = "success";
        $task->remark=null;

        
        $task->save();

        $user_details = session('user');
        AuditLogHelper::logDetails('reassign task', $user_details->tbl_user_id);

        return redirect('/Tasks/showreassignedtask');

    }

   
}