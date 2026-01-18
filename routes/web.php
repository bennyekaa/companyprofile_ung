<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\KategoriController;
use App\Http\Controllers\Backend\KelompokController;
use App\Http\Controllers\Backend\KontenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\PenggunaController;
use App\Http\Controllers\Backend\RoleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);

Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/tentang', [FrontendController::class, 'tentang']);
    Route::get('/visimisi', [FrontendController::class, 'visimisi']);
});

Route::prefix('formasi')->name('formasi.')->group(function () {
    Route::get('/pejabat', [FrontendController::class, 'pejabat']);
    Route::get('/dosen', [FrontendController::class, 'dosen']);
    Route::get('/pegawai', [FrontendController::class, 'pegawai']);
});

Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/galeri', [FrontendController::class, 'galeri']);
});

Route::get('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
Route::post('actionlogin', [AuthController::class, 'actionlogin']);

Route::middleware('checklogin')->group(function () {
    Route::get('admin', [AdminController::class, 'index']);
    Route::prefix('master')->group(function () {
        Route::prefix('berkas')->group(function () {
            Route::get('index', [KategoriController::class, 'index']);
        });
        Route::prefix('kategori')->group(function () {
            Route::get('index', [KategoriController::class, 'index']);
            Route::get('tambah', [KategoriController::class, 'tambah']);
            Route::post('action', [KategoriController::class, 'action']);
            Route::get('edit/{id}', [KategoriController::class, 'edit']);
            Route::get('hapus/{id}', [KategoriController::class, 'hapus']);
            Route::get('status/{id}/{stat}', [KategoriController::class, 'status']);
        });
        Route::prefix('kelompok')->group(function () {
            Route::get('index', [KelompokController::class, 'index']);
            Route::get('tambah', [KelompokController::class, 'tambah']);
            Route::post('action', [KelompokController::class, 'action']);
            Route::get('edit/{id}', [KelompokController::class, 'edit']);
            Route::get('hapus/{id}', [KelompokController::class, 'hapus']);
            Route::get('status/{id}/{stat}', [KelompokController::class, 'status']);
        });
        Route::prefix('konten')->group(function () {
            Route::get('index', [KontenController::class, 'index']);
            Route::get('tambah', [KontenController::class, 'tambah']);
            Route::get('edit/{id}', [KontenController::class, 'edit']);
            Route::post('action', [KontenController::class, 'action']);
            Route::get('hapus/{id}', [KontenController::class, 'hapus']);
            Route::get('status/{id}/{stat}', [KontenController::class, 'status']);
        });
        Route::prefix('pengguna')->group(function () {
            Route::get('index', [PenggunaController::class, 'index']);
            Route::get('tambah', [PenggunaController::class, 'tambah']);
            Route::post('action', [PenggunaController::class, 'action']);
            Route::get('edit/{id}', [PenggunaController::class, 'edit']);
            Route::get('hapus/{id}', [PenggunaController::class, 'hapus']);
            Route::get('status/{id}/{stat}', [PenggunaController::class, 'status']);
        });
        Route::prefix('role')->group(function () {
            Route::get('index', [RoleController::class, 'index']);
            Route::get('tambah', [RoleController::class, 'tambah']);
            Route::post('action', [RoleController::class, 'action']);
            Route::get('edit/{id}', [RoleController::class, 'edit']);
            Route::get('hapus/{id}', [RoleController::class, 'hapus']);
            Route::get('status/{id}/{stat}', [RoleController::class, 'status']);
        });
    });
});
