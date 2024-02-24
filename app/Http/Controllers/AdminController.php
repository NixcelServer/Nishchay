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
        dd("admin Dashboard");
    }
}
