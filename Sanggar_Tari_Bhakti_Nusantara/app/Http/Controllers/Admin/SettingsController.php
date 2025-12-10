<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\HomepageCarousel;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display hero section settings
     */
    public function hero()
    {
        $heroTitle = SiteSetting::getValue('hero_title', 'Warisan Budaya dalam Setiap Gerakan');
        $heroSubtitle = SiteSetting::getValue('hero_subtitle', 'Bergabunglah dengan kami untuk mempelajari tari tradisional Nusantara dan mengembangkan potensi seni Anda.');
        $carousels = HomepageCarousel::orderBy('order')->get();
        
        return view('admin.settings.hero', compact('heroTitle', 'heroSubtitle', 'carousels'));
    }

    /**
     * Update hero section settings
     */
    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:500',
        ]);

        SiteSetting::setValue('hero_title', $request->hero_title, 'text', 'Hero section main title');
        SiteSetting::setValue('hero_subtitle', $request->hero_subtitle, 'text', 'Hero section subtitle');

        return redirect()->route('admin.settings.hero')
            ->with('success', 'Hero section berhasil diperbarui');
    }

    /**
     * Display beranda (home page) settings
     */
    public function beranda()
    {
        $galleryImages = GalleryImage::where('category', 'galeri_kegiatan')
            ->orderBy('order')
            ->get();
        
        $sinceYear = SiteSetting::getValue('since_year', '2012');
        $sinceText = SiteSetting::getValue('since_text', 'Melayani Pendidikan Seni Tari');
        
        return view('admin.settings.beranda', compact('galleryImages', 'sinceYear', 'sinceText'));
    }

    /**
     * Update beranda settings
     */
    public function updateBeranda(Request $request)
    {
        $request->validate([
            'since_year' => 'required|string|max:4',
            'since_text' => 'required|string|max:255',
        ]);

        SiteSetting::setValue('since_year', $request->since_year, 'text', 'Since year');
        SiteSetting::setValue('since_text', $request->since_text, 'text', 'Since text description');

        return redirect()->route('admin.settings.beranda')
            ->with('success', 'Pengaturan beranda berhasil diperbarui');
    }

    /**
     * Display tentang (about) settings
     */
    public function tentang()
    {
        $visi = SiteSetting::getValue('about_vision', 'Menjadi pusat keunggulan seni tari tradisional Nusantara yang menginspirasi generasi muda.');
        
        // Misi dalam bentuk JSON array
        $misiJson = SiteSetting::getValue('about_mission', '[]');
        $misi = json_decode($misiJson, true) ?: [
            'Melestarikan warisan budaya tari Indonesia',
            'Mengembangkan karakter melalui disiplin seni',
            'Menciptakan komunitas pembelajar yang solid'
        ];
        
        $aboutImage = SiteSetting::getValue('about_image', '');
        $sinceYear = SiteSetting::getValue('since_year', '2012');
        
        return view('admin.settings.tentang', compact('visi', 'misi', 'aboutImage', 'sinceYear'));
    }

    /**
     * Update tentang settings
     */
    public function updateTentang(Request $request)
    {
        $request->validate([
            'about_vision' => 'required|string',
            'about_mission' => 'required|array',
            'about_mission.*' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        SiteSetting::setValue('about_vision', $request->about_vision, 'text', 'About section vision');
        SiteSetting::setValue('about_mission', json_encode($request->about_mission), 'json', 'About section mission points');

        // Handle image upload
        if ($request->hasFile('about_image')) {
            $oldImage = SiteSetting::getValue('about_image');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('about_image')->store('settings', 'public');
            SiteSetting::setValue('about_image', $path, 'image', 'About section image');
        }

        return redirect()->route('admin.settings.tentang')
            ->with('success', 'Pengaturan tentang berhasil diperbarui');
    }
}
