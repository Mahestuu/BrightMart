<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LokasiTokoController;
use App\Http\Controllers\KarirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/product', function () {
//     return view('utama.product');
// });
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    // Route::fallback(function () {
    //     abort(404); // Tampilkan 404 untuk semua route /admin/*
    // });

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('dashboardadmin', AdminController::class);
    Route::resource('productadmin', ProductAdminController::class);
    Route::resource('categoryadmin', CategoryAdminController::class);
});


// Route::middleware('auth')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

// });
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cart_id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/transaction/{order_id}', [OrderController::class, 'show'])->name('order.show');
    // Route::get('/orders/history', fn() => view('utama.history'))->name('orders.history'); // Placeholder
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});

Route::resource('product', ProductController::class);
Route::resource('lokasitoko', LokasiTokoController::class);
Route::resource('karir', KarirController::class);
Route::resource('promo', PromoController::class);
Route::resource('home', HomeController::class);

Route::post('send-message', [CustomerServiceController::class, 'sendMessage'])->name('send.message');
Route::get('get-messages', [CustomerServiceController::class, 'getMessages'])->name('get.messages');
Route::resource('customerservice', CustomerServiceController::class);
