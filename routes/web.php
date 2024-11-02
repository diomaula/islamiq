<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\LatsolController;
use App\Http\Controllers\MateriController;
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

// Route::get('/latsol', [LatsolController::class, 'latsol'])->name('latsol');
// Route::post('/latsol/create', [LatsolController::class, 'create'])->name('latsol.create');
// Route::get('/latsol/{id_tugas}', [LatsolController::class, 'show'])->name('latsol.show');
// Route::post('/latsol/{id_latihan}/update', [LatsolController::class, 'update'])->name('latsol.update');
// Route::delete('/latsol/{id_latihan}', [LatsolController::class, 'destroy'])->name('latsol.destroy');
// Route::post('/latsol/{id_tugas}/submit', [LatsolController::class, 'submit'])->name('latsol.submit');

// Route::get('/exam/{number}', [ExamController::class, 'showQuestion'])->name('exam.question');
// Route::post('/exam/submit', [ExamController::class, 'submitAnswer'])->name('exam.submitAnswer');
// Route::post('/exam/end', [ExamController::class, 'endExam'])->name('exam.endExam');

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('dashboardadmin');
        Route::post('/admin/users-upload', [UserController::class, 'upload'])->name('users.upload');
        Route::resource('/admin/user', UserController::class);
        // Route::get('/chart-akses', [MateriController::class, 'getAccessData'])->name('chart.akses');
        
    });

    Route::middleware(['kepsek'])->group(function () {
        Route::get('/dashboard-kepsek', [DashboardController::class,'indexKepsek'])->name('dashboardkepsek');
        Route::get('/kepsek/materi', [MateriController::class, 'indexKepsek'])->name('kepsek.materi.index');
        Route::get('/kepsek/materi/{id}', [MateriController::class, 'showKepsek'])->name('kepsek.materidetail');

    });

    Route::middleware(['guru'])->group(function () {
        Route::get('/guru/dashboard', [DashboardController::class, 'guruIndex'])->name('dashboardguru');
        Route::resource('/guru/materi', MateriController::class);
        Route::get('/guru/materi', [MateriController::class,'indexGuru'])->name('materiguru');
        Route::get('/chart-akses', [MateriController::class, 'getAccessData'])->name('chart.akses');

        
        // Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');
        // Route::get('materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        // Route::put('materi/{id}', [MateriController::class, 'update'])->name('materi.update');
        // Route::delete('materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

        // Route::get('/guru/latsol', [LatsolController::class, 'latsol'])->name('latsol');
        // Route::get('/tambahLatsol', [LatsolController::class, 'tambahLatsol'])->name('indexLatsol');
        // Route::get('/showLatsol/{id_latihan}', [LatsolController::class, 'show'])->name('showLatsol');
        // Route::get('/editLatsol/{id_latihan}', [LatsolController::class, 'edit'])->name('editLatsol');
        // Route::put('/editLatsol/{id_latihan}', [LatsolController::class, 'update'])->name('updateLatsol');
        // Route::delete('/hapusLatsol/{id_latihan}', [LatsolController::class, 'destroy'])->name('hapusLatsol');
        
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
        // Route::get('/siswa/latsol', [LatsolController::class, 'indexSiswa'])->name('siswa.latsol.index');
        Route::get('/siswa/latihan', [LatsolController::class, 'index'])->name('siswa.latsol.index');  // Halaman daftar latihan
        // Route::post('/quiz/submit/{id_tugas}', [LatsolController::class, 'submit'])->name('submit.quiz');
        Route::post('/siswa/latihan/{id_tugas}/submit', [LatsolController::class, 'submit']);
        Route::get('/siswa/latihan/{id_tugas}', [LatsolController::class, 'showSoal'])->name('siswa.latsol.show');


    });

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