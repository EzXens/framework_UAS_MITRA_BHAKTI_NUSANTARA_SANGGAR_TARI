<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminGalleryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/tentang', 'pages.about')->name('about');
Route::get('/produk', [ProductController::class, 'publicIndex'])->name('products');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
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
    // Enrollment approval/rejection for admin
    Route::post('/admin/enrollments/{id}/approve', [App\Http\Controllers\Admin\EnrollmentController::class, 'approve'])->name('admin.enrollments.approve');
    Route::post('/admin/enrollments/{id}/reject', [App\Http\Controllers\Admin\EnrollmentController::class, 'reject'])->name('admin.enrollments.reject');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('classes', ClassController::class)->except(['show']);
    
    // Homepage Management Routes
    Route::prefix('admin/homepage')->name('admin.homepage.')->group(function () {
        Route::post('/texts', [App\Http\Controllers\Admin\HomepageTextSectionController::class, 'store'])->name('texts.store');
        Route::put('/texts/{id}', [App\Http\Controllers\Admin\HomepageTextSectionController::class, 'update'])->name('texts.update');
        Route::delete('/texts/{id}', [App\Http\Controllers\Admin\HomepageTextSectionController::class, 'destroy'])->name('texts.destroy');
        
        Route::post('/carousel', [App\Http\Controllers\Admin\HomepageCarouselController::class, 'store'])->name('carousel.store');
        Route::put('/carousel/{id}', [App\Http\Controllers\Admin\HomepageCarouselController::class, 'update'])->name('carousel.update');
        Route::delete('/carousel/{id}', [App\Http\Controllers\Admin\HomepageCarouselController::class, 'destroy'])->name('carousel.destroy');
        
        Route::post('/icons', [App\Http\Controllers\Admin\HomepageIconController::class, 'store'])->name('icons.store');
        Route::put('/icons/{id}', [App\Http\Controllers\Admin\HomepageIconController::class, 'update'])->name('icons.update');
        Route::delete('/icons/{id}', [App\Http\Controllers\Admin\HomepageIconController::class, 'destroy'])->name('icons.destroy');
        
        Route::post('/sections', [App\Http\Controllers\Admin\HomepageSectionController::class, 'store'])->name('sections.store');
        Route::put('/sections/{id}', [App\Http\Controllers\Admin\HomepageSectionController::class, 'update'])->name('sections.update');
        Route::delete('/sections/{id}', [App\Http\Controllers\Admin\HomepageSectionController::class, 'destroy'])->name('sections.destroy');
    });
    
    // Gallery Management Routes
    Route::prefix('admin/gallery')->name('admin.gallery.')->group(function () {
        // Carousel Routes
        Route::get('/carousel', [AdminGalleryController::class, 'carouselIndex'])->name('carousel.index');
        Route::get('/carousel/create', [AdminGalleryController::class, 'carouselCreate'])->name('carousel.create');
        Route::post('/carousel', [AdminGalleryController::class, 'carouselStore'])->name('carousel.store');
        Route::get('/carousel/{carousel}/edit', [AdminGalleryController::class, 'carouselEdit'])->name('carousel.edit');
        Route::put('/carousel/{carousel}', [AdminGalleryController::class, 'carouselUpdate'])->name('carousel.update');
        Route::delete('/carousel/{carousel}', [AdminGalleryController::class, 'carouselDestroy'])->name('carousel.destroy');
        
        // Image Routes
        Route::get('/image', [AdminGalleryController::class, 'imageIndex'])->name('image.index');
        Route::get('/image/create', [AdminGalleryController::class, 'imageCreate'])->name('image.create');
        Route::post('/image', [AdminGalleryController::class, 'imageStore'])->name('image.store');
        Route::get('/image/{image}/edit', [AdminGalleryController::class, 'imageEdit'])->name('image.edit');
        Route::put('/image/{image}', [AdminGalleryController::class, 'imageUpdate'])->name('image.update');
        Route::delete('/image/{image}', [AdminGalleryController::class, 'imageDestroy'])->name('image.destroy');
        
        // Video Routes
        Route::get('/video', [AdminGalleryController::class, 'videoIndex'])->name('video.index');
        Route::get('/video/create', [AdminGalleryController::class, 'videoCreate'])->name('video.create');
        Route::post('/video', [AdminGalleryController::class, 'videoStore'])->name('video.store');
        Route::get('/video/{video}/edit', [AdminGalleryController::class, 'videoEdit'])->name('video.edit');
        Route::put('/video/{video}', [AdminGalleryController::class, 'videoUpdate'])->name('video.update');
        Route::delete('/video/{video}', [AdminGalleryController::class, 'videoDestroy'])->name('video.destroy');
        
        // Music Routes
        Route::get('/music', [AdminGalleryController::class, 'musicIndex'])->name('music.index');
        Route::get('/music/create', [AdminGalleryController::class, 'musicCreate'])->name('music.create');
        Route::post('/music', [AdminGalleryController::class, 'musicStore'])->name('music.store');
        Route::get('/music/{music}/edit', [AdminGalleryController::class, 'musicEdit'])->name('music.edit');
        Route::put('/music/{music}', [AdminGalleryController::class, 'musicUpdate'])->name('music.update');
        Route::delete('/music/{music}', [AdminGalleryController::class, 'musicDestroy'])->name('music.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/dashboard/profile-picture', [UserDashboardController::class, 'updateProfilePicture'])->name('user.updateProfilePicture');
});
