<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ContactController;

Route::view('/', 'pages.home')->name('home');
Route::view('/tentang', 'pages.about')->name('about');
Route::get('/produk', [ProductController::class, 'publicIndex'])->name('products');
Route::view('/galeri', 'pages.gallery')->name('gallery');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/kelas', [ClassController::class, 'publicIndex'])->name('classes.public');
Route::post('/kelas/{class}/daftar', [ClassController::class, 'enroll'])->name('classes.enroll');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('classes', ClassController::class)->except(['show']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/dashboard/profile-picture', [UserDashboardController::class, 'updateProfilePicture'])->name('user.updateProfilePicture');
});
