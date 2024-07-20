<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FotoAssetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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

Route::get('', function () {
    return redirect()->route('login');
});

Route::prefix('/auth')->middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/pages/aset', [AssetController::class, 'index'])->name('aset.index');
    Route::resource('pages/aset', AssetController::class)->except(['show']);


    Route::get('/pages/foto_asset/{id}', [FotoAssetController::class, 'show'])->name('foto_asset.show');
    Route::get('/pages/aset/foto_asset', [FotoAssetController::class, 'index'])->name('foto_asset.index');
    Route::resource('pages/foto_asset', FotoAssetController::class)->except(['show']);

    Route::get('/pages/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::resource('pages/kategori', KategoriController::class)->except(['show']);

    Route::resource('/pages/laporan', LaporanController::class);

    Route::get('/pages/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/{id}/approve', [TransaksiController::class, 'approve'])->name('transaksi.approve');
    Route::post('/transaksi/{id}/decline', [TransaksiController::class, 'decline'])->name('transaksi.decline');

    Route::get('/pages/user', [UserController::class, 'index'])->name('user.index');
    Route::resource('pages/user', UserController::class)->except(['show']);
});
