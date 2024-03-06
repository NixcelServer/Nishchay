<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use App\Models\RoleModule;
use App\Models\Module;
use Illuminate\Http\Response;
 
class AuthController extends Controller
{
    //load login page
    public function loadLogin()
    {
        //check if user is logged in, redirect to request orelse redirect to login page
        if(Auth::user()){
           
            return redirect('/dashboard');
        }
        return view('frontend_home.home');
    }
 
    public function login(Request $request)

    {   
        //check if user exists 
        
        $user = User::where('email',$request->email)->first();
        $role_id = $user->tbl_role_id;
        $roleModules = RoleModule::where('tbl_role_id',$role_id)->get();

        $moduleData = [];
        foreach($roleModules as $roleModule){
            
            $module = Module::find($roleModule->tbl_module_id);
            
            if ($module) {
                
                $moduleData[] = [
                    'module' => $module,
                ];
            }
        }
        Session::put('moduleData',$moduleData);
        

        $uniqueParentNames = [];

        // Iterate over $moduleData to extract unique parent names
            foreach ($moduleData as $data) {
                $parentName = $data['module']->parent;

                // Check if the parent name already exists
                if ($parentName !== null && $parentName !== "" && !in_array($parentName, $uniqueParentNames)) {
                    // Add the parent name to the unique parent names array
                    $uniqueParentNames[] = $parentName;
                }
                
            }

            // // Iterate over $moduleData to extract unique parent names
            // foreach ($moduleData as $data) {
            //     $parentName = $data['module']->parent;
                
            //     // Check if the parent name is not empty and has not been processed yet
            //     if ($parentName !== null && $parentName !== "" && !in_array($parentName, array_column($uniqueParentNames, 'parent_name'))) {
            //         // Fetch the parent modules if they exist
            //         $parentModules = Module::where('parent', $parentName)->get();
                    
            //         // Loop through each parent module
            //         foreach ($parentModules as $parentModule) {
            //             // Add the parent name and module name to the unique parent names array
            //             $uniqueParentNames[] = [
            //                 'parent_name' => $parentModule->parent,
            //                 'module_name' => $parentModule->module_name,
            //             ];
            //         }
            //     }
            // }
            
            //dd($uniqueParentNames);
            Session::put('uniqueParentNames',$uniqueParentNames);
            


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

             $activity_name = "login";
             $activity_by = $user->tbl_user_id;
        
             AuditLogHelper::logDetails($activity_name, $activity_by);

            auth()->login($user);
            
            Session::put('user', $user);

            return redirect('/dashboard');
 
        } else {
            // if passwords are not same display following msg
            return redirect()->back()->withInput()->with('error', 'Invalid email or password.Please enter valid credentials.');

        }
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
        $user_details = session('user');
        AuditLogHelper::logDetails('logout', $user_details->tbl_user_id);
        $request->session()->flush();
        
        Auth::logout();

        return redirect('/');
    }
    
    public function dashboard()
    {
        return view('frontend_home.dashboard');
    }

    

}

