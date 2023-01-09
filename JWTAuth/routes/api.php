<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware'=> 'api'], function (){
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);
    // courses enrollment
    Route::post('course-enroll', [CourseController::class, 'courseEnrollment']);
    Route::get('total-courses', [CourseController::class, 'totalCourses']);
    Route::delete('delete-course/{id}', [CourseController::class, 'deleteCourse']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});