<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Helpers\EncryptionDecryptionHelper;

class DeptController extends Controller
{
    //
     //fetch dept from db and show them in table format
     public function showDept()
     {
        $departments = Department::where('flag', 'show')->get();

         
         //encrypt ids before passing to the view
         foreach($depts as $dept){
            $dept->encrypted_id=EncryptionDecryptionHelper::encdecId($dept->tbl_dept_id, 'encrypt');
         }
         
         return view('dept.depts',['depts'=>$depts]);
     }

     //create new dept form
     public function createDept(Request $request)
     {
        
         return view('dept.createDept');
     }
 
     //create new dept in db
     public function storeDept(Request $request)
     {   
        //get user detials from session to add in add by colm
         $user = session('user');
         $user_id = $user->tbl_user_id;
         $dept = new Department;
         $dept->department_name = $request->department_name;
         $dept->add_by = $user_id;
         $dept->add_date = Date::now()->toDateString();
         $dept->add_time = Date::now()->toTimeeString();
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
        //get user details from session , they will be used in update by colm
        $user = session('user');
        $user_id = $user->tbl_user_id;

        //decrypt the id and find the dept from tables 
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $dept = Department::findOrFail($dec_id);
        //edit the dept details from the attributes received in request
        $dept->dept_name = $request->dept_name;
        $dept->update_by = $user_id;
        $dept->update_date = Date::now()->toDateString();
        $dept->update_time = Date::now()->toTimeeString();
        $dept->save();

        return redirect('/admin/depts');
     }

     //delete dept 
     public function deleteDept(Request $request){
        //get the dept details from db and set the flag as deleted
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $dept = Department::findOrFail($dec_id);

        $dept->flag = "deleted";
        $dept->save();

        return redirect('/admin/depts');
     }
}
