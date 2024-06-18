<?php

use App\Http\Controllers\PJSarpras\PJSController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'penanggung-jawab-sarpras'], function () {
    Route::middleware('rolecheck:ADM')->group(function () {
        Route::get('/', [PJSController::class, 'index'])->name('pjsarpras.index');
        Route::post('/post/{saprasID}', [PJSController::class, 'post'])->name('pjsarpras.post');
        
    });
});