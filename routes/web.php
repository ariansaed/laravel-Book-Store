<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::middleware(('auth'))->prefix('panel')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // روت کاربران
    Route::resource('users', UserController::class);
    Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    // روت دسته بندی ها
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    // روت محصولات 
    Route::resource('products', ProductController::class);
    Route::post('products/{slug}/restore', [ProductController::class, 'restore'])->name('products.restore');
});
route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
