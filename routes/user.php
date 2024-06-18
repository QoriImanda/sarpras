<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
// user index
Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('rolecheck:ADM');
// edit user
Route::get('/user/profile/{id}', [UserController::class, 'edit'])->name('user.edit');
// profile user
Route::get('/user/profile', [UserController::class, 'edit'])->name('user.profile');
// change role
Route::post('/user/profile/role/change/{id}', [UserController::class, 'changeRole'])->name('user.changeRole');
// update foto profile
Route::post('/user/update/foto/profile/{id}', [UserDetailController::class, 'updateFotoProfile'])->name('user.updateFotoProfile');
// change account
Route::post('/user/change/account/{id}', [UserController::class, 'changeAccount'])->name('user.changeAccount');
// user detail
Route::post('/user/edit/{id}/update', [UserDetailController::class, 'update'])->name('user.edit.update');
