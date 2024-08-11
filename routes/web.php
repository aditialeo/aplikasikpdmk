<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\RiwayatTransaksiBarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\SuplairController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/user',UserController::class);
    Route::resource('/suplair',SuplairController::class);
    Route::resource('/satuanbarang',SatuanBarangController::class);
    Route::resource('/merk',MerkController::class);
    Route::resource('/jenisbarang',JenisBarangController::class);
    Route::resource('/barangmasuk',BarangMasukController::class);
    Route::resource('/barang',BarangController::class);
    Route::resource('/riwayattransaksibarang',RiwayatTransaksiBarangController::class);
    Route::resource('/barangkeluar',BarangKeluarController::class);

});

Auth::routes();
