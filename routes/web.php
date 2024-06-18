<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CetakUndanganPDFController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SynDataController;
use App\Models\UserDetail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/session/tampil',[TestingController::class, 'tampilkanSession']);
Route::get('/session/buat',[TestingController::class, 'buatSession']);
Route::get('/session/hapus',[TestingController::class, 'hapusSession']);

Route::get('/detail-ttd-qr/{nidn}', function ($nidn) {
    $userDetail = UserDetail::where('nidn', $nidn)->first();
    // dd($userDetail);
    return view('detail-ttd-qr', compact('userDetail'));
});


Route::group(['middleware' => ['guest']], function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/auth/login/post', [AuthController::class, 'post'])->name('auth.login.post');
    Route::get('/auth/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/auth/register/post', [AuthController::class, 'store'])->name('auth.register.post');
});



Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Route::get('/', function () {
//     dd(true);
// });

Route::get('/syn-data', [SynDataController::class, 'synDataFakultasProdi'])->name('syn.data');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/auth/session-akses', [AuthController::class, 'selectSessionAkses'])->name('auth.selectSessionAkses');
    Route::get('/auth/session-akses/selected/{id}', [AuthController::class, 'selectedSessionAkses'])->name('auth.selectedSessionAkses');
    // cek user detail middleware
    Route::middleware(['cekuserdetail', 'checkSessionAkses'])->group( function () {

        Route::Get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    });
});
