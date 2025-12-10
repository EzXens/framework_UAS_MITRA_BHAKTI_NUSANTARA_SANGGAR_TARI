<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get about settings from database
        $visi = SiteSetting::getValue('about_vision', 'Menjadi sanggar tari rujukan nasional yang mengedepankan pelestarian budaya, inovasi koreografi, dan pengembangan karakter melalui seni tari.');
        
        // Get misi as JSON array
        $misiJson = SiteSetting::getValue('about_mission', '[]');
        $misi = json_decode($misiJson, true);
        
        // Default misi if empty
        if (empty($misi)) {
            $misi = [
                'Menghadirkan kurikulum tari tradisional yang sistematis dan adaptif.',
                'Memberikan fasilitas latihan dan panggung yang layak bagi penari.',
                'Menjalin kolaborasi dengan komunitas budaya dan institusi pendidikan.',
                'Mendorong penari untuk aktif berkarya dan berkompetisi secara sehat.'
            ];
        }
        
        // Get about image
        $aboutImage = SiteSetting::getValue('about_image', '');
        
        // Get since year
        $sinceYear = SiteSetting::getValue('since_year', '2012');
        
        // Get teachers from database
        $teachers = Teacher::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        return view('pages.about', compact('visi', 'misi', 'aboutImage', 'sinceYear', 'teachers'));
    }
}
