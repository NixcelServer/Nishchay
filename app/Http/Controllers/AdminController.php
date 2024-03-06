<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\AuditLogDetail;
use App\Models\AdditionalDetail;
use App\Models\EpfEssiDetail;
use App\Models\BankDetail;
use App\Models\KycDetail;
use App\Models\Module;
use App\Models\OfficialDetail;
use App\Models\PreviousEmploymentDetail;
use App\Models\SalaryStructureDetail;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;




class AdminController extends Controller
{
    //when admin logs in show him the dashboard
    public function dashboard()
    {
        return view('frontend_admin.admin_home');
    }
    
    //fetch and show the users from db 
    public function showUsers()
    {
       // $users = User::where('flag','show')->get();
       
    //    $user_details = session('user');
    //    AuditLogHelper::logDetails('users', $user_details->tbl_user_id);

        $users = User::where('flag', 'show')
             ->whereNotIn('tbl_role_id', [1])
             ->get();

        
        //encrypt the id of user and pass to the view
        foreach ($users as $user) {
            // Encode the user's ID using the helper function
            $user->encrypted_id = EncryptionDecryptionHelper::encdecId($user->tbl_user_id, 'encrypt');
        }
        
        $roles = DB::table('mst_tbl_roles')->pluck('role_name', 'tbl_role_id')->toArray();


        // Pass the transformed users to the view
    //return view('frontend_admin.user', compact('users'));
    return view('frontend_admin.user')->with(['users' => $users, 'roles' => $roles]);

           
    }
    
    //display user registration form
    public function createUser(){

        // $user_details = session('user');
        // AuditLogHelper::logDetails('create user', $user_details->tbl_user_id);

        $roles = Role::where('flag', 'show')->get();

        foreach ($roles as $role) {
            // Encode the role ID using the helper function
            $role->encrypted_id = EncryptionDecryptionHelper::encdecId($role->tbl_role_id, 'encrypt');
        }

        return view('frontend_admin.add_new_user_form',compact('roles'));
    }

    //create new user in db and redirect to user home page
    public function storeUser(Request $request){
        
        $user_details = session('user');
        AuditLogHelper::logDetails('create user', $user_details->tbl_user_id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:mst_tbl_users,email',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'tbl_role_id' => 'required'],
            [
                'email.unique' => 'This email address is already in use.',
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ]);
        
        $enc_role_id = $request->tbl_role_id;
        
        $dec_role_id = EncryptionDecryptionHelper::encDecId($enc_role_id,'decrypt');
    
        //get user details from session
        $user_details = session('user');
        //get the details from the request and store into user object
        $user = new User;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tbl_role_id = $dec_role_id;
        $user->add_by = $user_details->tbl_user_id;
        $user->add_date = Date::now()->toDateString();
        $user->add_time = Date::now()->toTimeString();
        $user->flag ="show";
        $user->save();

        //store details into employee also
        $userId = $user->tbl_user_id;
        
        $emp = new EmployeeDetail;
        $emp->tbl_user_id = $userId;
        $emp->first_name = $request->first_name;
        $emp->middle_name = $request->middle_name;
        $emp->last_name = $request->last_name;
        $emp->email = $request->email;
        $emp->tbl_role_id = $dec_role_id;
        $emp->add_by = $user_details->tbl_user_id;
        $emp->add_date = Date::now()->toDateString();
        $emp->add_time = Date::now()->toTimeString();
        $emp->flag ="show";
        $emp->save();
        
        

        $additonal_detail = new AdditionalDetail;
        $additonal_detail->tbl_user_id = $userId;
        $additonal_detail->flag ="show";
        $additonal_detail->save();

       

        $bank_detail = new BankDetail;
        $bank_detail-> tbl_user_id = $userId;
        $bank_detail->flag = "show";
        $bank_detail->save();

        $epf_essi_detail = new EpfEssiDetail;
        $epf_essi_detail->tbl_user_id = $userId;
        $epf_essi_detail->flag = "show";
        $epf_essi_detail->save();

        $kyc_detail = new KycDetail;
        $kyc_detail->tbl_user_id = $userId;
        $kyc_detail->flag = "show";
        $kyc_detail->save();


        $module = new Module;
        $module->tbl_user_id = $userId;
        $module->flag = "show";

        $official_detail = new OfficialDetail;
        $official_detail->tbl_user_id = $userId;
        $official_detail->save();

        $prev_emp_detail = new PreviousEmploymentDetail;
        $prev_emp_detail->tbl_user_id = $userId;
        $prev_emp_detail->save();

        $sal = new SalaryStructureDetail;
        $sal->tbl_user_id = $userId;
        $sal->save();

        

        //audit log entry

        return redirect("/admin/users");
    }

    //edit user form
    public function editUserForm($enc_id)
    {
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        
        $user = User::find($dec_id);
    

        $roleName = Role::where('tbl_role_id',$user->tbl_role_id)->value('role_name');;
        

        $roles = Role::where('flag', 'show')->get();

        foreach ($roles as $role) {
            // Encode the role ID using the helper function
            $role->encrypted_id = EncryptionDecryptionHelper::encdecId($role->tbl_role_id, 'encrypt');
        }
        
        return view('frontend_admin.edituser',['user'=>$user,'enc_id' => $enc_id,'roles' => $roles,'roleName' => $roleName]);
        
    }

    //edit user details in db
    public function editUser(Request $request)
    {
       
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'tbl_role_id' => 'required'],
            [
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            
            ]);

            
            $user_details = session('user');
        AuditLogHelper::logDetails('edit user', $user_details->tbl_user_id);
        
        $userdetails = session('user');
        
        $enc_id = $request->input('enc_id');
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);
        

       

        $user = User::findOrFail($dec_id);
        

        //decrypt the role id
        $enc_role_id = $request->tbl_role_id;
        $dec_role_id = EncryptionDecryptionHelper::encdecId($enc_role_id,'decrypt');

        
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tbl_role_id = $dec_role_id;

        $user->update_by = $userdetails->tbl_user_id;
        $user->update_date = Date::now()->toDateString();
        $user->update_time = Date::now()->toTimeString();
        $user->save();
        

        //saving the details in employee tables also
        $emp = EmployeeDetail::where('tbl_user_id',$dec_id)->first();
        
        $emp->first_name = $request->first_name;
        $emp->middle_name = $request->middle_name;
        $emp->last_name = $request->last_name;
        
        $emp->tbl_role_id = $dec_role_id;
        $emp->save();


        
        //dd("success");
        return redirect('/admin/users');


    }

    //delete user
     //delete user
     public function deleteUser($enc_id)
     {
        $user_details = session('user');
        AuditLogHelper::logDetails('delete user', $user_details->tbl_user_id);

         $action = 'decrypt';
         $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
         
         $user = User::find($dec_id);
         $user->flag = "deleted";
         $user->save();
 
         $emp = EmployeeDetail::find($dec_id);
         $emp->flag = "deleted";
         $emp->save();
 
         $additional_detail = AdditionalDetail::find($dec_id);
         $additional_detail->flag = "deleted";
         $additional_detail->save();
 
         $epf_essi_detail = EpfEssiDetail::find($dec_id);
         $epf_essi_detail->flag = "deleted";
         $epf_essi_detail->save();
 
         $bank_detail = BankDetail::find($dec_id);
         $bank_detail->flag = "deleted";
         $bank_detail->save();

         $kyc_detail = KycDetail::find($dec_id);
         $kyc_detail->flag = "deleted";
         $kyc_detail->save();
 
         $official_detail = OfficialDetail::find($dec_id);
         $official_detail->flag = "deleted";
         $official_detail->save();
 
         $prev_emp_detail = PreviousEmploymentDetail::find($dec_id);
         $prev_emp_detail->flag = "deleted";
         $prev_emp_detail->save();
 
         $sal = SalaryStructureDetail::find($dec_id);
         $sal->flag = "deleted";
         $sal->save();
 
 
        return redirect('/admin/users');
     } 

   
     public function showmodules()
     {
         return view('frontend_admin.assign_module');
     }
 


    
}
