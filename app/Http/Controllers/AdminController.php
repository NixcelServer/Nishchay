<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\AuditLogDetail;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use App\Models\Department;



class AdminController extends Controller
{
    //display login form 
    public function showLoginForm(){
        return view('users.login');
    }

    //verify user
    public function login(Request $request){
        //get the user data from the email
        $user = User::where('email',$request->email)->first();

        $role_id=$user->tbl_role_id;
        //get info about role from db and get rolename
        $role = Role::where('tbl_role_id', $user->tbl_role_id)->first();
        $roleName = $role->role_name;
        
       

        //get the password from request
        $password =$request->password;
        
       //encrypt the password 
        $encrypted_pass = EncryptionDecryptionHelper::encryptData($password);
      
        //check if user is found
        if(!$user){
            return redirect()->back()->with('error', 'Invalid email or password');
        }

        $activity_name = "login";
        $activity_by = $user->tbl_user_id;
        
        AuditLogHelper::logDetails($activity_name, $activity_by);

        // $log_details = new AuditLogDetail;
        // $log_details->activity_name = "login";
        // $log_

        //check passwords
        if (strcmp($user->password, $encrypted_pass) === 0) {
            // if passwords are same redirect to respective role



            //register user login details in auditlog table

            
            if($role_id==1){
                dd("admin");
            }
            else {
                dd("user");
            }
        } else {
            // if passwords are not same display following msg
             return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    //display user registration form
    public function showCreateUserForm(){
        return view('users.createuserform');
    }

    //create new user in db and redirect to user home page
    public function createUser(Request $request){
        dd("hi");
        $password = $request->password;
        $encrypted_pass = EncryptionDecryptionHelper::encryptData($password);
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $encrypted_pass;
        $user->tbl_role_id = $request->tbl_role_id;
        $user->add_by = 2;
        $user->add_date = Date::now()->toDateString();
        $user->add_time = Date::now()->toTimeString();
        $user->save();


        //return redirect
    }

    public function dashBoard()
    {
        return view('frontend_admin.admin_home');
    }

    public function index()
    {
       return view('frontend_admin.admin_home');
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
        
        return view('frontend_admin.user',['users'=>$users]);
           
    }

    public function add_new_user_form()
    {
       return view('frontend_admin.add_new_user_form');
    }


    //create new user in db and redirect to user home page
    public function storeUser(Request $request){
        
        $user_details = session('user');
        
        $password = $request->password;
        
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tbl_role_id = $request->tbl_role_id;
        $user->add_by = $user_details->tbl_user_id;
        $user->add_date = Date::now()->toDateString();
        $user->add_time = Date::now()->toTimeString();
        $user->flag ="show";
        $user->save();

        //audit log entry

        return redirect("/admin/users");
    }

    //fetch dept from db and show them in table format
    public function showDept()
    {
        $depts = Department::get();
        // dd("in show dept");
        return view('frontend_admin.department',['depts'=>$depts]);
    }

    public function showDesignation()
    {
        // $depts = Department::get();
        // dd("in show dept");
        return view('frontend_admin.designation');
    }

    public function showRole()
    {
        // $depts = Department::get();
        // dd("in show dept");
        return view('frontend_admin.role');
    }
}
