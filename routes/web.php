<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\WalikelasController;

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');
Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}/update', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}/destroy', [KelasController::class, 'destroy'])->name('kelas.destroy');


 
Route::get('/walikelas', [WalikelasController::class, 'index'])->name('walikelas.index');
Route::get('/walikelas/create', [WalikelasController::class, 'create'])->name('walikelas.create');
Route::post('/walikelas/store', [WalikelasController::class, 'store'])->name('walikelas.store');
Route::put('/walikelas/{nip_walikelas}/update', [WalikelasController::class, 'update'])->name('walikelas.update');
Route::delete('/walikelas/{nip_walikelas}', [WalikelasController::class, 'destroy'])->name('walikelas.destroy');

