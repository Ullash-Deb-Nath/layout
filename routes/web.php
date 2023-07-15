<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[WebsiteController::class, 'home']);
Route::get('/about',[WebsiteController::class, 'about']);
Route::get('/contact',[WebsiteController::class, 'contact']);
Route::get('/services',[WebsiteController::class, 'services']);




Route::get('admin/login',[AuthController::class, 'login']);
Route::post('admin/user-login',[AuthController::class, 'userLogin']);

Route::get('admin/teacher-register',[AuthController::class, 'teacherRegister']);
Route::post('admin/teacher-regristration',[AuthController::class, 'regristrationTeacher']);

Route::get('admin/student-register',[AuthController::class, 'studentRegister']);
Route::post('admin/student-regristration',[AuthController::class, 'regristrationStudent']);



Route::middleware(['checkLogin'])->group(function () {
    
    Route::get('admin/dashboard',[AdminLayoutController::class, 'dashboard']);
    Route::get('admin/tables',[AdminLayoutController::class, 'tables']);
    Route::get('admin/logout',[AuthController::class, 'logout']);


    Route::middleware(['checkIfAdmin'])->group(function () {

        Route::get('admin/pending-users',[UserController::class, 'pendingUsers']);
        Route::get('admin/approve-user/{userid}',[UserController::class, 'approveUser']);
        
    });

    
});

