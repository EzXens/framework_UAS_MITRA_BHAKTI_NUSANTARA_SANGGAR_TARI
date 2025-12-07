<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ClassModel;
use App\Models\ClassEnrollment;
use App\Models\HomepageTextSection;
use App\Models\HomepageCarousel;
use App\Models\HomepageIcon;
use App\Models\HomepageSection;
use App\Models\Dispensation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalClasses = ClassModel::count();
        $totalEnrollments = ClassEnrollment::count();
        $pendingEnrollments = ClassEnrollment::where('status', 'pending')->count();
        
        $recentEnrollments = ClassEnrollment::with(['user', 'classModel'])
            ->latest()
            ->take(5)
            ->get();
        
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        // Pending dispensations for admin quick approval
        $pendingDispensations = Dispensation::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        // Homepage Management Data
        $homepageTexts = HomepageTextSection::all();
        $homepageCarousels = HomepageCarousel::orderBy('order')->get();
        $homepageIcons = HomepageIcon::orderBy('order')->get();
        $homepageSections = HomepageSection::orderBy('order')->get();
        
        // Expected static text keys used in home.blade.php so admin can edit them
        $expectedTextItems = [
            ['key' => 'hero_title', 'label' => 'Hero Title'],
            ['key' => 'hero_description', 'label' => 'Hero Description'],
            ['key' => 'hero_cta_primary', 'label' => 'Hero CTA Primary'],
            ['key' => 'hero_cta_secondary', 'label' => 'Hero CTA Secondary'],
            ['key' => 'about_subtitle', 'label' => 'About Subtitle'],
            ['key' => 'about_title', 'label' => 'About Title'],
            ['key' => 'about_description', 'label' => 'About Description'],
            ['key' => 'gallery_subtitle', 'label' => 'Gallery Subtitle'],
            ['key' => 'gallery_title', 'label' => 'Gallery Title'],
            ['key' => 'gallery_description', 'label' => 'Gallery Description'],
        ];

        // Expected static sections (anchors) present on home page
        $expectedSectionItems = [
            ['slug' => 'tentang', 'label' => 'Tentang Sanggar'],
            ['slug' => 'jadwal', 'label' => 'Jadwal Mingguan'],
            ['slug' => 'galeri_kegiatan', 'label' => 'Galeri Kegiatan'],
        ];

        // Expected icon/title items used by the homepage so admin can edit them
        $expectedIconItems = [
            ['title' => 'Kurasi Tari Nusantara'],
            ['title' => 'Pelatih Profesional'],
            ['title' => 'Fasilitas Lengkap'],
            ['title' => 'Komunitas Kuat'],
        ];
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalClasses',
            'totalEnrollments',
            'pendingEnrollments',
            'recentEnrollments',
            'recentUsers',
            'homepageTexts',
            'homepageCarousels',
            'homepageIcons',
            'homepageSections'
        ))->with([
            'expectedTextItems' => $expectedTextItems,
            'expectedSectionItems' => $expectedSectionItems,
            'expectedIconItems' => $expectedIconItems,
            'pendingDispensations' => $pendingDispensations ?? collect(),
        ]);
    }
}

