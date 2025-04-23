<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
     return view('welcome');
 });
Route::get(uri:'login',action:static fn() => \App\Models\User::firstOrFail()->createToken('token')->plainTextToken,)->name('login');
