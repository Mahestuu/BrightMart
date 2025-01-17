<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiTokoController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/product', function () {
    return view('utama.product');
});

// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin', AdminController::class);
    Route::resource('productadmin', ProductController::class);
    Route::resource('categoryadmin', CategoryController::class);
// });


Route::resource('lokasitoko', LokasiTokoController::class);
Route::resource('karir', KarirController::class);
Route::resource('promo', PromoController::class);
Route::resource('home', HomeController::class);