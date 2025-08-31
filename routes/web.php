<?php

use App\Http\Controllers\Aspek_penilaianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru_bkController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\WalikelasController;
use App\Http\Controllers\KetuaProgramController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Skoring_PenghargaanController;
use App\Http\Controllers\Skoring_PelanggaranController;
use App\Http\Controllers\SuratPeringatanController;
use Illuminate\Routing\RouteUri;

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
Route::get('wakasek/profile', [ProfileController::class, 'index'])->name('wakasek.profile.profilewakasek');
Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');

Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');
Route::get('/gurubk/siswa', [SiswaController::class, 'siswaGuruBk'])->name('gurubk.siswa');


Route::get('/kaprog', [KetuaProgramController::class, 'index'])->name('kaprog.index');
Route::post('/kaprog/store', [KetuaProgramController::class, 'store'])->name('kaprog.store');
Route::get('/kaprog/edit/{id}', [KetuaProgramController::class, 'edit'])->name('kaprog.edit');
Route::put('/kaprog/{nip_kaprog}/{username}/update', [KetuaProgramController::class, 'update'])->name('kaprog.update');
Route::delete('/kaprog/{nip_kaprog}', [KetuaProgramController::class, 'destroy'])->name('kaprog.destroy');

Route::get('/ketua_program/export_pdf', [KetuaProgramController::class, 'export_pdf'])->name('ketua_program.export.pdf');
Route::get('/ketua_program/export_excel', [KetuaProgramController::class, 'export_excel'])->name('ketua_program.export.excel');
Route::post('/ketua_program/import', [KetuaProgramController::class, 'import'])->name('ketua_program.import');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
Route::put('/siswa/{nis}/update', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{nis}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

Route::get('/siswa/export_pdf', [SiswaController::class, 'export_pdf'])->name('siswa.export.pdf');
Route::get('/siswa/export_excel', [SiswaController::class, 'export_excel'])->name('siswa.export.excel');
Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::put('/kelas/{id}/update', [KelasController::class, 'update'])->name('kelas.update');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');


Route::get('/grbk', [Guru_bkController::class, 'index'])->name('gurubk.index');
Route::post('/gurubk/store', [Guru_bkController::class, 'store'])->name('gurubk.store');
Route::put('/gurubk/{nip}/update', [Guru_bkController::class, 'update'])->name('gurubk.update');
Route::delete('/gurubk/{nip}/destroy', [Guru_bkController::class, 'destroy'])->name('gurubk.destroy');

Route::get('/guru_bk/export_pdf', [Guru_bkController::class, 'export_pdf'])->name('guru_bk.export.pdf');
Route::get('/guru_bk/export_excel', [Guru_bkController::class, 'export_excel'])->name('guru_bk.export.excel');
Route::post('/guru_bk/import', [Guru_bkController::class, 'import'])->name('guru_bk.import');

Route::get('/walikelas', [WalikelasController::class, 'index'])->name('walikelas.index');
Route::post('/walikelas/store', [WalikelasController::class, 'store'])->name('walikelas.store');
Route::put('/walikelas/{nip_walikelas}/{username}/update', [WalikelasController::class, 'update'])->name('walikelas.update');
Route::delete('/walikelas/{nip_walikelas}', [WalikelasController::class, 'destroy'])->name('walikelas.destroy');

Route::get('/walikelas/export_pdf', [WalikelasController::class, 'export_pdf'])->name('walikelas.export.pdf');
Route::get('/walikelas/export_excel', [WalikelasController::class, 'export_excel'])->name('walikelas.export.excel');
Route::post('/walikelas/import', [WalikelasController::class, 'import'])->name('walikelas.import');

Route::get('/penghargaan', [PenghargaanController::class, 'index'])->name('penghargaan.index');
Route::post('/penghargaan/store', [PenghargaanController::class, 'store'])->name('penghargaan.store');
Route::put('/penghargaan/{id_penghargaan}/update', [PenghargaanController::class, 'update'])->name('penghargaan.update');
Route::delete('/penghargaan/{id}', [PenghargaanController::class, 'destroy'])->name('penghargaan.destroy');

Route::get('/penghargaan/export_pdf', [PenghargaanController::class, 'export_pdf'])->name('penghargaan.export.pdf');
Route::get('/penghargaan/export_excel', [PenghargaanController::class, 'export_excel'])->name('penghargaan.export.excel');
Route::post('/penghargaan/import', [PenghargaanController::class, 'import'])->name('penghargaan.import');

Route::get('/peringatan', [SuratPeringatanController::class, 'index'])->name('peringatan.index');
Route::post('/peringatan/store', [SuratPeringatanController::class, 'store'])->name('peringatan.store');
Route::put('/peringatan/{id}/update', [SuratPeringatanController::class, 'update'])->name('peringatan.update');
Route::delete('/peringatan/{id}', [SuratPeringatanController::class, 'destroy'])->name('peringatan.destroy');

Route::get('/peringatan/export_pdf', [SuratPeringatanController::class, 'export_pdf'])->name('peringatan.export.pdf');
Route::get('/peringatan/export_excel', [SuratPeringatanController::class, 'export_excel'])->name('peringatan.export.excel');
Route::post('/peringatan/import', [SuratPeringatanController::class, 'import'])->name('peringatan.import');

Route::get('/aspekpenilaian', [Aspek_penilaianController::class, 'index'])->name('aspekpenilaian');
Route::post('/aspekpenilaian/store', [Aspek_penilaianController::class, 'store'])->name('aspekpenilaian.store');
Route::put('/aspekpenilaian/{id}/update', [Aspek_penilaianController::class, 'update'])->name('aspekpenilaian.update');
Route::delete('/aspekpenilaian/{id}/destroy', [Aspek_penilaianController::class, 'destroy'])->name('aspekpenilaian.destroy');

Route::get('/aspek_penghargaan', [Aspek_penilaianController::class, 'indexPenghargaan'])->name('aspek_penghargaan.index');
Route::post('/aspek_penghargaan/store', [Aspek_penilaianController::class, 'storePenghargaan'])->name('aspek_penghargaan.store');
Route::put('/aspek_penghargaan/{id}/update', [Aspek_penilaianController::class, 'updatePenghargaan'])->name('aspek_penghargaan.update');
Route::delete('/aspek_penghargaan/{id}/destroy', [Aspek_penilaianController::class, 'destroyPenghargaan'])->name('aspek_penghargaan.destroy');

Route::get('/aspek_penghargaan/export_pdf', [Aspek_penilaianController::class, 'export_pdf'])->name('aspek_penghargaan.export.pdf');
Route::get('/aspek_penghargaan/export_excel', [Aspek_penilaianController::class, 'export_excel'])->name('aspek_penghargaan.export.excel');
Route::post('/import', [Aspek_penilaianController::class, 'import'])->name('aspek_penghargaan.import');

Route::get('/aspek_pelanggaran', [Aspek_penilaianController::class, 'indexPelanggaran'])->name('aspek_pelanggaran.index');
Route::post('/aspek_pelanggaran/store', [Aspek_penilaianController::class, 'storePelanggaran'])->name('aspek_pelanggaran.store');
Route::put('/aspek_pelanggaran/{id}/update', [Aspek_penilaianController::class, 'updatePelanggaran'])->name('aspek_pelanggaran.update');
Route::delete('/aspek_pelanggaran/{id}/destroy', [Aspek_penilaianController::class, 'destroyPelanggaran'])->name('aspek_pelanggaran.destroy');

Route::get('/aspek_pelanggaran/export_pdf', [Aspek_penilaianController::class, 'export_pelanggaran_pdf'])->name('aspek_pelanggaran.export.pdf');
Route::get('/aspek_pelanggaran/export_excel', [Aspek_penilaianController::class, 'export_pelanggaran_excel'])->name('aspek_pelanggaran.export.excel');
Route::post('aspek_pelanggaran/import', [Aspek_penilaianController::class, 'import_pelanggaran'])->name('aspek_pelanggaran.import');

Route::get('/skoring_penghargaan', [Skoring_PenghargaanController::class, 'index'])->name('skoring_penghargaan.index');
Route::post('/skoring_penghargaan/store', [Skoring_PenghargaanController::class, 'store'])->name('skoring_penghargaan.store');
Route::put('/skoring_penghargaan/{id}/update', [Skoring_PenghargaanController::class, 'update'])->name('skoring_penghargaan.update');
Route::delete('/skoring_penghargaan/{id}/destroy', [Skoring_PenghargaanController::class, 'destroy'])->name('skoring_penghargaan.destroy');

Route::get('/skoring_pelanggaran', [Skoring_PelanggaranController::class, 'index'])->name('skoring_pelanggaran.index');
Route::post('/skoring_pelanggaran/store', [Skoring_PelanggaranController::class, 'store'])->name('skoring_pelanggaran.store');
Route::put('/skoring_pelanggaran/{id}/update', [Skoring_PelanggaranController::class, 'update'])->name('skoring_pelanggaran.update');
Route::delete('/skoring_pelanggaran/{id}/destroy', [Skoring_PelanggaranController::class, 'destroy'])->name('skoring_pelanggaran.destroy');
