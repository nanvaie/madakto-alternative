<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DepartmentController;




Route::post('/workspaces', [WorkspaceController::class, "show"])->middleware('role');
Route::post('/workspaces/create', [WorkspaceController::class, "store"])->middleware('role');
Route::put('/workspaces/edit/{id}', [WorkspaceController::class, "edit"])->middleware('role');
Route::put('/workspaces/update/{id}', [WorkspaceController::class, "update"])->middleware('role');
Route::post('/users', [WorkspaceController::class, "user_list"])->middleware('role');
Route::post('/workspaces/assignmentUserToWorkspace', [WorkspaceController::class, "assignmentUserToWorkspace"])->middleware('role');

Route::post('/shifts/create', [ShiftController::class, "store"])->middleware('role');
Route::post('/shifts', [ShiftController::class, "show"]);
Route::post('/Shifts/create', [ShiftController::class, "store"]);
Route::put('/Shifts/edit/{id}', [ShiftController::class, "edit"]);
Route::put('/Shifts/update/{id}', [ShiftController::class, "update"]);

Route::post('/departments/create', [DepartmentController::class, "store"]);
Route::post('/departments', [DepartmentController::class, "show"]);
Route::post('/departments/create', [DepartmentController::class, "store"]);
Route::put('/departments/edit/{id}', [DepartmentController::class, "edit"]);
Route::put('/departments/update/{id}', [DepartmentController::class, "update"]);

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
    Route::get('/logout', [AuthController::class, "logout"]);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
