<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\UserController as ApiUserController;

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

Route::post('login',[ApiUserController::class,'login']);
Route::post('register',[ApiUserController::class,'register']);

Route::group(['middleware' => 'auth:api'], function(){
    //User
    Route::get('/users',[UserController::class,'showAllUser']);

//Employee
    Route::resource('/employee', EmployeeController::class);

    //Department
    Route::resource('/department', DepartmentController::class);

    // Country
    Route::resource('/country', CountryController::class);

    // City
    Route::resource('/city', CityController::class);

});





