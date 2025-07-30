<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\KetuaProgramController;


Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');
Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');
// Ketua Program (Kaprog)
Route::get('/wakasek/kaprog/index', [KetuaProgramController::class, 'index'])->name('wakasek.kaprog.index');
Route::get('/wakasek/kaprog/create', [KetuaProgramController::class, 'create'])->name('wakasek.kaprog.create');
Route::post('/wakasek/kaprog/store', [KetuaProgramController::class, 'store'])->name('wakasek.kaprog.store');
Route::get('/wakasek/kaprog/edit/{nip_kaprog}', [KetuaProgramController::class, 'edit'])->name('wakasek.kaprog.edit');
Route::put('/wakasek/kaprog/update/{nip_kaprog}', [KetuaProgramController::class, 'update'])->name('wakasek.kaprog.update');
Route::delete('/wakasek/kaprog/delete/{id}', [KetuaProgramController::class, 'destroy'])->name('wakasek.kaprog.destroy');

 
