<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\AuditLogDetail;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;



class AdminController extends Controller
{
    //when admin logs in show him the dashboard
    public function dashboard()
    {
        //dd("admin Dashboard");
    }
    
    //fetch and show the users from db 
    public function showUsers()
    {
        $users = User::get();
        //dd("in show users");
        $users->transform(function ($user)
        {
            $action = 'encrypt';
            $user->encrypted_id = EncryptionDecryptionHelper::encdecId($user->id, $action);
            return $user;
        });
   
        return view('user.users',['user'=>'$users']);
           
    }
    
    //display user registration form
    public function createUser(){
        return view('users.createuserform');
    }

    //create new user in db and redirect to user home page
    public function storeUser(Request $request){
        
        $password = $request->password;
        $encrypted_pass = EncryptionDecryptionHelper::encryptData($password);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $encrypted_pass;
        $user->tbl_role_id = $request->tbl_role_id;
        $user->add_by = $request->tbl_user_id;
        $user->add_date = Date::now()->toDateString();
        $user->add_time = Date::now()->toTimeString();
        $user->flag ="show";
        $user->save();

        //audit log entry

        return redirect("/admin/users");
    }

    //edit user form
    public function editUserForm($enc_id)
    {
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $user = User::find($dec_id);

        return view('users.edit',['user'=>'$user']);
    }

    //edit user details in db
    public function editUser(Request $request)
    {
        $user = session('user');

        $tbl_user_id = $request->tbl_user_id;

        $user = User::findOrFail($tbl_user_id);

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tbl_role_id = $request->tbl_role_id;
        $user->update_by = $user->tbl_user_id;
        $user->update_date = Date::now()->toDateString();
        $user->update_time = Date::now()->toTimeString();

        return redirect('/admin/users');

    }

    //delete user
    public function deleteUser(Request $request)
    {
       // $request
       return redirect('/admin/users');
    }

    //fetch dept from db and show them in table format
    public function showDept()
    {
        $depts = Department::get();
        dd("in show dept");
        return view('dept.depts',['dept'=>'$depts']);
    }
    //create new dept form
    public function createDept()
    {
        return view('dept.createDept');
    }

    //create new dept in db
    public function storeDept(Request $request)
    {   
        $user = session('user');
        $user_id = $user->tbl_user_id;
        $dept = new Department;
        $dept->department_name = $request->department_name;
        $dept->add_by = $user_id;
        $dept->add_date = Date::now()->toDateString();
        $dept->add_time = Date::now()->toTimeeString();
        $dept->flag = "show";
        
        return redirect('/admin/depts');
    }

    public function editDeptForm($enc_id)
    {
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $dept = Department::find($dec_id);

        return view('dept.edit',['dept'=>'$dept']);
    }

    // public function editDept(Request $request)
    // {

    // }

 


    
}
