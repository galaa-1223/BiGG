<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TeachersController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\HuvaariController;
use App\Http\Controllers\Api\StatisticController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => '/v1'], function()
{
    Route::get('students', [StudentsController::class, 'studentList']);
    Route::post("student-login", [StudentsController::class, 'studentLogin']);

    Route::get('teachers', [TeachersController::class, 'teacherList']);
    Route::get('teachers/fond', [TeachersController::class, 'teacherFond']);
    // Route::get('teachers/{query}', [TeachersController::class, 'teacherQuery']);
    Route::post("teacher-login", [TeachersController::class, 'teacherLogin']);

    Route::get('huvaari/teachers', [HuvaariController::class, 'teacherList']);
    Route::get('huvaari/angiud', [HuvaariController::class, 'angiList']);

    Route::get('statistics', [StatisticController::class, 'index']);
});