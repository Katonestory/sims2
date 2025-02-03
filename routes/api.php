<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('userpostdata/login', [App\Http\Controllers\AppController::class, 'login']);
Route::post('userpostdata/subject', [App\Http\Controllers\AppController::class, 'getSubjects']);
