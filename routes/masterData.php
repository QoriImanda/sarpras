<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterData\DosenController;
use App\Http\Controllers\MasterData\FakultasController;
use App\Http\Controllers\MasterData\ProdiController;
use App\Http\Controllers\MasterData\MahasiswaController;
use App\Http\Controllers\Ruangan\RuanganController;

Route::group(['prefix' => 'master-data'], function () {

    Route::middleware('rolecheck:ADM')->group(function () {
        Route::get('/dosen/index', [DosenController::class, 'index'])->name('masterDataDosen.index');
        Route::get('/mahasiswa/index', [MahasiswaController::class, 'index'])->name('masterDataMahasiswa.index');

        Route::get('/prodi/index', [ProdiController::class, 'index'])->name('masterDataProdi.index');
        Route::post('/prodi/updateKaprodi/{id}', [ProdiController::class, 'updateKaprodi'])->name('masterDataProdi.updateKaprodi');

        Route::get('/fakultas/index', [FakultasController::class, 'index'])->name('masterDataFakultas.index');
        Route::post('/fakultas/updateDekan/{id}', [FakultasController::class, 'updateDekan'])->name('masterDataFakultas.updateDekan');
    });

    Route::get('/ruangan/index', [RuanganController::class, 'index'])->name('masterDataRuangan.index');
});
