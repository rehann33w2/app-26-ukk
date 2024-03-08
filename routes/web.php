<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
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
Route::middleware('auth')->group(function(){
    Route::get('beranda', [BerandaAdminController::class, 'index'])->middleware('userAcces:admin,operator')->name('admin.beranda');
    Route::middleware('userAcces:admin,operator')->group(function (){
        Route::resource('kategori', KategoriController::class);
        Route::resource('buku', BukuController::class);
    });
    Route::middleware('userAcces:admin')->group(function (){
        Route::resource('user', UserController::class);
    });
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


