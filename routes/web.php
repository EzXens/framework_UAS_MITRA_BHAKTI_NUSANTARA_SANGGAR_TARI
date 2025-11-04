<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/tentang', 'pages.about')->name('about');
Route::view('/produk', 'pages.products')->name('products');
Route::view('/galeri', 'pages.gallery')->name('gallery');
Route::get('/login', function () {
    return view('pages.auth.login', ['initialTab' => request('tab', 'login')]);
})->name('login');

Route::get('/register', function () {
    return redirect()->route('login', ['tab' => 'register']);
})->name('register');
