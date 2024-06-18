<?php

use App\Http\Controllers\PendataanSarpras\PendataanSarprasController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'pendataan-sarpras'], function () {
    Route::middleware('rolecheck:ADM|IVN|PJS')->group(function () {
        Route::get('/menu', [PendataanSarprasController::class, 'menu'])->name('pendataanSarpras.menu');
        Route::get('/{menu}', [PendataanSarprasController::class, 'pendataan'])->name('pendataanSarpras.pendataan');
        Route::get('/{menu}/{prasaranaID}', [PendataanSarprasController::class, 'pendataan'])->name('pendataanSarpras.pendataan.pjs');

        Route::post('/{menu}/store', [PendataanSarprasController::class, 'store'])->name('pendataanSarpras.store');
        Route::put('/{menu}/update/{id}', [PendataanSarprasController::class, 'update'])->name('pendataanSarpras.update');
        Route::delete('/{menu}/delete/{id}', [PendataanSarprasController::class, 'destroy'])->name('pendataanSarpras.destroy');
    });
});
