<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenilaianController;

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');
Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');



 
