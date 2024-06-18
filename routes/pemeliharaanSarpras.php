<?php

use App\Http\Controllers\PemeliharaanSarpras\PemeliharaanSarprasController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'pemeliharaan-sarpras'], function () {
    Route::middleware('rolecheck:ADM|IVN|PJS')->group(function () {
        Route::get('/', [PemeliharaanSarprasController::class, 'index'])->name('pemeliharaanSarpras.index');
        Route::post('/post', [PemeliharaanSarprasController::class, 'post'])->name('pemeliharaanSarpras.post');
        
    });
});