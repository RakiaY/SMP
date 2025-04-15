<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['auth:sanctum', 'role:super_admin'])
//     ->post('/admins/add', [SuperAdminController::class, 'addAdmin']);
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admins')->group(function () {
    Route::post('/add', [SuperAdminController::class, 'addAdmin']);
});
