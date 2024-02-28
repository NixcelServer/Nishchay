<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DeptController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HrController;




 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 



Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);





Route::group(['prefix' => '/admin','middleware'=>['web','isAdmin']],function(){
    //if admin logs in show him admin dashboard
     Route::get('/dashboard',[AdminController::class,'dashboard']);
     //if admin clicks on user in left menu
     Route::get('/users',[AdminController::class,'showUsers']);
     //admin clicks on create new user button
     Route::get('/createuser',[AdminController::class,'createUser']);
     //submitting the create new user form
     Route::post('/storeuser',[AdminController::class,'storeUser']);
     //edit user form admin/edituser/DZhu0d9k7PU=
     Route::get('/edituser/{id}',[AdminController::class,'editUserForm']);
     //upadte the user in db
     Route::post('/edituser',[AdminController::class,'editUser']);
     //delete user
     Route::post('/delete',[AdminController::class,'deleteUser']);

     //admin clicks on departments in left menu
     Route::get('/depts',[DeptController::class,'showDept']);
    //show new department form
     Route::get('/createdept',[DeptController::class,'createDept']);
     //create a new dept in db
     Route::post('/storedept',[DeptController::class,'storeDept']);
     //edit dept form
     Route::get('/editdept/{id}',[DeptController::class,'editDeptForm']);
     //edit dept and store into database
     Route::post('/editdept',[DeptController::class,'editDept']);
     //delete dept
     Route::post('/deletedept',[DeptController::class,'deleteDept']);

     //designations
     Route::get('/designation',[DesignationController::class,'showDesignation']);
     //show new department form
     Route::get('/createdesignationform',[DesignationController::class,'createDesignation']);
     //create a new dept in db
     Route::post('/storedesignation',[DesignationController::class,'storeDesignation']);
     //edit designation form
     Route::get('/editdesignation/{id}',[DesignationController::class,'editDesignationForm']);
    //edit designation and store in db
     Route::post('/editdesignation',[DesignationController::class,'editDesignation']);
     //delete designation
     Route::post('/deletedesignation',[DesignationController::class,'deleteDesignation']);

     //Role
     //show roles
     Route::get('/roles',[RoleController::class,'showRoles']);
     //display create role form
     Route::get('/createroleform',[RoleController::class,'createRoleForm']);
     //store new role into db
     Route::post('/storerole',[RoleController::class,'storeRole']);
     //edit existing role
     Route::get('/editrole/{id}',[RoleController::class,'editRoleForm']);
     //store existing edited role into db
     Route::post('/editrole',[RoleController::class,'editRole']);
     //delete role
     Route::post('/deleterole',[RoleController::class,'deleteRole']);
     //assign module form
     Route::get('/assignmodule/{id}',[RoleController::class,'assignModuleForm']);
     //store assign module details into db
     Route::post('/assignmodule',[RoleController::class,'assignModule']);
     //delete assigned module
     Route::post('/deletemodule',[RoleController::class,'deleteModule']);

 });

 //     // Route::get('/users',[SuperAdminController::class,'users'])->name('superAdminUsers');
//     // Route::get('/manage-role',[SuperAdminController::class,'manageRole'])->name('manageRole');
//     // Route::post('/update-role',[SuperAdminController::class,'updateRole'])->name('updateRole');

Route::group(['prefix' => '/hr','middleware'=>['web','isHr']],function(){
    //mention your routes here

    //if Hr logs in show him admin dashboard
    Route::get('/dashboard',[HrController::class,'dashboard']);
    Route::get('/employees',[HrController::class,'showEmployees']);
});

