<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mypage', [MypageController::class, 'index'])
    ->middleware('auth')
    ->name('mypage.index');

Route::get('/account/edit', [MypageController::class, 'edit'])
    ->middleware('auth')
    ->name('account.edit');

Route::put('/account', [MypageController::class, 'update'])
    ->middleware('auth')
    ->name('account.update');

Route::get('/mypage/products/{product}', [ProductController::class, 'myProductShow'])
    ->middleware('auth')
    ->name('mypage.products.show');

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

Route::get('/products/{product}/purchase', [ProductController::class, 'purchase'])
    ->middleware('auth')
    ->name('products.purchase');

Route::post('/products/{product}/purchase', [ProductController::class, 'storePurchase'])
    ->middleware('auth')
    ->name('products.purchase.store');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('/contact', [ContactController::class, 'send'])
    ->name('contact.send');
