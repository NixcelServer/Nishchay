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
        //dd("admin Dashboard");
    }
    
    //fetch and show the users from db 
    public function showUsers()
    {
       // $users = User::where('flag','show')->get();

        $users = User::where('flag', 'show')
             ->whereNotIn('tbl_role_id', [1])
             ->get();

        
        //encrypt the id of user and pass to the view
        foreach ($users as $user) {
            // Encode the user's ID using the helper function
            $user->encrypted_id = EncryptionDecryptionHelper::encdecId($user->tbl_user_id, 'encrypt');
        }
        

        // Pass the transformed users to the view
    return view('users.users', compact('users'));
           
    }
    
    //display user registration form
    public function createUser(){
        return view('users.createuserform');
    }

    //create new user in db and redirect to user home page
    public function storeUser(Request $request){

        
        
        //get user details from session
        $user_details = session('user');
        //get the details from the request and store into user object
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

        //store details into employee also
        $userId = $user->tbl_user_id;
        
        // $emp = new EmployeeDetail;
        // $emp->tbl_user_id = $userId;
        // $emp->first_name = $request->first_name;
        // $emp->middle_name = $request->middle_name;
        // $emp->last_name = $request->last_name;
        // $emp->tbl_role_id = $request->tbl_role_id;
        // $emp->add_by = $user_details->tbl_user_id;
        // $emp->add_date = Date::now()->toDateString();
        // $emp->add_time = Date::now()->toTimeString();
        // $emp->flag ="show";
        // $emp->save();
        
        

        // $additonal_detail = new AdditionalDetail;
        // $additonal_detail->tbl_user_id = $userId;
        // $additonal_detail->flag ="show";
        // $additonal_detail->save();

       

        // $bank_detail = new BankDetail;
        // $bank_detail-> tbl_user_id = $userId;
        // $bank_detail->flag = "show";
        // $bank_detail->save();

        // $epf_essi_detail = new EpfEssiDetail;
        // $epf_essi_detail->tbl_user_id = $userId;
        // $epf_essi_detail->flag = "show";
        // $epf_essi_detail->save();

        // $kyc_detail = new KycDetail;
        // $kyc_detail->tbl_user_id = $userId;
        // $kyc_detail->flag = "show";
        // $kyc_detail->save();


        // $module = new Module;
        // $module->tbl_user_id = $userId;
        // $module->flag = "show";

        // $official_detail = new OfficialDetail;
        // $official_detail->tbl_user_id = $userId;
        // $official_detail->save();

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
        
        return view('users.edit',['user'=>'$user','enc_id' => $enc_id]);
    }

    //edit user details in db
    public function editUser(Request $request)
    {
        $userdetails = session('user');
        
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);
        

        // $og_pass = $request->password;
        
        // $encrypted_pass = EncryptionDecryptionHelper::encryptData($og_pass);
        
        // dd($encrypted_pass);

        $user = User::findOrFail($dec_id);
        
        
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tbl_role_id = $request->tbl_role_id;
        $user->add_by = $user->add_by;
        $user->add_date = $user->add_date;
        $user->add_time = $user->add_time;
        $user->update_by = $userdetails->tbl_user_id;
        $user->update_date = Date::now()->toDateString();
        $user->update_time = Date::now()->toTimeString();
        
        $user->save();
        dd("success");
        return redirect('/admin/users');

    }

    //delete user
    public function deleteUser($enc_id)
    {
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
        $additonal_detail->save();

        $epf_essi_detail = EpfEssiDetail::find($dec_id);

        $bank_detail = EpfEssiDetail::find($dec_id);

        $kyc_detail = KycDetail::find($dec_id);

        $official_detail = OfficialDetail::find($dec_id);

        $prev_emp_detail = PreviousEmploymentDetail::find($dec_id);

        $sal = SalaryStructureDetail::find($dec_id);


       return redirect('/admin/users');
    } 

   

 


    
}
