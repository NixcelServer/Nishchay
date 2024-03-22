<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Helpers\EncryptionDecryptionHelper;
use Illuminate\Support\Facades\Date;
use App\Helpers\AuditLogHelper;
use App\Models\AuditLogDetail;


class DesignationController extends Controller
{
    //
    public function showDesignation()
    {
        $designations = Designation::where('flag','show')->get();

        foreach($designations as $designation){
            $designation->encrypted_id=EncryptionDecryptionHelper::encdecId($designation->tbl_designation_id, 'encrypt');
         }
         
         return view('frontend_admin.designation',['designations'=>$designations]);

    }

    //show create designation form
    public function createDesignationForm()
    {
        return view('designation.createDesignation');
    }

    public function storeDesignation(Request $request)
    {   
        $request -> validate([
            'designationName' => [
                'required',
                'unique_designation_based_on_flag',
            ],
        ]);
        //get user detials from session to add in add by colm
        $user = session('user');
        $user_id = $user->tbl_user_id;

        $user_details = session('user');
        AuditLogHelper::logDetails('create designation', $user_id);

        $designation = new Designation;
        $designation->designation_name = $request->designationName;
        $designation->add_by = $user_id;
        $designation->add_date = Date::now()->toDateString();
        $designation->add_time = Date::now()->toTimeString();
        $designation->flag = "show";
        $designation->save();

        return redirect('/admin/designations');

    }

    public function editDesignationForm($enc_id)//sjow edit designation form
    {
        //decrypt the id fetch the designation details and pass it ot the view
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $designation = Designation::find($dec_id);

        return view('designation.edit',['designation'=>$designation]);
    } 

    public function editDesignation(Request $request)
    {   
        $request -> validate([
            'designationName' => 'required|unique:mst_tbl_designations,designation_name'
        ]);
        
         //get user details from session , they will be used in update by colm
         $user = session('user');
         $user_id = $user->tbl_user_id;

        
        AuditLogHelper::logDetails('edit designation', $user_id);
 
         //decrypt the id and find the dept from tables 
         $enc_id = $request->input('enc_id');
         $action = 'decrypt';
         $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

         $designation = Designation::findOrFail($dec_id);

         $designation->designation_name = $request->designationName;
         $designation->update_by = $user_id;
         $designation->update_date = Date::now()->toDateString();
         $designation->update_time = Date::now()->toTimeString();
         $designation->save();

         return redirect('/admin/designations');
    }

    public function deleteDesignation($enc_id)
    {
        $user_details = session('user');
        AuditLogHelper::logDetails('delete designation', $user_details->tbl_user_id); 
        //get the dept details from db and set the flag as deleted
        //
         $action = 'decrypt';
         $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);
 
         $designation = Designation::findOrFail($dec_id);
 
         $designation->flag = "deleted";
         $designation->update_by = $user_details->tbl_user_id;
         $designation->update_date = Date::now()->toDateString();
         $designation->update_time = Date::now()->toTimeString();
         $designation->save();
         return redirect()->back();
    }
}
