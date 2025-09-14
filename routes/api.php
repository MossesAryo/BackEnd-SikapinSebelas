<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\catatanController;
use App\Http\Controllers\AkumulasiContoller;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\api\SkoringPelanggaran;
use App\Http\Controllers\api\SkoringPenghargaan;
use App\Http\Controllers\Aspek_penilaianController;
use App\Http\Controllers\AuthAPI\AuthAPIcontroller;
use App\Http\Controllers\SuratPeringatanController;


Route::get('/kelas', [KelasController::class, 'FetchApi'])->name('api.kelas');
Route::get('/aspekpenilaian', [Aspek_penilaianController::class, 'FetchApi'])->name('api.aspek');
Route::get('/Penghargaan', [PenghargaanController::class, 'FetchApi'])->name('api.penghargaan');
Route::get('/peringatan', [SuratPeringatanController::class, 'FetchApi'])->name('api.peringatan');
Route::get('/siswa', [SiswaController::class, 'FetchApi'])->name('api.siswa');
Route::get('/skoring_penghargaan', [SkoringPenghargaan::class, 'index']);
Route::get('/skoring_pelanggaran', [SkoringPelanggaran::class, 'index']);
Route::get('/akumulasi', [AkumulasiContoller::class, 'fetchAPI']);
Route::post('/skoring_penghargaan', [SkoringPenghargaan::class, 'store']);
Route::post('/skoring_pelanggaran', [SkoringPelanggaran::class, 'store']);
Route::post('/AddCatatan', [catatanController::class, 'AddCatatanAPI']);
Route::post('/login', [AuthAPIcontroller::class, 'login']);
Route::post('/logout', [AuthAPIcontroller::class, 'logout']);
