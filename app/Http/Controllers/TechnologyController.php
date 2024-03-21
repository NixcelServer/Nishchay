<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use Illuminate\Support\Facades\Date;
use App\Models\Technology;



class TechnologyController extends Controller
{
    //
    public function technologies()
    {
        //fetch the technology from db
        $technologies = Technology::where('flag','show')->get();
        

        foreach($technologies as $technology)
        {
            $technology->enc_tbl_tech_id = EncryptionDecryptionHelper::encdecId($technology->tbl_tech_id,'encrypt');

        }

        return view('frontend_admin.technology',['technologies'=>$technologies]);
    }

    public function storeTechnology(Request $request)
    {
        //get user details from session
        

        $userDetails = session('user');
        $tech = new Technology;
        $tech->tech_name = $request->technologyName;
        $tech->add_by = $userDetails->tbl_user_id;
        $tech->add_date = Date::now()->toDateString();
        $tech->add_time = Date::now()->toTimeString();
        $tech->flag = 'show';
        $tech->save();

        AuditLogHelper::logDetails('created new technology', $userDetails->tbl_user_id);

        return redirect()->back();
    }

    public function editTechnology($enc_tbl_tech_id)
    {
         //get the user details from session
         $userDetails = session('user');

         $dec_tech_id = EncryptionDecryptionHelper::encdecId($enc_tbl_tech_id,'decrypt');
 
         $tech = Technology::where('tbl_tech_id',$dec_tech_id)->first();

         
    }

    public function deleteTechnology($enc_tbl_tech_id)
    {   
        //get the user details from session
        $userDetails = session('user');

        

        $dec_tech_id = EncryptionDecryptionHelper::encdecId($enc_tbl_tech_id,'decrypt');



        $tech = Technology::where('tbl_tech_id',$dec_tech_id)->first();
        $tech->flag = 'deleted';
        $tech->deleted_by = $userDetails->tbl_user_id;
        $tech->deleted_date = Date::now()->toDateString();
        $tech->deleted_time = Date::now()->toTimeString();
        $tech->save();

        AuditLogHelper::logDetails('deleted technology', $userDetails->tbl_user_id);

        return redirect()->back();
    }

    

}
