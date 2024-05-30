<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LatsolController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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

// BAGIAN MATERI
Route::resource('materi', MateriController::class);
Route::get('/materi', [MateriController::class,'index'])->name('materiguru');
Route::get('materi/{id}', [MateriController::class, 'show'])->name('materi.show');
Route::get('materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
Route::put('materi/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

// BAGIAN LATSOL
Route::get('/latsol', [LatsolController::class, 'latsol'])->name('latsol');
Route::get('/tambahLatsol', [LatsolController::class, 'tambahLatsol'])->name('indexLatsol');
Route::post('/tambahLatsol', [LatsolController::class, 'create'])->name('tambahLatsol');
Route::get('/showLatsol/{id_latihan}', [LatsolController::class, 'show'])->name('showLatsol');
Route::get('/editLatsol/{id_latihan}', [LatsolController::class, 'edit'])->name('editLatsol');
Route::put('/editLatsol/{id_latihan}', [LatsolController::class, 'update'])->name('updateLatsol');
Route::delete('/hapusLatsol/{id_latihan}', [LatsolController::class, 'destroy'])->name('hapusLatsol');

Route::middleware(['auth'])->group(function () {
    //BAGIAN DASHBOARD ADMIN
    Route::get('/dashboard-admin', [DashboardController::class,'index'])->name('dashboardadmin');
    Route::get('/dashboard-kepsek', [DashboardController::class,'indexKepsek'])->name('dashboardkepsek');
    Route::get('/generate-user-pdf/{role}', [ReportController::class, 'generateUserListPDF'])->name('generateUserListPDF');
    // Route::get('/generate-user-list-pdf', [ReportController::class, 'generateUserListPDF'])->name('generateUserListPDF');
    
    //BAGIAN USER ADMIN
    Route::get('/user-admin', [UserController::class,'index'])->name('useradmin');
    Route::resource('user', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('admin.user');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users-upload', [UserController::class, 'upload'])->name('users.upload');    
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{ni}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{ni}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{ni}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{ni}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    
    // BAGIAN PROFIL GURU
    Route::get('/profil', [ProfileController::class, 'profil'])->name('viewProfil');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::delete('/delete-image', [ProfileController::class, 'deleteImage'])->name('deleteImage');
    Route::get('/password', [AuthController::class, 'updatePass'])->name('pass');
    Route::put('/ubah-password', [AuthController::class, 'ubahPassword'])->name('password');
    
    
    
    //BAGIAN LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});