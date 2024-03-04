<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Helpers\EncryptionDecryptionHelper;
use App\Helpers\AuditLogHelper;
use App\Models\AuditLogDetail;
use App\Models\Module;
use App\Models\RoleModule;
use Illuminate\Support\Facades\Date;


class RoleController extends Controller
{
    //show roles
    public function showRoles()
    {
        $roles = Role::where('flag','show')->get();

         //encrypt role ids before passing to the view
         foreach($roles as $role){
            $role->encrypted_id=EncryptionDecryptionHelper::encdecId($role->tbl_role_id, 'encrypt');
         }

         return view('frontend_admin.role',['roles'=>$roles]);
    }

    //display create role form
    public function createRoleForm()
    {
        return view('role.createRole');
    }

    //storing a new role in db
    public function storeRole(Request $request)
    {   
        $request->validate([
            'roleName' => 'required|unique:mst_tbl_roles,role_name',
        ]);
        
        
        
        $user = session('user');
         $user_id = $user->tbl_user_id;

        AuditLogHelper::logDetails('create role', $user_id);

         $role = new Role;
         $role->role_name = $request->roleName;
         //$dept->add_by = $user_id;
         $role->add_date = Date::now()->toDateString();
         $role->add_time = Date::now()->toTimeString();
         $role->flag = "show";
         $role->save();

         return redirect('/admin/roles');
    }

    //display edit role form
    public function editRoleForm($enc_id)
    {
        //decrypt the id fetch the department details and pass it ot the view
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $role = Role::find($dec_id);

        return view('role.edit',['role'=>$role,'enc_id' => $enc_id]);
    }

    //editing the role and updating details in db
    public function editRole(Request $request)
    {       
        $request->validate([
            'roleName' => 'required|unique:mst_tbl_roles,role_name',
        ]);
        
          //get user details from session , they will be used in update by colm
          $user = session('user');
          $user_id = $user->tbl_user_id;
  
          AuditLogHelper::logDetails('edit role', $user_id);

          //decrypt the id and find the dept from tables 
          $enc_id = $request->input('enc_id');
          $action = 'decrypt';
          $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);
  
          $role = Role::findOrFail($dec_id);
          //edit the dept details from the attributes received in request
          $role->role_name = $request->roleName;

          //$role->update_by = $user_id;

          $role->updated_date = Date::now()->toDateString();
          $role->updated_time = Date::now()->toTimeString();
          $role->save();

          return redirect('/admin/roles');
    }

    //deleting the role
    public function deleteRole($enc_id)
    {
        $user_details = session('user');
        AuditLogHelper::logDetails('delete role', $user_details->tbl_user_id);
        //get the dept details from db and set the flag as deleted
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $role = Role::findOrFail($dec_id);

        $role->flag = "deleted";
        $role->save();

        return redirect('/admin/roles');
    }

    //assign a module to particular role
    public function assignModuleForm($enc_id)
    {
        //decrypt the id and fetch data from tbl_role_modules
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $role = Role::findOrFail($dec_id);

        $roleModules = RoleModule::where('tbl_role_id',$dec_id)->get();
        //dd($roleModules);

        $moduleData = [];

        //iterating through tbl_role_modules getting data from mst_tbl_modules based on tbl_module_id and
        //storing that data in moduleData array and also role encrypted tbl_role_module_id which will we used 
        //to delete assigned module
        foreach($roleModules as $roleModule){
            
            $module = Module::find($roleModule->tbl_module_id);
            
            if ($module) {
                // Encrypt module ID
                $enc_module_id = EncryptionDecryptionHelper::encdecId($module->id, 'encrypt');
                $enc_role_module_id = EncryptionDecryptionHelper::encdecId($roleModule->tbl_role_module_id, 'encrypt');
                $moduleData[] = [
                    'module' => $module,
                    'enc_module_id' => $enc_module_id,
                    'enc_role_module_id' => $enc_role_module_id
                ];
            }
        }

        $mod = Module::all();

        foreach ($mod as $module) {
            $encryptedId = EncryptionDecryptionHelper::encdecId($module->tbl_module_id,'encrypt');
            $module->encrypted_id = $encryptedId;
        }
        
        //passing data to the view
        return view('frontend_admin.assign_module',['role'=>$role,'enc_id' => $enc_id,'moduleData' => $moduleData,'mod'=>$mod]);
    }

    //assign a new module to a particular role
    public function assignModule(Request $request)

    {
        
        //get user details from session , they will be used in update by colm
        $user = session('user');
        $user_id = $user->tbl_user_id;
        
        AuditLogHelper::logDetails('assign module', $user_id);

        //decrypt the role id   
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        //decrypt the module id
        $mod_enc_id = $request->selectModule;
       
        $action = 'decrypt';
        $mod_dec_id = EncryptionDecryptionHelper::encdecId($mod_enc_id,$action);
        

        // Check if the module is already assigned to the role
        $existingAssignment = RoleModule::where('tbl_role_id', $dec_id)
        ->where('tbl_module_id', $mod_dec_id)
        ->first();
        
        if($existingAssignment)
        {
            
            return redirect()->back()->with('error', 'Module is already assigned to this role.');

        }

        $role_module = new RoleModule;
        $role_module->tbl_role_id = $dec_id;
        $role_module->tbl_module_id = $mod_dec_id;
        $role_module->add_by = $user_id;
        $role_module->add_date = Date::now()->toDateString();
        $role_module->add_time = Date::now()->toTimeString();
        $role_module->save();


        return redirect()->back()->with('success', 'Module assigned successfully.');

    }

    //delete a module assigned to a particular role
    public function deleteModule(Request $request)
    {
        $user_details = session('user');
        AuditLogHelper::logDetails('delete module', $user_details->tbl_user_id);
        //get encrypted id
        $enc_id = $request->roleModuleId;
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);
        
        //detch details form tbl_role_modules based on tbl_role_module_id   and delete the entry 
        //based on tbl_role_module_id
        $role_module = RoleModule::findOrFail($dec_id);
    
        
        $role_module->delete();

        return redirect()->back();
    }
}
