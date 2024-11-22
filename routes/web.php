<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;

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

Route::prefix('student')->middleware('auth')->group(function () {
    Route::get('/my-subjects', [StudentController::class, 'mySubjects'])->name('student.my-subjects');
    Route::get('/materials', [StudentController::class, 'materials'])->name('student.materials');
    Route::get('/assignments', [StudentController::class, 'assignments'])->name('student.assignments');
    Route::get('/results', [StudentController::class, 'results'])->name('student.results');
// Route to display the Change Password form (GET)
Route::get('/change-password', [StudentController::class, 'changePassword'])->name('student.change-password');

// Route to handle the form submission (POST)
Route::post('/change-password', [StudentController::class, 'updatePassword'])->name('student.update-password');
});


Route::prefix('teacher')->middleware('auth')->group(function () {
    Route::get('/upload-materials', [TeacherController::class, 'uploadMaterials'])->name('teacher.upload-materials');
    Route::get('/upload-assignments', [TeacherController::class, 'uploadAssignments'])->name('teacher.upload-assignments');
    Route::get('/upload-results', [TeacherController::class, 'uploadResults'])->name('teacher.upload-results');
    Route::post('/upload-assignments', [TeacherController::class, 'storeAssignments'])->name('teacher.store-assignments');
    Route::get('/change-password', [TeacherController::class, 'changePassword'])->name('teacher.change-password');
    // Route to handle the Change Password form submission (POST)
    Route::post('/change-password', [TeacherController::class, 'updatePassword'])->name('teacher.update-password');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/upload-announcement', [AdminController::class, 'uploadAnnouncement'])->name('admin.upload-announcement');
    Route::get('/register-classes', [AdminController::class, 'registerClasses'])->name('admin.register-classes');
    Route::get('/register-teachers', [AdminController::class, 'registerTeachers'])->name('admin.register-teachers');
    Route::get('/register-students', [AdminController::class, 'registerStudents'])->name('admin.register-students');
    Route::get('/register-subjects', [AdminController::class, 'registerSubjects'])->name('admin.register-subjects');
    Route::get('/register-exams', [AdminController::class, 'registerExams'])->name('admin.register-exams');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::post('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');

});
