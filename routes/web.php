<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
 
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
 
// Route::get('/', function () {
//     return view('welcome');
// });
 
//when user tries to access server
//entry point
 
// Route::get('/', function () {
//     //check if user exists in session
//     if (session()->has('user')) {
//         return redirect('/user');
//     }
//     return (new AdminController())->showLoginForm();
// });
 
// //login user verification
// Route::post('/login',[AdminController::class,'login']);
 
// //display create user form
// Route::get('/createuserfrom',[AdminController::class,'showCreateUserForm']);
 
// //submitting the create user form
// Route::post('/createnewuser',[AdminController::class,'createUser']);
 
 
 
Route::get('/',[AuthController::class,'loadLogin']);
Route::post('/login',[AuthController::class,'login']);
 
 
 
Route::group(['prefix' => '/admin','middleware'=>['web','isAdmin']],function(){
    //if admin logs in show him admin dashboard
    Route::get('/dashboard',[AdminController::class,'dashboard']);
     //if admin clicks on user in left menu
     Route::get('/users',[AdminController::class,'showUsers']);
     //admin clicks on create new user button
     Route::get('/createuser',[AdminController::class,'createUser']);
     //submitting the create new user form
     Route::post('/storeuser',[AdminController::class,'storeUser']);
     //admin clicks on departments in left menu
     Route::get('/depts',[AdminController::class,'showDept']);


     route::get('/add_new_user_form',[AdminController::class,'add_new_user_form']);

 
     //admin clicks on departments in left menu
    // Route::get('/dep')
 });
 
 //     // Route::get('/users',[SuperAdminController::class,'users'])->name('superAdminUsers');
//     // Route::get('/manage-role',[SuperAdminController::class,'manageRole'])->name('manageRole');
//     // Route::post('/update-role',[SuperAdminController::class,'updateRole'])->name('updateRole');


route::get('/admin_home',[AdminController::class,'index']);