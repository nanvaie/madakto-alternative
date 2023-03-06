<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\TimeSheetController;



Route::prefix('v1/workspaces')->group(function (){
    Route::post('/', [WorkspaceController::class, "show"]);
    Route::post('/create', [WorkspaceController::class, "store"]);
    Route::put('/edit/{id}', [WorkspaceController::class, "edit"]);
    Route::put('/update/{id}', [WorkspaceController::class, "update"]);
    Route::post('/assignmentUserToWorkspace', [WorkspaceController::class, "assignmentUserToWorkspace"]);

});
Route::post('v1/users', [WorkspaceController::class, "user_list"]);
Route::prefix('v1/shifts')->group(function (){
    Route::post('/', [ShiftController::class, "show"]);
    Route::post('/create', [ShiftController::class, "store"]);
    Route::post('/edit/{id}', [ShiftController::class, "edit"]);
    Route::put('/update/{id}', [ShiftController::class, "update"]);
});
Route::prefix('v1/departments')->group(function (){
    Route::post('/create', [DepartmentController::class, "store"]);
    Route::post('/', [DepartmentController::class, "show"]);
    Route::put('/edit/{id}', [DepartmentController::class, "edit"]);
    Route::put('/update/{id}', [DepartmentController::class, "update"]);

});
Route::prefix('v1/departmentUsers')->group(function (){
    Route::post('/create', [DepartmentUserController::class, "store"]);
    Route::post('/', [DepartmentUserController::class, "show"]);
    Route::put('/edit/{id}', [DepartmentUserController::class, "edit"]);
    Route::put('/update/{id}', [DepartmentUserController::class, "update"]);
});

Route::prefix('v1/timeSheets')->group(function (){
    Route::post('/create', [TimeSheetController::class, "store"]);
    Route::post('/', [TimeSheetController::class, "show"]);
    Route::put('/edit/{id}', [TimeSheetController::class, "edit"]);
    Route::put('/update/{id}', [TimeSheetController::class, "update"]);
    Route::delete('/delete/{id}', [TimeSheetController::class, "destroy"]);
});











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

Route::post('/register', [AuthController::class, "signup"]);
Route::post('/login', [AuthController::class, "login"]);
Route::put('/forgetPass', [AuthController::class, "forgetPass"]);





Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, "logout"]);




});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
