<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('get/nama-barang',[BarangMasukController::class,'getNamaBarang'])->name('api.get.nama_barang');
Route::post('get/produk-barang',[BarangKeluarController::class,'getNamaBarang'])->name('api.get.produk_barang');

