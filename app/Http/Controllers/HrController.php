<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use App\Helpers\EncryptionDecryptionHelper;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use App\Models\PreviousEmploymentDetail;
use App\Models\OfficialDetail;
use App\Models\EpfEssiDetail;
use App\Models\AdditionalDetail;
use App\Models\BankDetail;
use App\Models\SalaryStructureDetail;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\KycDetail;
use App\Models\Module;
use App\Models\RoleModule;
use Illuminate\Validation\Rule;
//use App\Models\AuditLogHelper;
use App\Helpers\AuditLogHelper;






class HrController extends Controller
{
    //When HR logs in show HR Dashboard
    public function dashboard()
    {
        return view('frontend_hr.hr_home');
    }

    public function showEmployees()
    {
       // $emps=EmployeeDetail::all();
        //dd($emps);
        $emps = EmployeeDetail::where('flag', 'show')
                      ->where('tbl_role_id', '<>', 1)
                      ->get();
 
        
        
                      foreach ($emps as $emp) {
                        // Encode the user's ID using the helper function
                        $emp->encrypted_id = EncryptionDecryptionHelper::encdecId($emp->tbl_user_id, 'encrypt');
                        $desg_id = $emp->tbl_designation_id;
                        $designation = Designation::where('tbl_designation_id',$desg_id)->first();
                        if ($designation) {
                            $emp->desg_name = $designation->designation_name;
                        } else {
                            $emp->desg_name = 'Unknown'; // or any default value you prefer
                        }
                        
                        $dept_id = $emp->tbl_dept_id;
                        $department = Department::where('tbl_dept_id',$dept_id)->first();
                        if ($department) {
                            $emp->dept_name = $department->dept_name;
                        } else {
                            $emp->dept_name = 'Unknown'; // or any default value you prefer
                        }
            
                        $role_id = $emp->tbl_role_id;
                        $role = Role::where('tbl_role_id',$role_id)->first();
                        if ($role) {
                            $emp->role_name = $role->role_name;
                        } else {
                            $emp->role_name = 'Unknown'; // or any default value you prefer
                        }
            
                    }

    
        return view('frontend_hr.new_employee_registration', compact('emps'));
    }
                
    public function editEmpForm($enc_id)
    {
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        
        $user = User::find($dec_id);
        

        $emp = EmployeeDetail::where('tbl_user_id', $dec_id)->first();

        $depts = Department::where('flag','show')->get();
        foreach ($depts as $dept) {
            // Encode the user's ID using the helper function
            $dept->enc_dept_id = EncryptionDecryptionHelper::encdecId($dept->tbl_dept_id, 'encrypt');
        }

        $designations = Designation::where('flag','show')->get();
        foreach($designations as $designation){
            $designation->desg_enc_id = EncryptionDecryptionHelper::encdecId($designation->tbl_designation_id, 'encrypt');
        }
       

        $roles = Role::where('flag','show')->get();
        foreach($roles as $role){
            $role->enc_role_id = EncryptionDecryptionHelper::encdecId($role->tbl_role_id, 'encrypt');
        }


        //passing data of previous employment details
        $prev_details = PreviousEmploymentDetail::where('tbl_user_id',$dec_id)->get();
        foreach($prev_details as $prev_detail)
        {
            $prev_detail->enc_prev_detail_id = EncryptionDecryptionHelper::encdecId($prev_detail->tbl_prev_emp_detail_id,'encrypt');
        }

        //passing manager data to display in drop down
        $managers = [];
        $modules = Module::where('module_name', 'Create New Task')->first();
        
        if ($modules) {
            $roleModules = RoleModule::where('tbl_module_id', $modules->tbl_module_id)->pluck('tbl_role_id');
        
            foreach ($roleModules as $roleModule) {
                $user_details = User::where('tbl_role_id', $roleModule)->get();
        
                foreach ($user_details as $user_detail) {
                    $user_enc_id = EncryptionDecryptionHelper::encdecId($user_detail->tbl_user_id, 'encrypt');
                    $user_name = $user_detail->first_name . " " . $user_detail->last_name;
                    $user_id = $user_detail->tbl_user_id;
        
                    $managers[] = [
                        'reporting_manager_id' => $user_id,
                        'user_enc_id' => $user_enc_id,
                        'user_name' => $user_name,
                    ];
                }
            }
        }

        $mng_id = officialDetail::where('tbl_user_id',$dec_id)->value('reporting_manager_id');
        $userinfo = User::where('tbl_user_id',$mng_id)->first();

        $mng_name = '';
        if($userinfo){
        $mng_name = $userinfo->first_name . " " . $userinfo->last_name;
        }
        
        $ofc_details = OfficialDetail::where('tbl_user_id',$dec_id)->first();
        $stat_details = EpfEssiDetail::where('tbl_user_id',$dec_id)->first();
        $kyc_details = KycDetail::where('tbl_user_id',$dec_id)->first();
        $bank_details = BankDetail::where('tbl_user_id',$dec_id)->first();
        $sal_details = SalaryStructureDetail::where('tbl_user_id',$dec_id)->first();
         
        dd($emp);
        return view('frontend_hr.editemp',['emp'=>$emp,'user'=>$user,'enc_id'=>$enc_id,'depts'=>$depts,'designations'=>$designations,'roles'=> $roles,'prev_details'=>$prev_details,'managers'=>$managers,'ofc_details'=>$ofc_details,'stat_details'=>$stat_details,'kyc_details'=>$kyc_details,'bank_details'=>$bank_details,'sal_details'=>$sal_details,'mng_name'=>$mng_name]);
    
    
        
    }

 

    public function storeDetails(Request $request)
    {   

        $enc_id = $request->input('enc_id');
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        
        $rules = [
            'empcode' => ['required','string',Rule::unique('tbl_emp_details','emp_code')->ignore($dec_id,'tbl_user_id')],
            'contact_no' => 'required|numeric|digits:10',
            'gender' => 'required|string',
            'age' => 'required|numeric',
            'pincode' => 'required|digits:6',
            'uan_no' => ['required','string',Rule::unique('tbl_epf_essi_details','uan')->ignore($dec_id,'tbl_user_id')],
            'old_epf_no' => ['required','string',Rule::unique('tbl_epf_essi_details','old_epf_no')->ignore($dec_id,'tbl_user_id')],
            'nixcel_epf_no' => ['required','string',Rule::unique('tbl_epf_essi_details','nixcel_epf_no')->ignore($dec_id,'tbl_user_id')],
            'nixcel_essi_no' => ['required','string',Rule::unique('tbl_epf_essi_details','nixcel_essi_no')->ignore($dec_id,'tbl_user_id')],
            'nominee_name' => 'required|string',
            'relation_with_nominee' => 'required|string',
            'aadharno' => ['required','numeric','digits:12',Rule::unique('tbl_kyc_details','aadharcard_no')->ignore($dec_id,'tbl_user_id')],
            'pancardno' => ['required','string','size:10',Rule::unique('tbl_kyc_details','pancard_no')->ignore($dec_id,'tbl_user_id')],
            'accountno' => ['required','numeric','digits:12',Rule::unique('tbl_bank_details','account_no')->ignore($dec_id,'tbl_user_id')],
            'actual_gross' => 'required|numeric',
            'basic' => 'required|numeric',
            'hra' => 'required|numeric',
            'medical' => 'required|numeric',
            'special_allowance' => 'required|numeric',
            'statutory_bonus' => 'required|numeric',
            'payable_gross' => 'required|numeric',
            'pf' => 'required|numeric',
            'tds' => 'required|numeric',
            'pt' => 'required|numeric',
            'net_salary' => 'required|numeric',
            'ctc' => 'required|numeric'
        ];
        
        $validatedData = $request->validate($rules);
        
    
        
         //get session details
         $userdetails = session('user');
        
         $enc_id = $request->input('enc_id');
        
         $action = 'decrypt';
         $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

         
         $dec_role_id = EncryptionDecryptionHelper::encdecId($request->role,'decrypt');
         $dec_dept_id = EncryptionDecryptionHelper::encdecId($request->department,'decrypt');
         $dec_desg_id = EncryptionDecryptionHelper::encdecId($request->designation,'decrypt');

         $user = User::where('tbl_user_id',$dec_id)->first();
         $user->tbl_role_id = $dec_role_id;
         $user->save();

         
         //store details into emp table
         $emp = EmployeeDetail::where('tbl_user_id',$dec_id)->first();

         


         

         $emp->emp_code = $request->empcode;
         $emp->title = $request->title;
         $emp->offer_letter_no = $request->offer_letter_no;
         $emp->contact_no = $request->contact_no;
         $emp->gender = $request->gender;
         $emp->birth_date = $request->dob;
         $emp->current_age = $request->age;
         $emp->country = $request->country;
         $emp->state = $request->state;
         $emp->city = $request->city;
         $emp->pincode = $request->pincode;
         $emp->permanent_address = $request->address;
         $emp->tbl_dept_id = $dec_dept_id;
         $emp->tbl_designation_id = $dec_desg_id;
         $emp->tbl_role_id = $dec_role_id;
         $emp->tbl_dept_id = $dec_dept_id;
         $emp->tbl_designation_id = $dec_desg_id;
         $emp->tbl_role_id = $dec_role_id;
         $emp->add_by = $userdetails->tbl_user_id;
         $emp->add_date = Date::now()->toDateString();
         $emp->add_time = Date::now()->toTimeString();
         $emp->save();
 
        
        

         $additionalDetails = AdditionalDetail::where('tbl_user_id',$dec_id)->first();

       

         $additionalDetails->employment_status = $request->employmentstatus;
         $additionalDetails->technology = $request->technology;
         $additionalDetails->module = $request->module;
         $additionalDetails->join_date = Date::now()->toDateString(); 

         //store details in official details form
         $dec_mng_id = EncryptionDecryptionHelper::encdecId($request->selectreportingmanager,'decrypt');
         $officialDetails = OfficialDetail::where('tbl_user_id',$dec_id)->first();
         $officialDetails->official_email_id = $request->email;
         $officialDetails->work_location = $request->worklocation;
         $officialDetails->reporting_manager_id = $dec_mng_id;
         $officialDetails->add_by = $userdetails->tbl_user_id;
         $officialDetails->add_date = Date::now()->toDateString();
         $officialDetails->add_time = Date::now()->toTimeString();
       
         


         //store statutory detaisl
        $statDetails = EpfEssiDetail::where('tbl_user_id',$dec_id)->first();
        $statDetails->uan = $request->uan_no;
        $statDetails->old_epf_no = $request->old_epf_no;
        $statDetails->nixcel_epf_no = $request->nixcel_epf_no;
        $statDetails->nixcel_essi_no = $request->nixcel_essi_no;
        $statDetails->nominee_name = $request->nominee_name;
        $statDetails->relation_with_nominee = $request->relation_with_nominee;
        $statDetails->add_by = $userdetails->tbl_user_id;
        $statDetails->add_date = Date::now()->toDateString();
        $statDetails->add_time = Date::now()->toTimeString();
        $statDetails->flag = "show";
        

        //bank details
        $bankDetails = BankDetail::where('tbl_user_id',$dec_id)->first();
        
        $bankDetails->bank_name = $request->bank_name;
        $bankDetails->city = $request->city;
        $bankDetails->ifsc = $request->ifsccode;
        $bankDetails->branch = $request->branchname;
        $bankDetails->account_no = $request->accountno;
        $bankDetails->add_by = $userdetails->tbl_user_id;
        $bankDetails->add_date = Date::now()->toDateString();
        $bankDetails->add_time = Date::now()->toTimeString();
        
        

        //kyc details
        $kycDetails = KycDetail::where('tbl_user_id',$dec_id)->first();
        $kycDetails->aadharcard_no = $request->aadharno;
        $kycDetails->pancard_no = $request->pancardno;
        $kycDetails->add_by = $userdetails->tbl_user_id;
        $kycDetails->add_date = Date::now()->toDateString();
        $kycDetails->add_time = Date::now()->toTimeString();
        


        //sal details
        $salDetails = SalaryStructureDetail::where('tbl_user_id',$dec_id)->first();

        $salDetails->actual_gross =$request->actual_gross;
        $salDetails->basic = $request->basic;
        $salDetails->hra = $request->hra;
        $salDetails->special_allowance = $request->special_allowance;
        $salDetails->medical_allowance = $request->medical;
        $salDetails->statutory_bonus = $request->statutory_bonus;
        $salDetails->payable_gross_salary = $request->payable_gross;
        $salDetails->pf = $request->pf;
        $salDetails->tds = $request->tds;
        $salDetails->pt = $request->pt;
        $salDetails->net_salary = $request->net_salary;
        $salDetails->ctc = $request->ctc;
        $salDetails->add_by = $userdetails->tbl_user_id;
        $salDetails->add_date = Date::now()->toDateString();
        $salDetails->add_time = Date::now()->toTimeString();
       

        try {
           // $emp->save();
            $officialDetails->save();
            $additionalDetails->save();
            $statDetails->save();
            $bankDetails->save();
            $kycDetails->save();
            $salDetails->save();
        } catch (\Exception $e) {
            // Handle the error, e.g., log it or return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        AuditLogHelper::logDetails('Employee Edited',$userdetails->tbl_user_id);
        return redirect('/Employees');
    }






    //add details into basic info
    public function basicInfo(Request $request)
    {

        

        //dd($request);
           //get session details

          $userdetails = session('user');

          $enc_id = $request->input('enc_id');

          $action = 'decrypt';
          $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

          $emp = EmployeeDetail::findOrFail($dec_id);
          //dd($emp);

          $emp->emp_code = $request->emp_code;
          $emp->title = $request->title;
          $emp->contact_no = $request->contact_no;
          $emp->gender = $request->gender;
          $emp->birth_date = $request->birth_date;
          $emp->current_age = $request->current_age;
          $emp->country = $request->country;
          $emp->state = $request->state;
          $emp->city = $request->city;
          $emp->pincode = $request->pincode;
          $emp->address = $request->address;
          $emp->tbl_dept_id = $request->tbl_dept_id;
          $emp->tbl_designation_id = $request->tbl_designation_id;
          $emp->tbl_role_id = $request->tbl_role_id;
          $emp->add_by = $userdetails->tbl_user_id;
          $emp->add_date = Date::now()->toDateString();
          $emp->add_time = Date::now()->toTimeString();
          $emp->save();
           
          //GET PREVIOUS EMPLOYMENT DETAILS IF ANY AND PASS IT TO VIEW
          $prev_emps = PreviousEmploymentDetail::where('tbl_user_id', $dec_id)->get();
        
          //encrypt the previous employment details id before passing to the view
          foreach ($prev_emps as $prev_emp) {
            // Encode the ID using the helper function
            $prev_emp->encrypted_id = EncryptionDecryptionHelper::encdecId($prev_emp->tbl_prev_emp_detail_id, 'encrypt');



           
        }

          return view('hr.next',compact('enc_id','prev_emps'));
    }

    
    //store prev employment details in the db
    public function storePrevEmpDetails(Request $request)
    {
        //dd($request);
        //get session details
        $userdetails = session('user');

        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);


        $prev_emp = new PreviousEmploymentDetail;
        $prev_emp->tbl_user_id = $dec_id;
        $prev_emp->company_name = $request->company_name;
        $prev_emp->designation = $request->designation;
        $prev_emp->start_date = $request->start_date;
        $prev_emp->end_date = $request->end_date;
        $prev_emp->add_by = $userdetails->tbl_user_id;
        $prev_emp->add_date = Date::now()->toDateString();
        $prev_emp->add_time = Date::now()->toTimeString();
        $prev_emp->flag ="show";
        $prev_emp->save();

        AuditLogHelper::logDetails('Previous Employment Detail Updated',$userdetails->tbl_user_id);

        return redirect()->back();
    }

    public function deletePrevEmploymentDetails($enc_prev_detail_id)
    {
        $dec_prev_detail_id = EncryptionDecryptionHelper::encdecId($enc_prev_detail_id,'decrypt');

        $prev_emp_detail = PreviousEmploymentDetail::findOrFail($dec_prev_detail_id);

        $prev_emp_detail->delete();

        $userdetails =session('user');

        AuditLogHelper::logDetails('Previous Employment Detail Deleted',$userdetails->tbl_user_id);

        return redirect()->back();

    }

    //show official details form
    public function officialDetailsForm($enc_id)
    {
        return view('hr.official_details_form',['enc_id'=>$enc_id]);
    }

    // public function storeOfficialDetails(Request $request)
    // {
    //     $userdetails = session('user');

    //     $enc_id = $request->input('enc_id');
    //     $action = 'decrypt';
    //     $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

    //     $officialDetails = OfficialDetail::where('tbl_user_id',$dec_id)->get();
    //     $officialDetails->official_email_id = $request->email;
    //     $officialDetails->work_location = $request->work_location;
    //     $officialDetails->reporting_manager_id = $request->reporting_manager_id;
    //     $officialDetails->add_by = $userdetails->tbl_user_id;
    //     $officialDetails->add_date = Date::now()->toDateString();
    //     $officialDetails->add_time = Date::now()->toTimeString();
    //     $officialDetails->save();

    //     return view('hr.statutory_comp_form',['enc_id'=>$enc_id]);
    // }

    // public function statutoryDetails(Request $request)
    // {
    //     $userdetails = session('user');

    //     $enc_id = $request->input('enc_id');
    //     $action = 'decrypt';
    //     $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

    //     $statDetails = EpfEssiDetail::where('tbl_user_id',$dec_id)->get();
    //     $statDetails->uan = $request->uan;
    //     $statDetails->old_epf_no = $request->old_epf_no;
    //     $statDetails->nixcel_epf_no = $request->nixcel_epf_no;
    //     $statDetails->nixcel_essi_no = $request->nixcel_essi_no;
    //     $statDetails->nominee_name = $request->nominee_name;
    //     $statDetails->relation_with_nominee = $request->relation_with_nominee;
    //     $statDetails->add_by = $userdetails->tbl_user_id;
    //     $statDetails->add_date = Date::now()->toDateString();
    //     $statDetails->add_time = Date::now()->toTimeString();
    //     $statDetails->flag = "show";

    //     $statDetails->save();

    //     return view('hr.bank_details_form',['enc_id'=>$enc_id]);

    // }

    // public function bankDetails(Request $request)
    // {
    //     $userdetails = session('user');

    //     $enc_id = $request->input('enc_id');
    //     $action = 'decrypt';
    //     $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

    //     $bankDetails = BankDetail::where('tbl_user_id',$enc_id)->get();
    //     $bankDetails->bank_name = $request->bank_name;
    //     $bankDetails->city = $request->city;
    //     $bankDetails->ifsc = $request->ifsc;
    //     $bankDetails->account_no = $request->account_no;
    //     $bankDetails->add_by = $userdetails->tbl_user_id;
    //     $bankDetails->add_date = Date::now()->toDateString();
    //     $bankDetails->add_time = Date::now()->toTimeString();
    //     $bankDetails->save();

    //     return view('hr.sal_details',['enc_id'=>$enc_id]);
    // }

    // public function salDetails(Request $request)
    // {
    //     $userdetails = session('user');

    //     $enc_id = $request->input('enc_id');
    //     $action = 'decrypt';
    //     $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

    //     $salDetails = SalaryStructureDetail::where('tbl_user_id',$dec_id)->get();

    //     $salDetails->actual_gross =$request->actual_gross;
    //     $salDetails->basic = $request->basic;
    //     $salDetails->hra = $request->hra;
    //     $salDetails->special_allowance = $request->special_allowance;
    //     $salDetails->medical_allowance = $request->medical_allowance;
    //     $salDetails->statutory_bonus = $request->statutory_bonus;
    //     $salDetails->payable_gross_salary = $request->payable_gross_salary;
    //     $salDetails->pf = $request->pf;
    //     $salDetails->tds = $request->tds;
    //     $salDetails->pt = $request->pt;
    //     $salDetails->net_salary = $request->net_salary;
    //     $salDetails->ctc = $request->ctc;
    //     $salDetails->add_by = $userdetails->tbl_user_id;
    //     $salDetails->add_date = Date::now()->toDateString();
    //     $salDetails->add_time = Date::now()->toTimeString();
    //     $salDetails->save();

    //     return redirect('/hr/employees');

    // }
}
