<?php

namespace App\Http\Controllers;

use App\Models\HomepageSection;
use App\Models\HomepageTextSection;
use App\Models\HomepageCarousel;
use App\Models\HomepageIcon;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $homepageTexts = HomepageTextSection::all()->keyBy('key');
        $homepageCarousels = HomepageCarousel::where('is_active', true)->orderBy('order')->get();
        $homepageIcons = HomepageIcon::where('is_active', true)->orderBy('order')->get();
        $homepageSections = HomepageSection::where('is_active', true)->orderBy('order')->get();

        return view('pages.home', compact(
            'homepageTexts',
            'homepageCarousels',
            'homepageIcons',
            'homepageSections'
        ));
    }
}
