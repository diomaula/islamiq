<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\LatsolController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShalatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('dashboardadmin');
        Route::post('/admin/users-upload', [UserController::class, 'upload'])->name('users.upload');
        Route::resource('/admin/user', UserController::class);
        // Route::get('/chart-akses', [MateriController::class, 'getAccessData'])->name('chart.akses');
        
    });

    Route::middleware(['kepsek'])->group(function () {
        Route::get('/kepala-sekolah/dashboard', [NilaiController::class, 'dashboard'])->name('dashboardkepsek');
        Route::get('/kepala-sekolah/materi', [MateriController::class, 'indexKepsek'])->name('kepsek.materi.index');
        Route::get('/kepala-sekolah/materi/{id}', [MateriController::class, 'showKepsek'])->name('kepsek.materidetail');

    });

    Route::middleware(['guru'])->group(function () {
        // Route::get('/guru/dashboard', [DashboardController::class, 'guruIndex'])->name('dashboardguru');
        Route::get('/guru/dashboard', [NilaiController::class, 'dashboard'])->name('dashboardguru');

        // Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        // Route::get('/report/export-pdf', [ReportController::class, 'exportPdf'])->name('report.exportPdf');
        Route::resource('/guru/materi', MateriController::class);
        Route::get('/guru/materi', [MateriController::class,'indexGuru'])->name('materiguru');
        Route::get('/chart-akses', [MateriController::class, 'getAccessData'])->name('chart.akses');

        Route::get('/soal/{id}/show', [PertanyaanController::class, 'show'])->name('soal.show');
        Route::get('/soal/{id}/edit', [PertanyaanController::class, 'edit'])->name('soal.edit');
        Route::put('/soal/{id}/update', [PertanyaanController::class, 'update'])->name('soal.update');
        Route::delete('/soal/{id}/delete', [PertanyaanController::class, 'destroy'])->name('soal.destroy');
        
        Route::post('/tambahLatsol', [LatsolController::class, 'create'])->name('tambahLatsol');
        Route::get('/guru/latsol', [LatsolController::class, 'latsol'])->name('latsol');
        Route::post('/guru/latsol/create', [LatsolController::class, 'create'])->name('latsol.create');
        Route::get('/guru/latsol/{id_tugas}/manage', [LatsolController::class, 'show'])->name('latsol.manage');
        Route::post('/guru/latsol/{id_tugas}/store', [LatsolController::class, 'storeSoal'])->name('soal.store');
        Route::post('/latsol/{id_tugas}/submit', [LatsolController::class, 'submit'])->name('latsol.submit');
        // Route::get('/latihansoal/{id}/update', [LatsolController::class, 'update'])->name('latsol.edit');
        Route::delete('/latihansoal/{id}', [LatsolController::class, 'destroy'])->name('latsol.delete');

        // Route::put('/latihansoal/{id}', [LatsolController::class, 'update'])->name('updateLatsol');


    });

    Route::middleware(['siswa'])->group(function () {

        Route::get('/siswa/dashboard', [ShalatController::class, 'getWaktuShalat'])->name('dashboardsiswa');

        // BAGIAN AL-QUR'AN
        Route::get('/siswa/surat', [QuranController::class, 'getSurat'])->name('surah');
        Route::get('/siswa/surat/{nomor}', [QuranController::class, 'getSuratDetail']);

        // BAGIAN DOA DOA
        Route::get('/siswa/doa', [DoaController::class, 'getDoa'])->name('doa');
        Route::get('/siswa/doa/{judul}', [DoaController::class, 'getDoaDetail'])->name('doa.detail');
        Route::get('/siswa/doa/search', [DoaController::class, 'searchDoa'])->name('doa.search');

        // SISWA
        Route::get('/siswa/materi', [MateriController::class, 'indexSiswa'])->name('siswa.materi.index');
        Route::get('/siswa/materi/{id}', [MateriController::class, 'showSiswa'])->name('siswa.materidetail');

        //Latihan soal siswa
        Route::get('/siswa/latihan', [LatsolController::class, 'index'])->name('siswa.latsol.index'); 
        Route::post('/siswa/latihan/{id_tugas}/submit', [LatsolController::class, 'submit']);
        Route::get('/siswa/latihan/{id_tugas}', [LatsolController::class, 'showSoal'])->name('siswa.latsol.show');
        Route::get('/siswa/latihan/{id_tugas}/nilai', [LatsolController::class, 'showNilai'])->name('siswa.latsol.nilai');



    });

    Route::get('/report/filter', [NilaiController::class, 'filterReport'])->name('report.filter');
    Route::get('/report/export-pdf', [NilaiController::class, 'exportPdf'])->name('report.exportPdf');
    
    Route::get('/generate-user-pdf/{role}', [ReportController::class, 'generateUserListPDF'])->name('generateUserListPDF');
    Route::get('/cetak-users', [ReportController::class, 'cetakUsers'])->name('cetak-users');

    Route::resource('profil', ProfileController::class);
    Route::get('/profil', [ProfileController::class, 'profil'])->name('viewProfil');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete-image', [ProfileController::class, 'deleteImage'])->name('deleteImage');
    Route::put('/ubah-password', [AuthController::class, 'ubahPassword'])->name('profil.password');
    
    Route::post('/users-upload', [UserController::class, 'upload'])->name('users.upload');    
    
    //BAGIAN LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});