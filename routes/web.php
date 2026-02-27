<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home');
route::resource('products', App\Http\Controllers\ProductController::class);
Route::post('/comment',[CommentController::class,'store'])->middleware('auth')->name('comment.store');

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
    // روت بلاگ
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

    Route::resource('comments',AdminCommentController::class);
});
route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
