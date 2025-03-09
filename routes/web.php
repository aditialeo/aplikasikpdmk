<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SuplairController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TitipBarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\RiwayatTransaksiBarangController;

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
    Route::post('user/addRole', [UserController::class, 'addRole'])->name('user.addRole');
    Route::resource('/user', UserController::class);
    Route::resource('/suplair', SuplairController::class);
    Route::resource('/satuanbarang', SatuanBarangController::class);
    Route::resource('/merk', MerkController::class);
    Route::resource('/jenisbarang', JenisBarangController::class);
    Route::resource('/barangmasuk', BarangMasukController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/riwayattransaksibarang', RiwayatTransaksiBarangController::class);
    Route::resource('/barangkeluar', BarangKeluarController::class);
    Route::resource('/titip-barang', TitipBarangController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
});

Auth::routes();
