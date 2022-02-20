<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//User
Route::get('/users',[UserController::class,'showAllUser']);

//Employee
Route::get('/allEmployees',[EmployeeController::class,'getAllEmployees']);
Route::get('/getOneEmployee/{$id}',[EmployeeController::class,'getOneEmployee']);
Route::post('/createEmployee',[EmployeeController::class,'createEmployee']);
Route::put('/updateEmployee/{id}',[EmployeeController::class,'updateEmployee']);
Route::delete('/deleteEmployee/{id}',[EmployeeController::class,'deleteEmployee']);

//