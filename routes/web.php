<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru_bkController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\WalikelasController;
use App\Http\Controllers\KetuaProgramController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratPeringatanController;

Route::get('/', fn() => redirect('/wakasek'));

// Route::get('/siswa/dashboard', function () {
//     return view('wakasek.siswa.dashboard');
// });
Route::get('/siswa/create', function () {
    return view('wakasek.siswa.create');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
Route::get('/profile', [ProfileController::class, 'index'])->name('auth.profile');
Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');
Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');


Route::get('/kaprog', [KetuaProgramController::class, 'index'])->name('kaprog.index');
Route::post('/kaprog/store', [KetuaProgramController::class, 'store'])->name('kaprog.store');
Route::get('/kaprog/edit/{id}', [KetuaProgramController::class, 'edit'])->name('kaprog.edit');
Route::put('/kaprog/{nip_kaprog}/{username}/update', [KetuaProgramController::class, 'update'])->name('kaprog.update');
Route::delete('/kaprog/{nip_kaprog}', [KetuaProgramController::class, 'destroy'])->name('kaprog.destroy');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::put('/siswa/{nis}/update', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');


Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}/update', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

Route::get('/gurubk', [Guru_bkController::class, 'index'])->name('gurubk.index');
Route::post('/gurubk/store', [Guru_bkController::class, 'store'])->name('gurubk.store');
Route::put('/gurubk/{nip}/update', [Guru_bkController::class, 'update'])->name('gurubk.update');
Route::delete('/gurubk/{nip}', [Guru_bkController::class, 'destroy'])->name('gurubk.destroy');


 
Route::get('/walikelas', [WalikelasController::class, 'index'])->name('walikelas.index');
Route::post('/walikelas/store', [WalikelasController::class, 'store'])->name('walikelas.store');
Route::put('/walikelas/{nip_walikelas}/{username}/update', [WalikelasController::class, 'update'])->name('walikelas.update');
Route::delete('/walikelas/{nip_walikelas}', [WalikelasController::class, 'destroy'])->name('walikelas.destroy');


Route::get('/penghargaan', [PenghargaanController::class, 'index'])->name('penghargaan.index');
Route::post('/penghargaan/store', [PenghargaanController::class, 'store'])->name('penghargaan.store');
Route::put('/penghargaan/{id}/update', [PenghargaanController::class, 'update'])->name('penghargaan.update');
Route::delete('/penghargaan/{id}', [PenghargaanController::class, 'destroy'])->name('penghargaan.destroy');

Route::get('/peringatan', [SuratPeringatanController::class, 'index'])->name('peringatan.index');
Route::post('/peringatan/store', [SuratPeringatanController::class, 'store'])->name('peringatan.store');
Route::put('/peringatan/{id}/update', [SuratPeringatanController::class, 'update'])->name('peringatan.update');
Route::delete('/peringatan/{id}', [SuratPeringatanController::class, 'destroy'])->name('peringatan.destroy');
