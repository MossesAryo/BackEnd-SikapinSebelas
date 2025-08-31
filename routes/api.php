<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\Aspek_penilaianController;
use App\Http\Controllers\SuratPeringatanController;

Route::get('/kelas', [KelasController::class, 'FetchApi'])->name('api.kelas');
Route::get('/aspekpenilaian', [Aspek_penilaianController::class, 'FetchApi'])->name('api.aspek');
Route::get('/Penghargaan', [PenghargaanController::class, 'FetchApi'])->name('api.penghargaan');
Route::get('/peringatan', [SuratPeringatanController::class, 'FetchApi'])->name('api.peringatan');
Route::get('/siswa', [SiswaController::class, 'FetchApi'])->name('api.siswa');


