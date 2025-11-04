<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/tentang', 'pages.about')->name('about');
Route::view('/produk', 'pages.products')->name('products');
Route::view('/galeri', 'pages.gallery')->name('gallery');
