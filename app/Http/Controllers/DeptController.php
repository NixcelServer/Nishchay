<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use App\Models\AuditLogDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class DeptController extends Controller
{
    //
     //fetch dept from db and show them in table format
     public function showDept()
     {
        $depts = Department::where('flag', 'show')->get();

         
         //encrypt ids before passing to the view
         foreach($depts as $dept){
            $dept->encrypted_id=EncryptionDecryptionHelper::encdecId($dept->tbl_dept_id, 'encrypt');
         }
         
         return view('frontend_admin.department',['depts'=>$depts]);
     }

     //create new dept form
     public function createDept(Request $request)
     {
         
         return view('dept.createDept');
     }
 
     //create new dept in db
     public function storeDept(Request $request)
     {   

      $request->validate([
         'departmentName' => [
             'required',
             'unique_based_on_flag', // Custom validation rule
         ],
     ]);
       
      
         $user_details = session('user');
         AuditLogHelper::logDetails('create department', $user_details->tbl_user_id);
        //get user detials from session to add in add by colm
         $user = session('user');
         $user_id = $user->tbl_user_id;
         $dept = new Department;
         $dept->dept_name = $request->departmentName;
         $dept->add_by = $user_id;
         $dept->add_date = Date::now()->toDateString();
         $dept->add_time = Date::now()->toTimeString();
         $dept->flag = "show";
         $dept->save();
         
         return redirect('/admin/depts');
     }
 
     public function editDeptForm($enc_id)//show edit dept form
     {  
        //decrypt the id fetch the department details and pass it ot the view
         $action = 'decrypt';
         $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
         $dept = Department::find($dec_id);
 
         return view('dept.edit',['dept'=>$dept]);
     }
 
     public function editDept(Request $request)//edit the dept
      {
         
         $request->validate([
            'departmentName' => 'required|unique:mst_tbl_depts,dept_name'
         ]);    
        //get user details from session , they will be used in update by colm
        
        $user = session('user');
        $user_id = $user->tbl_user_id;
        
        AuditLogHelper::logDetails('edit department', $user_id);
        //decrypt the id and find the dept from tables 
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        
        $dept = Department::findOrFail($dec_id);
        //edit the dept details from the attributes received in request
        $dept->dept_name = $request->departmentName;
        $dept->update_by = $user_id;
        $dept->update_date = Date::now()->toDateString();
        $dept->update_time = Date::now()->toTimeString();
        $dept->save();

        return redirect('/admin/depts');
     }

     //delete dept 
     public function deleteDept($enc_id){
        //get the dept details from db and set the flag as deleted

        $user_details = session('user');
        AuditLogHelper::logDetails('delete department', $user_details->tbl_user_id);
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $dept = Department::findOrFail($dec_id);

        $dept->flag = "deleted";
        $dept->save();

        return redirect('/admin/depts');
     }
}
