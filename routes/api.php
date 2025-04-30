<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Middleware\SuperAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);
//Route::post('add', [SuperAdminController::class, 'addAdmin']);

//Route::middleware(['auth:sanctum', 'abilities:super_admin'])->post('/admins/add', [SuperAdminController::class, 'addAdmin']);
//Route::middleware(['auth', 'role:super_admin'])->prefix('admins')->group(function () {
//});
//Route::middleware(['auth:sanctum', 'role:super_admin'])->group(function () {
 //   Route::get('/admins/add', [SuperAdminController::class, 'addAdmin']);
//});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::middleware([SuperAdminMiddleware::class])->group(function () {

        Route::get('/admins', [SuperAdminController::class, 'getAdmins']);
        Route::get('/admins/{admin_id}', [SuperAdminController::class, 'getAdminById']);
        Route::post('/admins/add', [SuperAdminController::class, 'addAdmin']);
        Route::put('/admins/update/{admin_id}', [SuperAdminController::class, 'updateAdmin']);
        Route::put('/admins/updateStatus/{admin_id}', [SuperAdminController::class, 'updateStatusAdmin']);
        Route::delete('/admins/delete/{admin_id}', [SuperAdminController::class, 'deleteAdmin']);
        Route::get('/admins/trashed/tr', [SuperAdminController::class, 'getTrashedadmins']); 
        Route::get('/admins/trashed/{admin_id}', [SuperAdminController::class, 'getTrashedAdmin']);
        Route::get('/admins/restore/{admin_id}', [SuperAdminController::class, 'restoreTrashedAdmin']);
        Route::get('/admins/forceDelete/{admin_id}', [SuperAdminController::class, 'forceDeleteTrashedAdmin']);
    });
});


