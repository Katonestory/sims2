<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BursarController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\AssignmentsController;


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

    Route::get('/student/home', [HomeController::class, 'studentHome'])->name('home.student');
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
    Route::get('/assignments', [StudentController::class, 'assignments'])->name('student.assignments');
    Route::get('/results', [StudentController::class, 'results'])->name('student.results');
// Route to display the Change Password form (GET)
Route::get('/change-password', [StudentController::class, 'changePassword'])->name('student.change-password');

// Route to handle the form submission (POST)
Route::post('/change-password', [StudentController::class, 'updatePassword'])->name('student.update-password');
});


Route::prefix('teacher')->middleware('auth')->group(function () {

    Route::get('/upload-assignments', [AssignmentsController::class, 'uploadForm'])->name('teacher.upload-assignments');
    Route::post('/teacher/upload-assignments', [AssignmentsController::class, 'store'])->name('assignments.upload');
    Route::get('/upload-results', [TeacherController::class, 'uploadResults'])->name('teacher.upload-results');
    Route::post('/upload-results', [ResultController::class, 'uploadResults'])->name('upload.results');
    Route::get('/get-exam-titles', [ResultController::class, 'getExamTitles'])->name('getExamTitles');
    Route::get('/change-password', [TeacherController::class, 'changePassword'])->name('teacher.change-password');
    // Route to handle the Change Password form submission (POST)
    Route::post('/change-password', [TeacherController::class, 'updatePassword'])->name('teacher.update-password');
});


Route::prefix('admin')->middleware('auth')->group(function () {
     // Announcement routes
    Route::post('/upload-announcement', [AdminController::class, 'uploadAnnouncement'])->name('admin.upload-announcement');
    Route::get('/upload-announcement', [AdminController::class, 'showUploadAnnouncementForm'])->name('admin.upload-announcement-form');

    // Registration routes for classes, teachers, students, subjects, and exams plus departments and streams
    Route::get('/register-classes', [AdminController::class, 'showRegisterClassForm'])->name('admin.register-classes');
    Route::post('/register-classes', [AdminController::class, 'registerClass'])->name('admin.register-classes.submit');
    Route::get('admin/register-stream', [AdminController::class, 'showRegisterStreamForm'])->name('admin.register-stream');
    Route::post('admin/register-stream', [AdminController::class, 'registerStream'])->name('admin.store-stream');
    Route::get('/register-teachers', [AdminController::class, 'registerTeachers'])->name('admin.register-teachers');
    Route::post('/register-teachers', [AdminController::class, 'registerTeachers'])->name('admin.register-teachers.submit');
    Route::get('/register-students', [AdminController::class, 'registerStudents'])->name('admin.register-students');
    Route::post('/register-students', [AdminController::class, 'registerStudents'])->name('admin.register-students.submit');
    Route::get('/admin/register-department', [AdminController::class, 'showRegisterDepartmentForm'])->name('admin.register-department');
    Route::post('/admin/register-department', [AdminController::class, 'storeDepartment'])->name('admin.store-department');
    Route::get('/register-subjects', [AdminController::class, 'showRegisterSubjectsForm'])->name('admin.register-subjects');
    Route::post('/admin/register-subjects', [AdminController::class, 'storeSubject'])->name('admin.store-subjects');
    Route::get('/register-exams', [AdminController::class, 'registerExams'])->name('admin.register-exams');
    Route::post('/register-exams', [AdminController::class, 'storeExam'])->name('admin.register-exams.submit');


    // Admin password change route
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
});


//bursar routes
Route::middleware(['auth','user-role:bursar'])->group(function(){

    Route::get("/bursar/home",[HomeController::class, 'bursarHome'])->name('home.bursar');
});


Route::prefix('bursar')->middleware('auth')->group(function () {
    Route::get('/bursar/fee-structure-management', [BursarController::class, 'feeStructureManagement'])->name('bursar.fee-structure-management');
    Route::get('/financial-report', [BursarController::class, 'financialReport'])->name('bursar.financialReport');
    Route::get('/generate-invoice', [BursarController::class, 'generateInvoice'])->name('bursar.generateInvoice');
    Route::get('/bursar/view-and-manage-payments', [BursarController::class, 'viewAndManagePayments'])->name('bursar.view-and-manage-payments');
    Route::get('/change-password', [BursarController::class, 'changePassword'])->name('bursar.changePassword');
    Route::post('/bursar/update-password', [BursarController::class, 'updatePassword'])->name('bursar.updatePassword');
});

?>
