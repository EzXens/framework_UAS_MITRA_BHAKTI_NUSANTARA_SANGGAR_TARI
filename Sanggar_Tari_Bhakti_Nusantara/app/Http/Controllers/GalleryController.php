<?php

namespace App\Http\Controllers;

use App\Models\GalleryCarousel;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\GalleryMusic;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $carouselSlides = GalleryCarousel::active()->ordered()->get();
        
        // Get the active tab from request, default to 'images'
        $activeTab = $request->get('tab', 'images');
        
        // Paginate only the active tab's data
        $imageGallery = $activeTab === 'images' 
            ? GalleryImage::active()->latest()->paginate(9)->withQueryString()
            : collect();
            
        $videoGallery = $activeTab === 'video' 
            ? GalleryVideo::active()->latest()->paginate(9)->withQueryString()
            : collect();
            
        $musicTracks = $activeTab === 'music' 
            ? GalleryMusic::active()->latest()->paginate(9)->withQueryString()
            : collect();

        // If AJAX request, return only the media section
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('pages.gallery-media-section', compact('imageGallery', 'videoGallery', 'musicTracks', 'activeTab'))->render(),
                'activeTab' => $activeTab
            ]);
        }

        return view('pages.gallery', compact('carouselSlides', 'imageGallery', 'videoGallery', 'musicTracks', 'activeTab'));
    }
}
