<?php

use App\Http\Controllers\Monev\MonevController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'monev-sarpras'], function () {
    Route::middleware('rolecheck:ADM|LPM|')->group(function () {
        Route::get('/', [MonevController::class, 'index'])->name('monev.index');
    });
});
