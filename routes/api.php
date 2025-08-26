<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\Aspek_penilaianController;

Route::get('/kelas', [KelasController::class, 'FetchApi'])->name('api.kelas');
Route::get('/aspekpenilaian', [Aspek_penilaianController::class, 'FetchApi'])->name('api.aspek');
