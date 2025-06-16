<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::post('/login', function (Request $request) {
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     // if (Auth::attempt($credentials)) {
//     //     $user = Auth::user();
//     //     $token = $user->createToken('api-token')->plainTextToken;
//     //     return response()->json(['token' => $token], 200);
//     // }

//     return response()->json(['error' => 'Invalid credentials'], 401);
// })->name('api.login');

// Route::middleware(['auth:sanctum', 'admin'])->prefix('products')->group(function () {
//     Route::get('/', [ProductAdminController::class, 'indexApi'])->name('api.productadmin.index');
//     Route::post('/', [ProductAdminController::class, 'storeApi'])->name('api.productadmin.store');
//     Route::get('/{id}', [ProductAdminController::class, 'showApi'])->name('api.productadmin.show');
//     Route::put('/{id}', [ProductAdminController::class, 'updateApi'])->name('api.productadmin.update');
//     Route::delete('/{id}', [ProductAdminController::class, 'destroyApi'])->name('api.productadmin.destroy');
// });

Route::post('/login', [AuthController::class, 'login'])->name('api.login');



Route::prefix('v1')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout'])->name('api.logout');
    Route::get('/products', [ProductAdminController::class, 'apiIndex'])->name('api.products.index');
    Route::get('/products/{id}', [ProductAdminController::class, 'apiShow'])->name('api.products.show');
    Route::post('/products', [ProductAdminController::class, 'store'])->name('api.products.store');
    Route::put('/products/{id}', [ProductAdminController::class, 'update'])->name('api.products.update');
    Route::delete('/products/{id}', [ProductAdminController::class, 'destroy'])->name('api.products.destroy');
});
