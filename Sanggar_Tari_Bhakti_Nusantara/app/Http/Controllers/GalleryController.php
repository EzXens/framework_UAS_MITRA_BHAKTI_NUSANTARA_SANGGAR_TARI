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

        if ($carouselSlides->isEmpty()) {
            $carouselSlides = collect([
                (object)[
                    'image' => asset('images/bgtari.jpg'),
                    'title' => 'Parade Tari Nusantara',
                    'description' => 'Sorotan kolaborasi tari tradisional yang mempertemukan ragam budaya Nusantara di satu panggung.',
                ],
            ]);
        }
        
        // Get the active tab from request, default to 'images'
        $activeTab = $request->get('tab', 'images');
        
        // Paginate only the active tab's data
        $imageGallery = $activeTab === 'images' 
            ? GalleryImage::active()->latest()->paginate(9)->withQueryString()
            : collect();

        if ($activeTab === 'images' && $imageGallery->isEmpty()) {
            $imageGallery = collect([
                (object)[
                    'image' => asset('images/galeri/FOTO/1.jpg'),
                    'title' => 'Pentas Akhir Tahun',
                    'description' => 'Perpaduan tari tradisi Jawa Barat dan musik kontemporer.',
                ],
            ]);
        }
            
        $videoGallery = $activeTab === 'video' 
            ? GalleryVideo::active()->latest()->paginate(9)->withQueryString()
            : collect();

        if ($activeTab === 'video' && $videoGallery->isEmpty()) {
            $videoGallery = collect([
                (object)[
                    'thumbnail' => asset('images/contoh/home.png'),
                    'title' => 'Latihan Tari Kontemporer',
                    'description' => 'Cuplikan sesi latihan intensif di studio Bhakti Nusantara.',
                    'video_url' => 'https://www.youtube.com/embed/5z5Lft3T2m8?autoplay=1&rel=0',
                ],
            ]);
        }
            
        $musicTracks = $activeTab === 'music' 
            ? GalleryMusic::active()->latest()->paginate(9)->withQueryString()
            : collect();

        if ($activeTab === 'music' && $musicTracks->isEmpty()) {
            $musicTracks = collect([
                (object)[
                    'title' => 'Gending Pembuka Nusantara',
                    'description' => 'Aransemen gamelan modern yang mengiringi pembuka pentas.',
                    'audio_file' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                ],
            ]);
        }

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
