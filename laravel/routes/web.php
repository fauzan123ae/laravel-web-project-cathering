<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;


/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route untuk halaman menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// Route untuk halaman dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route untuk halaman profil
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');


Route::middleware(['auth'])->group(function () {
    Route::post('cart/add/{menuId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/update/{cartId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/whatsapp', [CartController::class, 'whatsappCheckout'])->name('checkout.whatsapp');
});


// Routes untuk MenuController (dengan middleware auth)
Route::middleware(['auth'])->group(function () {
    // Halaman untuk melihat menu
    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');

    // Halaman untuk menambahkan dan mengelola menu
    Route::get('menu/crud', [MenuController::class, 'crud'])->name('menu.crud');
    
    
    // Route untuk menyimpan menu baru
    Route::post('menu', [MenuController::class, 'store'])->name('menu.store');
    
    // Route untuk mengedit menu
    Route::get('menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    
    // Route untuk menghapus menu
    Route::delete('menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
});

Route::get('/menu/trashed', [MenuController::class, 'trashed'])->name('menu.trashed');
Route::patch('/menu/restore/{id}', [MenuController::class, 'restore'])->name('menu.restore');
Route::delete('/menu/force-delete/{id}', [MenuController::class, 'forceDelete'])->name('menu.forceDelete');

// Route untuk membuat admin
Route::get('/make-admin', [MenuController::class, 'makeAdmin']);

// Auth routes
require __DIR__.'/auth.php';
