<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('/admin/product', [ProductController::class, 'index']) -> name('admin/product');
    Route::get('/admin/product/create', [ProductController::class, 'create']) -> name('admin/product/create');
    Route::post('/admin/product/save', [ProductController::class, 'store']) -> name('admin/product/save');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit']) -> name('admin/product/edit');
    Route::put('/admin/product/update/{id}', [ProductController::class, 'update']) -> name('admin/product/update');

});

require __DIR__.'/auth.php';

// Route::get('admin/dashboard', [HomeController::class, 'index']);
// Route::get('admin/dashboard', [HomeController::class, 'index']) -> middleware(['auth', 'admin']);

