<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SmsController;

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::prefix('/users')->group(function(){
	Route::get('/',[UserController::class,'index'])->name('users.index');
	Route::get('/fetch',[UserController::class,'fetch'])->name('users.fetch');
	Route::get('/create',[UserController::class,'create'])->name('users.create');
	Route::post('/store',[UserController::class,'store'])->name('users.store');
	Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
	Route::post('/update',[UserController::class,'update'])->name('users.update');
	Route::post('/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
	Route::post('/delete',[UserController::class,'remove'])->name('users.remove');
	Route::post('/sms/send',[SmsController::class,'smsSend'])->name('sms.send');

});


