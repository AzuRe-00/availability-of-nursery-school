<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;

Route::prefix('admin')->group(function(){
   Route::get('register', [AdminController::class, 'create'])->name('admin.register');
   Route::post('register', [AdminController::class, 'store'])->name('admin.register.store');
   Route::get('login', [AdminController::class, 'index'])->name('admin.login.index'); 
   Route::post('login', [AdminController::class, 'login'])->name('admin.login.login');
   Route::get('logout', [AdminController::class, 'logout'])->name('admin.login.logout');
   
   Route::get('/',[HomeController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('adimin')->middleware('auth:admins')->group(function(){
    Route::get('/', [HomeController::class, 'dashboard'])->name('admin.dashboard');
});