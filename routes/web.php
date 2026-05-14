<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\LikeController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mypage', [MypageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage.index');

Route::post('/products/{product}/like', [LikeController::class, 'store'])
    ->middleware('auth')
    ->name('products.like');



Route::get('/likes', [LikeController::class, 'index'])
    ->name('likes.index')
    ->middleware('auth');

Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware('auth')
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->middleware('auth')
    ->name('products.store');

Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware('auth')
    ->name('products.destroy');

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware('auth')
    ->name('products.edit');

Route::put('/products/{product}', [ProductController::class, 'update'])
    ->middleware('auth')
    ->name('products.update');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');

Route::post('/products/{product}/purchase',    [ProductController::class, 'storePurchase'])->name('products.purchase.store');
