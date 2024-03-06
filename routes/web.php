<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BerandaOperatorController;
use App\Http\Controllers\BerandaPeminjamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;

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


Auth::routes();

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::resource('user', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
});

Route::prefix('operator')->middleware(['auth', 'auth.operator'])->group(function () {
    Route::get('beranda', [BerandaOperatorController::class, 'index'])->name('operator.beranda');
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
});

Route::prefix('peminjam')->middleware(['auth', 'auth.peminjam'])->group(function () {
    Route::get('beranda', [BerandaPeminjamController::class, 'index'])->name('peminjam.beranda');
    Route::resource('buku', BukuController::class);
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


