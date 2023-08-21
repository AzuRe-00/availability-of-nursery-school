<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;

Route::prefix('admin')->group(function(){
   Route::get('register', [AdminController::class, 'create'])->name('admin.register');
   Route::post('register', [AdminController::class, 'store'])->name('admin.register.store');
   Route::get('login', [AdminComntroller::class, 'index'])->name('admin.login.index'); 
   Route::post('login', [AdminComntroller::class, 'login'])->name('admin.login.login');
   Route::get('logout', [AdminComntroller::class, 'logout'])->name('admin.login.logout');
   
   Route::get('/',[AdminHomeComntroller::class, 'dashboard'])->name('admin.dashboard');
});