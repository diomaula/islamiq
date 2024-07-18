<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\LatsolController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\ReportController;
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

        
        // Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');
        // Route::get('materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        // Route::put('materi/{id}', [MateriController::class, 'update'])->name('materi.update');
        // Route::delete('materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

        Route::get('/guru/latsol', [LatsolController::class, 'latsol'])->name('latsol');
        Route::get('/tambahLatsol', [LatsolController::class, 'tambahLatsol'])->name('indexLatsol');
        Route::post('/tambahLatsol', [LatsolController::class, 'create'])->name('tambahLatsol');
        Route::get('/showLatsol/{id_latihan}', [LatsolController::class, 'show'])->name('showLatsol');
        Route::get('/editLatsol/{id_latihan}', [LatsolController::class, 'edit'])->name('editLatsol');
        Route::put('/editLatsol/{id_latihan}', [LatsolController::class, 'update'])->name('updateLatsol');
        Route::delete('/hapusLatsol/{id_latihan}', [LatsolController::class, 'destroy'])->name('hapusLatsol');
    });

    Route::middleware(['siswa'])->group(function () {
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