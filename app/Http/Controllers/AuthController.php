<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptionDecryptionHelper;

class AuthController extends Controller
{
    //check if user is logged in and in redirectdash set the route based on role id
    public function loadRegister(){
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('register');
    }

    public function loadLogin()
    {
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('users.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        $role_id=$user->tbl_role_id;
        //get info about role from db and get rolename
        // $role = Role::where('tbl_role_id', $user->tbl_role_id)->first();
        // $roleName = $role->role_name;
        
       

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
        
       // AuditLogHelper::logDetails($activity_name, $activity_by);

        if (strcmp($user->password, $encrypted_pass) === 0) {
            
            $route = $this->redirectDash();
            
            return redirect($route);
        } else {
            // if passwords are not same display following msg
             return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function loadDashboard()
    {
        return view('user.dashboard');
    }

    public function redirectDash()
    {
        if (Auth::check()) {
            // User is authenticated
            dd("user authenticated");
            $user = Auth::user();
        }
        $user = Auth::user();
        dd($user);
        $role_id = Auth::user()->tbl_role_id;
        dd($role_id);
        $redirect = '';

        if(Auth::user() && Auth::user()->tbl_role_id == 1){
            dd("Admin");
            $redirect = '/admin/dashboard';
        }

        else if(Auth::user() && Auth::user()->role ==2){
            dd("HR");
            $redirect = ''; 
        }
        else if(Auth::user() && Auth::user()->role == 3){
            dd("Developer");
        }
        else{
            $redirect ='/';
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
