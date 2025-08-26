<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

Route::get('/kelas', [KelasController::class, 'FetchApi'])->name('api.kelas');
