<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptionDecryptionHelper;

class AuthController extends Controller
{
    
    //load login page
    public function loadLogin()
    {
        //check if user is logged in, redirect to request orelse redirect to login page
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('users.login');
    }

    public function login(Request $request)
    {   
        //check if user exists 
        $user = User::where('email',$request->email)->first();
        
        //get the password from request
        $password =$request->password;
        
       //encrypt the password 
        $encrypted_pass = EncryptionDecryptionHelper::encryptData($password);
      
        //check if user is found
        if(!$user){
            return redirect()->back()->with('error', 'Invalid email or password');
        }
        //if user exists validate password and redirect to respective page
        if (strcmp($user->password, $encrypted_pass) === 0) {

            // $activity_name = "login";
            // $activity_by = $user->tbl_user_id;
        
            // AuditLogHelper::logDetails($activity_name, $activity_by);

            auth()->login($user);
            
            Session::put('user', $user);

            //redirectDash will check if the role of the user and redirect to respective dashboard
            $route = $this->redirectDash();
            
            // $userss = Auth::user();

            // $user12 = session('user');
            // $userid = $user12->tbl_user_id;
            // dd($userid);

        
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
      
        $redirect = '';

        if(Auth::user() && Auth::user()->tbl_role_id == 1)
        {        
            $redirect = '/admin/dashboard';
        }

        else if(Auth::user() && Auth::user()->tbl_role_id ==2){
            
            $redirect = '/hr/dashboard'; 
        }
        else if(Auth::user() && Auth::user()->tbl_role_id == 3){
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
