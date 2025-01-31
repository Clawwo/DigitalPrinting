<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

use function PHPUnit\Framework\returnSelf;

Route::get('/', [HomeController::class, 'index']);
Route::post('/pesan/proses', [HomeController::class, 'pesanProses']);
Route::delete('/order/delete', [HomeController::class, 'deleteOrder']);

//login admin
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login/process', [AuthController::class, 'loginProcess']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register/process', [AuthController::class, 'registerProcess']);
Route::get('/logout', [AuthController::class, 'logout']);


//Dashboard admin
Route::get('/pesanan', [HomeController::class, 'tampilPesanan']);
Route::get('/order/edit/{id}', [HomeController::class, 'editPesanan']);
Route::post('/order/edit/proses', [HomeController::class, 'editPesananProses']);
Route::get('/data_admin',[AuthController::class,'tampilAdmin']);
Route::delete('/delete_admin',[AuthController::class,'deleteAdmin']);

//kategori
Route::get('/kategori',[HomeController::class,'kategori']);
Route::get('kategori/edit/{id}',[HomeController::class,'editKategori']);
Route::post('/kategori/edit/proses',[HomeController::class,'editKategoriProses']);

//produk
Route::get('/produk',[HomeController::class,'produk']);
Route::get('/tambah/produk',[HomeController::class,'tambahProduk']);
Route::post('/tambah/produk/proses',[HomeController::class,'tambahProdukProses']);
Route::get('/produk/edit/{id}',[HomeController::class,'editProduk']);
Route::post('/produk/edit/proses',[HomeController::class,'editProdukProses']);
Route::delete('/produk/delete',[HomeController::class,'deleteProduk']);