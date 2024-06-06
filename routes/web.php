<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


// Méthode fallback() en dernière position
Route::fallback(function () {
    return view('errors.error-404', [], 404); // la vue 404.blade.php
})->name('404');

/*---------------------
	1. Authentication
-----------------------*/
Route::get('/', [HomeController::class, 'login'])->name('login')->middleware('guest');
Route::get('/login', [HomeController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/otp', [HomeController::class, 'otp'])->name('otp')->middleware('guest');
Route::get('/lock', [HomeController::class, 'lock'])->name('lock')->middleware('guest');
Route::post('/sign-in', [HomeController::class, 'singIn'])->name('sign-in')->middleware('guest');
Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('resetPassword')->middleware('guest');
Route::get('/reset-password', [HomeController::class, 'forgotPassword'])->name('forgotPassword')->middleware('guest');
Route::get('/reset/{token}', [HomeController::class, 'reset'])->name('password.reset')->middleware('guest');
Route::post('/reset', [HomeController::class, 'resetProcess'])->name('password.resetProcess')->middleware('guest');


Route::group(['middleware' => ['auth']] ,function () {
    /*---------------------
        2. HomeController
    -----------------------*/
    Route::get('home', [DashboardController::class, 'home'])->name('home');
    Route::get('send-email', [DashboardController::class, 'sendEmail'])->name('send-email');
    Route::get('admin/user/list-services', [UserController::class, 'servicesList'])->name('services.index');
    Route::post('admin/user/get-list-services', [UserController::class, 'getServicesList'])->name('services.list');
    Route::post('admin/user/change-status-services', [UserController::class, 'changeStatusServices']);
    Route::post('admin/user/save-services', [UserController::class, 'saveServices']);
    Route::post('admin/user/delete-services', [UserController::class, 'deleteServices']);
    Route::get('admin/user/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('admin/user/profile/{slug}', [UserController::class, 'profile_other'])->name('profile_other');
    
    /*---------------------
    2. UserController
    -----------------------*/
    Route::get('admin/employees', [UserController::class, 'employeesCardList'])->name('employeesCardList');
    Route::get('admin/employees-list', [UserController::class, 'employeesList'])->name('employeesList');
    Route::post('admin/employees-list', [UserController::class, 'getEmployeesList']);
    Route::post('admin/employees/search-employees', [UserController::class, 'searchEmployees'])->name('searchEmployees');
    Route::post('admin/employees/add-employees', [UserController::class, 'addEmployees'])->name('employee.add');

});

