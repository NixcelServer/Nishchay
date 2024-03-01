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
use App\Models\BankDetail;
use App\Models\SalaryStructureDetail;

class HrController extends Controller
{
    //When HR logs in show HR Dashboard
    public function dashboard()
    {
        return view('frontend_hr.hr_home');
    }

    public function showEmployees()
    {
        $emps = EmployeeDetail::where('flag', 'show')
        ->whereNotIn('tbl_role_id', [1])
        ->get(); 
        
        
        //encrypt the id of emp and pass to the view
        foreach ($emps as $emp) {
            // Encode the user's ID using the helper function
            $emp->encrypted_id = EncryptionDecryptionHelper::encdecId($emp->tbl_user_id, 'encrypt');
        }

        
        return view('frontend_hr.new_employee_registration', compact('emps'));
    }
                
    public function editEmpForm($enc_id)
    {
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        
        $user = User::find($dec_id);
        

        $emp = EmployeeDetail::where('tbl_user_id', $dec_id)->first();

         
        
        return view('frontend_hr.editEmp',['emp'=>$emp,'user'=>$user,'enc_id'=>$enc_id]);
    }

    //add details into basic info
    public function basicInfo(Request $request)
    {
           //get session details
          $userdetails = session('user');

          $enc_id = $request->input('enc_id');

          $action = 'decrypt';
          $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

          $emp = EmployeeDetail::findOrFail($dec_id);

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

        return redirect()->back();
    }

    //show official details form
    public function officialDetailsForm($enc_id)
    {
        return view('hr.official_details_form',['enc_id'=>$enc_id]);
    }

    public function storeOfficialDetails(Request $request)
    {
        $userdetails = session('user');

        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $officialDetails = OfficialDetail::where('tbl_user_id',$dec_id)->get();
        $officialDetails->official_email_id = $request->email;
        $officialDetails->work_location = $request->work_location;
        $officialDetails->reporting_manager_id = $request->reporting_manager_id;
        $officialDetails->add_by = $userdetails->tbl_user_id;
        $officialDetails->add_date = Date::now()->toDateString();
        $officialDetails->add_time = Date::now()->toTimeString();
        $officialDetails->save();

        return view('hr.statutory_comp_form',['enc_id'=>$enc_id]);
    }

    public function statutoryDetails(Request $request)
    {
        $userdetails = session('user');

        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $statDetails = EpfEssiDetail::where('tbl_user_id',$dec_id)->get();
        $statDetails->uan = $request->uan;
        $statDetails->old_epf_no = $request->old_epf_no;
        $statDetails->nixcel_epf_no = $request->nixcel_epf_no;
        $statDetails->nixcel_essi_no = $request->nixcel_essi_no;
        $statDetails->nominee_name = $request->nominee_name;
        $statDetails->relation_with_nominee = $request->relation_with_nominee;
        $statDetails->add_by = $userdetails->tbl_user_id;
        $statDetails->add_date = Date::now()->toDateString();
        $statDetails->add_time = Date::now()->toTimeString();
        $statDetails->flag = "show";

        $statDetails->save();

        return view('hr.bank_details_form',['enc_id'=>$enc_id]);

    }

    public function bankDetails(Request $request)
    {
        $userdetails = session('user');

        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $bankDetails = BankDetail::where('tbl_user_id',$enc_id)->get();
        $bankDetails->bank_name = $request->bank_name;
        $bankDetails->city = $request->city;
        $bankDetails->ifsc = $request->ifsc;
        $bankDetails->account_no = $request->account_no;
        $bankDetails->add_by = $userdetails->tbl_user_id;
        $bankDetails->add_date = Date::now()->toDateString();
        $bankDetails->add_time = Date::now()->toTimeString();
        $bankDetails->save();

        return view('hr.sal_details',['enc_id'=>$enc_id]);
    }

    public function salDetails(Request $request)
    {
        $userdetails = session('user');

        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $salDetails = SalaryStructureDetail::where('tbl_user_id',$dec_id)->get();

        $salDetails->actual_gross =$request->actual_gross;
        $salDetails->basic = $request->basic;
        $salDetails->hra = $request->hra;
        $salDetails->special_allowance = $request->special_allowance;
        $salDetails->medical_allowance = $request->medical_allowance;
        $salDetails->statutory_bonus = $request->statutory_bonus;
        $salDetails->payable_gross_salary = $request->payable_gross_salary;
        $salDetails->pf = $request->pf;
        $salDetails->tds = $request->tds;
        $salDetails->pt = $request->pt;
        $salDetails->net_salary = $request->net_salary;
        $salDetails->ctc = $request->ctc;
        $salDetails->add_by = $userdetails->tbl_user_id;
        $salDetails->add_date = Date::now()->toDateString();
        $salDetails->add_time = Date::now()->toTimeString();
        $salDetails->save();

        return redirect('/hr/employees');

    }
}
