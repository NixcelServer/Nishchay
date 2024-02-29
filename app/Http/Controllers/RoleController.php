<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Helpers\EncryptionDecryptionHelper;
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

    public function createRoleForm()
    {
        return view('role.createRole');
    }

    public function storeRole(Request $request)
    {
        $user = session('user');
         $user_id = $user->tbl_user_id;
         $role = new Role;
         $role->role_name = $request->roleName;
         //$dept->add_by = $user_id;
         $role->add_date = Date::now()->toDateString();
         $role->add_time = Date::now()->toTimeString();
         $role->flag = "show";
         $role->save();

         return redirect('/admin/roles');
    }

    public function editRoleForm($enc_id)
    {
        //decrypt the id fetch the department details and pass it ot the view
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $role = Role::find($dec_id);

        return view('role.edit',['role'=>$role,'enc_id' => $enc_id]);
    }

    public function editRole(Request $request)
    {
          //get user details from session , they will be used in update by colm
          $user = session('user');
          $user_id = $user->tbl_user_id;
  
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

    public function deleteRole($enc_id)
    {
        //get the dept details from db and set the flag as deleted
        
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $role = Role::findOrFail($dec_id);

        $role->flag = "deleted";
        $role->save();

        return redirect('/admin/roles');
    }

    public function assignModuleForm($enc_id)
    {
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id, $action);
        $role = Role::findOrFail($dec_id);

        $roleModules = RoleModule::where('tbl_role_id',$dec_id)->get();

        $moduleData = [];

        foreach($roleModules as $roleModule){
            $module = Module::find($roleModule->tbl_module_id);
            if ($module) {
                // Encrypt module ID
                $enc_module_id = EncryptionDecryptionHelper::encdecId($module->id, 'encrypt');
                $moduleData[] = [
                    'module' => $module,
                    'enc_module_id' => $enc_module_id,
                ];
            }
        }

        return view('role.assginModule',['role'=>$role,'enc_id' => $enc_id,'moduleData' => $moduleData]);
    }

    public function assignModule(Request $request)
    {
        //get user details from session , they will be used in update by colm
        $user = session('user');
        $user_id = $user->tbl_user_id;
        
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $role_module = new RoleModule;
        $role_module->tbl_role_id = $dec_id;
        $role_module->tbl_module_id = $request->selectedModule;
        $role_module->add_by = $user_id;
        $role_module->add_date = Date::now()->toDateString();
        $role_module->add_time = Date::now()->toTimeString();
        $role_module->save();

    }

    public function deleteModule(Request $request)
    {
        $enc_id = $request->input('enc_id');
        $action = 'decrypt';
        $dec_id = EncryptionDecryptionHelper::encdecId($enc_id,$action);

        $role_module = RoleModule::findOrFail($dec_id);

        
        $role_module->delete();
    }
}
