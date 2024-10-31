<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['login' => false]);

//handle login
Route::post('/login', [LoginController::class, 'login'])->name('login');


//user route
Route::middleware(['auth','user-role:student'])->group(function(){

    Route::get("/home",[HomeController::class, 'studentHome'])->name('home');
});

//teacher  route
Route::middleware(['auth','user-role:teacher'])->group(function(){
    
    Route::get("/teacher/home",[HomeController::class, 'teacherHome'])->name('home.teacher');
});

//admin route
Route::middleware(['auth','user-role:admin'])->group(function(){
    
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name('home.admin');
});
