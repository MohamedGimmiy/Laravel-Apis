<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('sample', [TestController::class, 'sample']);

Route::group(['middleware' => ['mymiddleware']], function(){

});
Route::prefix('customer')->group(function (){

});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function (){

});
