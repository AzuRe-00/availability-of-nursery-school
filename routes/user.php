<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\HomeController;

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('register.store');
Route::get('login', [UserController::class, 'index'])->name('login.index'); 
Route::post('login', [UserController::class, 'login'])->name('login.login');
Route::get('logout', [UserController::class, 'logout'])->name('login.logout');
   
Route::prefix('user')->group(function(){
    Route::get('/',[HomeController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('user')->middleware('auth.members:members')->group(function(){
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
});