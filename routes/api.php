<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentUserController;
use App\Http\Controllers\TimeSheetController;


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

Route::post('/register', [AuthController::class, "register"])->name('register');
Route::post('/login', [AuthController::class, "login"])->name('login');

Route::middleware(['auth:sanctum','throttle:apiRequestLimiter'])->group(function () {
    Route::put('/forgetPass', [AuthController::class, "forgetPass"])->name('forgetPass');
    Route::post('/logout', [AuthController::class, "logout"])->name('logout');
    Route::prefix('v1/workspaces')->name('workspaces.')->group(function (){
        Route::post('/', [WorkspaceController::class, "show"])->name('show');
        Route::post('/create', [WorkspaceController::class, "store"])->name('store');
        Route::put('/edit/{id}', [WorkspaceController::class, "edit"])->name('edit');
        Route::put('/update/{id}', [WorkspaceController::class, "update"])->name('update');
        Route::post('/assignmentUserToWorkspace', [WorkspaceController::class, "assignmentUserToWorkspace"]);

    });
    Route::post('v1/users', [WorkspaceController::class, "user_list"])->name('logout');
    Route::prefix('v1/shifts')->name('shifts.')->group(function (){
        Route::post('/', [ShiftController::class, "show"])->name('show');
        Route::post('/create', [ShiftController::class, "store"])->name('store');
        Route::post('/edit/{id}', [ShiftController::class, "edit"])->name('edit');
        Route::put('/update/{id}', [ShiftController::class, "update"])->name('update');
    });
    Route::prefix('v1/departments')->name('departments.')->group(function (){
        Route::post('/create', [DepartmentController::class, "store"])->name('store');
        Route::post('/', [DepartmentController::class, "show"])->name('show');
        Route::put('/edit/{id}', [DepartmentController::class, "edit"])->name('edit');
        Route::put('/update/{id}', [DepartmentController::class, "update"])->name('update');

    });
    Route::prefix('v1/departmentUsers')->name('departmentUsers.')->group(function (){
        Route::post('/create', [DepartmentUserController::class, "store"])->name('store');
        Route::post('/', [DepartmentUserController::class, "show"])->name('show');
        Route::put('/edit/{id}', [DepartmentUserController::class, "edit"])->name('edit');
        Route::put('/update/{id}', [DepartmentUserController::class, "update"])->name('update');
    });
    Route::prefix('v1/timeSheets')->name('timeSheets.')->group(function (){
        Route::post('/create', [TimeSheetController::class, "store"])->name('store');
        Route::post('/', [TimeSheetController::class, "show"])->name('show');
        Route::put('/edit/{id}', [TimeSheetController::class, "edit"])->name('edit');
        Route::put('/update/{id}', [TimeSheetController::class, "update"])->name('update');
        Route::delete('/delete/{id}', [TimeSheetController::class, "destroy"])->name('destroy');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
