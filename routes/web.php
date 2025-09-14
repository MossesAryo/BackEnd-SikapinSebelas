<?php

use App\Models\catatan;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\catatanController;
use App\Http\Controllers\Guru_bkController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaBKController;
use App\Http\Controllers\AkumulasiContoller;
use App\Http\Controllers\AkumulasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\WalikelasController;
use App\Http\Controllers\IntervensiController;
use App\Http\Controllers\DashboardBKController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\KetuaProgramController;
use App\Http\Controllers\NotifikasiBKController;
use App\Http\Controllers\Aspek_penilaianController;
use App\Http\Controllers\SuratPeringatanController;
use App\Http\Controllers\Skoring_PelanggaranController;
use App\Http\Controllers\Skoring_PenghargaanController;
use App\Http\Controllers\Skoring_PelanggaranBKController;
use App\Http\Controllers\Skoring_PenghargaanBKController;
use App\Http\Controllers\Auth\AuthController as AController;

Route::get('/', [AController::class, 'index'])->name('login');
Route::post('/login', [AController::class, 'login'])->name('login.submit');
Route::get('/logout', [AController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::middleware('UserAccess:1')->group(function () {

    Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
    Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
    Route::get('/profile', [ProfileController::class, 'index'])->name('auth.profile');

    Route::get('wakasek/profile', [ProfileController::class, 'index'])->name('wakasek.profile.profilewakasek');
    Route::get('/wakasek', fn() => view('wakasek.dashboard'))->name('wakasek.dashboard');

    Route::get('/wakasek', [DashboardController::class, 'index'])->name('wakasek.dashboard');

 

    Route::get('/wakasek/laporanjammalam', [LaporanController::class, 'index'])->name('wakasek.laporanjammalam');
    Route::get('/wakasek/penilaian', [PenilaianController::class, 'index'])->name('wakasek.penilaian');
    Route::get('/profile', [ProfileController::class, 'index'])->name('auth.profile');
    Route::get('/gurubk', fn() => view('gurubk.dashboard'))->name('gurubk.dashboard');


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
    Route::delete('/siswa/{nis}/penghargaan/{id}', [SiswaController::class, 'destroyPenghargaan'])->name('siswa.penghargaan.destroy');
    Route::delete('/siswa/{nis}/peringatan/{id}', [SiswaController::class, 'destroyPeringatan'])->name('siswa.peringatan.destroy');
    Route::get('/siswa/{nis}/show', [SiswaController::class, 'show'])->name('siswa.show');
    Route::post('/siswa/{nis}/show/penghargaan', [SiswaController::class, 'penghargaan'])->name('siswa.penghargaan');
    Route::post('/siswa/{nis}/show/peringatan', [SiswaController::class, 'peringatan'])->name('siswa.peringatan');
    Route::post('/siswa/{nis}/show/catatan', [catatanController::class, 'AddCatatan'])->name('siswa.catatan');

    Route::get('/siswa/export_pdf', [SiswaController::class, 'export_pdf'])->name('siswa.export.pdf');
    Route::get('/siswa/export_excel', [SiswaController::class, 'export_excel'])->name('siswa.export.excel');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

    Route::get('/wakasek/jurusan', [KelasController::class, 'jurusanwakasek'])->name('wakasek.jurusan');
    Route::get('/wakasek/kelas', [KelasController::class, 'kelaswakasek'])->name('wakasek.kelas');

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
    Route::get('/gurubk', [Guru_bkController::class, 'index'])->name('gurubk.index');
    Route::post('/gurubk/store', [Guru_bkController::class, 'store'])->name('gurubk.store');
    Route::put('/gurubk/{nip}/update', [Guru_bkController::class, 'update'])->name('gurubk.update');
    Route::delete('/gurubk/{nip}/destroy', [Guru_bkController::class, 'destroy'])->name('gurubk.destroy');

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

    Route::get('/skoring_penghargaan/export_pdf', [Skoring_PenghargaanController::class, 'export_pdf'])->name('skoring_penghargaan.export.pdf');
    Route::get('/skoring_penghargaan/export', [Skoring_PenghargaanController::class, 'export_excel'])->name('skoring_penghargaan.export.excel');

    Route::get('/skoring_pelanggaran', [Skoring_PelanggaranController::class, 'index'])->name('skoring_pelanggaran.index');
    Route::post('/skoring_pelanggaran/store', [Skoring_PelanggaranController::class, 'store'])->name('skoring_pelanggaran.store');
    Route::put('/skoring_pelanggaran/{id}/update', [Skoring_PelanggaranController::class, 'update'])->name('skoring_pelanggaran.update');
    Route::delete('/skoring_pelanggaran/{id}/destroy', [Skoring_PelanggaranController::class, 'destroy'])->name('skoring_pelanggaran.destroy');
    Route::get('/akumulasi', [AkumulasiContoller::class, 'index'])->name('akumulasi.index');
    Route::get('/akumulasi/export_pdf', [AkumulasiContoller::class, 'export_pdf'])->name('akumulasi.export.pdf');
    Route::get('/akumulasi/export_excel', [AkumulasiContoller::class, 'export_excel'])->name('akumulasi.export.excel');
});










Route::middleware('UserAccess:2')->group(function () {
    Route::get('/gurubk', [DashboardBKController::class, 'index'])->name('gurubk.dashboard');
    Route::get('gurubk/profile', [ProfileController::class, 'indexbk'])->name('gurubk.profile');
    Route::get('/gurubk/siswa', [SiswaBKController::class, 'siswaGuruBk'])->name('gurubk.siswa');
    Route::get('/gurubk/siswa/{nis}/show', [SiswaBKController::class, 'showBK'])->name('gurubk.siswa.show');
    Route::get('/siswaBK/export_pdf', [SiswaBKController::class, 'export_pdf'])->name('siswa.export.pdf');
    Route::get('/siswaBK/export_excel', [SiswaBKController::class, 'export_excel_siswaBK'])->name('siswa.export.excel');
    Route::post('/siswaBK/import', [SiswaBKController::class, 'import_siswaBK'])->name('siswa.import');

    Route::get('/gurubk/jurusan', [KelasController::class, 'jurusanbk'])->name('gurubk.jurusan');
    Route::get('/gurubk/kelas', [KelasController::class, 'kelasbk'])->name('gurubk.kelas');

    Route::get('/aspek_penghargaanbk', [Aspek_penilaianController::class, 'indexPenghargaanBK'])->name('aspek_penghargaanBK.index');
    Route::post('/aspek_penghargaanbk/store', [Aspek_penilaianController::class, 'storePenghargaanBK'])->name('aspek_penghargaanBK.store');
    Route::put('/aspek_penghargaanbk/{id}/update', [Aspek_penilaianController::class, 'updatePenghargaanBK'])->name('aspek_penghargaanBK.update');
    Route::delete('/aspek_penghargaanbk/{id}/destroy', [Aspek_penilaianController::class, 'destroyPenghargaanBK'])->name('aspek_penghargaanBK.destroy');

    Route::get('/aspek_pelanggaranbk', [Aspek_penilaianController::class, 'indexPelanggaranBK'])->name('aspek_pelanggaranBK.index');
    Route::post('/aspek_pelanggaranbk/store', [Aspek_penilaianController::class, 'storePelanggaranBK'])->name('aspek_pelanggaranBK.store');
    Route::put('/aspek_pelanggaranbk/{id}/update', [Aspek_penilaianController::class, 'updatePelanggaranBK'])->name('aspek_pelanggaranBK.update');
    Route::delete('/aspek_pelanggaranbk/{id}/destroy', [Aspek_penilaianController::class, 'destroyPelanggaranBK'])->name('aspek_pelanggaranBK.destroy');

    Route::get('/penghargaanbk', [PenghargaanController::class, 'indexBK'])->name('penghargaanbk.index');
    Route::post('/penghargaanbk/store', [PenghargaanController::class, 'storeBK'])->name('penghargaanbk.store');
    Route::put('/penghargaanbk/{id_penghargaan}/update', [PenghargaanController::class, 'updateBK'])->name('penghargaanbk.update');
    Route::delete('/penghargaanbk/{id}/destroy', [PenghargaanController::class, 'destroyBK'])->name('penghargaanbk.destroy');

    Route::get('/peringatanbk', [SuratPeringatanController::class, 'indexBK'])->name('peringatanbk.index');
    Route::post('/peringatanbk/store', [SuratPeringatanController::class, 'storeBK'])->name('peringatanbk.store');
    Route::put('/peringatanbk/{id}/update', [SuratPeringatanController::class, 'updateBK'])->name('peringatanbk.update');
    Route::delete('/peringatanbk/{id}', [SuratPeringatanController::class, 'destroyBK'])->name('peringatanbk.destroy');

    Route::get('/skoring_penghargaanBK', [Skoring_PenghargaanBKController::class, 'index'])->name('skoring_penghargaanBK.index');
    Route::post('/skoring_penghargaanBK/store', [Skoring_PenghargaanBKController::class, 'store'])->name('skoring_penghargaanBK.store');
    Route::put('/skoring_penghargaanBK/{id}/update', [Skoring_PenghargaanBKController::class, 'update'])->name('skoring_penghargaanBK.update');
    Route::delete('/skoring_penghargaanBK/{id}/destroy', [Skoring_PenghargaanBKController::class, 'destroy'])->name('skoring_penghargaanBK.destroy');

    Route::get('/skoring_penghargaanBK/export_pdf', [Skoring_PenghargaanBKController::class, 'export_pdf'])->name('skoring_penghargaanBK.export.pdf');
    Route::get('/skoring_penghargaanBK/export', [Skoring_PenghargaanBKController::class, 'export_excel'])->name('skoring_penghargaanBK.export.excel');

    Route::get('/skoring_pelanggaranBK', [Skoring_PelanggaranBKController::class, 'index'])->name('skoring_pelanggaranBK.index');
    Route::post('/skoring_pelanggaranBK/store', [Skoring_PelanggaranBKController::class, 'store'])->name('skoring_pelanggaranBK.store');
    Route::put('/skoring_pelanggaranBK/{id}/update', [Skoring_PelanggaranBKController::class, 'update'])->name('skoring_pelanggaranBK.update');
    Route::delete('/skoring_pelanggaranBK/{id}/destroy', [Skoring_PelanggaranBKController::class, 'destroy'])->name('skoring_pelanggaranBK.destroy');

    Route::get('/skoring_pelanggaranBK/export_pdf', [Skoring_PelanggaranBKController::class, 'export_pdf'])->name('skoring_pelanggaranBK.export.pdf');
    Route::get('/skoring_pelanggaranBK/export', [Skoring_PelanggaranBKController::class, 'export_excel'])->name('skoring_pelanggaranBK.export.excel');

    Route::get('/intervensi', [IntervensiController::class, 'index'])->name('intervensi.index');
    Route::post('/intervensi/store', [IntervensiController::class, 'store'])->name('intervensi.store');
    Route::get('/intervensi/{id_intervensi}', [IntervensiController::class, 'show'])->name('intervensi.show');
    Route::put('/intervensi/{id}/update', [IntervensiController::class, 'update'])->name('intervensi.update');
    Route::delete('/intervensi/{id}/destroy', [IntervensiController::class, 'destroy'])->name('intervensi.destroy');

    Route::get('/akumulasibk', [AkumulasiContoller::class, 'indexBK'])->name('akumulasiBK');

    route::get('/notifikasibk', [NotifikasiBKController::class, 'index'])->name('notifikasibk.index');
});
});
