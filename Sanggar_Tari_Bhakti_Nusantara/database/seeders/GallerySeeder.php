<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryCarousel;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\GalleryMusic;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Carousel Dummy Data (using images from public/images/)
        $carousels = [
            [
                'title' => 'Tari Saman - Warisan Budaya Indonesia',
                'description' => 'Tari Saman adalah tarian tradisional dari Aceh yang terkenal dengan gerakan kompak dan dinamis.',
                'image' => 'images/contoh/hero-bg.png',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Pentas Tari Tradisional',
                'description' => 'Pertunjukan tari tradisional oleh siswa Sanggar Tari Bhakti Nusantara.',
                'image' => 'images/logo/logo.png',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Festival Budaya Nusantara',
                'description' => 'Kegiatan festival budaya dengan berbagai pertunjukan tari dari seluruh Indonesia.',
                'image' => 'images/contoh/hero-bg.png',
                'order' => 3,
                'is_active' => true
            ]
        ];

        foreach ($carousels as $carousel) {
            GalleryCarousel::create($carousel);
        }

        // Image Gallery Dummy Data (15 items untuk test pagination)
        $images = [
            ['title' => 'Tari Pendet Bali', 'description' => 'Tari penyambutan khas Bali dengan gerakan gemulai dan anggun.'],
            ['title' => 'Tari Kecak', 'description' => 'Tari tradisional Bali yang menampilkan puluhan penari pria.'],
            ['title' => 'Tari Jaipong Jawa Barat', 'description' => 'Tari modern dari Jawa Barat yang energik dan dinamis.'],
            ['title' => 'Tari Piring Sumatera Barat', 'description' => 'Tari tradisional Minangkabau dengan piring di tangan.'],
            ['title' => 'Tari Serimpi Jawa Tengah', 'description' => 'Tari klasik keraton dengan gerakan halus dan lembut.'],
            ['title' => 'Tari Gandrung Banyuwangi', 'description' => 'Tari pergaulan dari Banyuwangi yang penuh semangat.'],
            ['title' => 'Tari Tor Tor Batak', 'description' => 'Tari ritual dari Sumatera Utara yang sakral.'],
            ['title' => 'Tari Zapin Melayu', 'description' => 'Tari tradisional Melayu dengan iringan gambus.'],
            ['title' => 'Latihan Rutin Siswa', 'description' => 'Suasana latihan rutin di sanggar setiap hari.'],
            ['title' => 'Workshop Tari Kreasi', 'description' => 'Kegiatan workshop tari kreasi baru untuk siswa.'],
            ['title' => 'Pentas Seni Sekolah', 'description' => 'Penampilan tari di acara pentas seni sekolah.'],
            ['title' => 'Kolaborasi Tari Modern', 'description' => 'Kolaborasi tari tradisional dengan sentuhan modern.'],
            ['title' => 'Persiapan Kompetisi', 'description' => 'Siswa sanggar mempersiapkan diri untuk kompetisi tari.'],
            ['title' => 'Kostum Tari Tradisional', 'description' => 'Koleksi kostum tari tradisional dari berbagai daerah.'],
            ['title' => 'Dokumentasi Pertunjukan', 'description' => 'Dokumentasi berbagai pertunjukan tari sanggar.']
        ];

        foreach ($images as $index => $image) {
            GalleryImage::create([
                'title' => $image['title'],
                'description' => $image['description'],
                'image' => 'images/contoh/hero-bg.png', // Using existing image
                'is_active' => true
            ]);
        }

        // Video Gallery Dummy Data (12 items untuk test pagination)
        $videos = [
            [
                'title' => 'Tutorial Tari Saman',
                'description' => 'Video tutorial lengkap gerakan dasar tari Saman untuk pemula.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Pentas Tari Kecak',
                'description' => 'Rekaman pentas tari Kecak di event budaya tahun 2024.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Behind The Scene Latihan',
                'description' => 'Momen di balik layar latihan tari siswa sanggar.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Kompetisi Tari Nasional',
                'description' => 'Penampilan siswa di kompetisi tari tingkat nasional.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Workshop Koreografi',
                'description' => 'Video kegiatan workshop koreografi tari modern.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Tari Tradisional Jawa',
                'description' => 'Penampilan tari tradisional Jawa di acara kebudayaan.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Festival Tari Nusantara',
                'description' => 'Dokumentasi festival tari nusantara 2024.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Persiapan Pentas Akhir Tahun',
                'description' => 'Proses persiapan pentas akhir tahun sanggar.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Tutorial Gerakan Dasar',
                'description' => 'Video tutorial gerakan dasar tari untuk pemula.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Kolaborasi Tari Kontemporer',
                'description' => 'Kolaborasi tari tradisional dengan musik kontemporer.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Dokumentasi Pertunjukan Solo',
                'description' => 'Pertunjukan tari solo siswa terbaik sanggar.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ],
            [
                'title' => 'Showcase Akhir Semester',
                'description' => 'Showcase hasil pembelajaran siswa akhir semester.',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => 'images/contoh/hero-bg.png',
                'is_active' => true
            ]
        ];

        foreach ($videos as $video) {
            GalleryVideo::create($video);
        }

        // Music Gallery Dummy Data (10 items untuk test pagination)
        // Note: Using dummy path since we don't have actual audio files
        $musicTracks = [
            ['title' => 'Gamelan Jawa', 'description' => 'Musik gamelan tradisional Jawa untuk iringan tari.'],
            ['title' => 'Gondang Batak', 'description' => 'Musik tradisional Batak untuk tari Tor-Tor.'],
            ['title' => 'Gambus Melayu', 'description' => 'Musik gambus untuk iringan tari Zapin.'],
            ['title' => 'Angklung Sunda', 'description' => 'Musik angklung dari Jawa Barat.'],
            ['title' => 'Gendang Bali', 'description' => 'Musik gendang untuk tari Bali.'],
            ['title' => 'Musik Tari Saman', 'description' => 'Iringan musik untuk tari Saman Aceh.'],
            ['title' => 'Kolintang Minahasa', 'description' => 'Musik kolintang dari Sulawesi Utara.'],
            ['title' => 'Sasando NTT', 'description' => 'Musik sasando dari Nusa Tenggara Timur.'],
            ['title' => 'Talempong Minang', 'description' => 'Musik talempong dari Sumatera Barat.'],
            ['title' => 'Musik Kontemporer', 'description' => 'Musik kontemporer untuk tari kreasi baru.']
        ];

        foreach ($musicTracks as $music) {
            GalleryMusic::create([
                'title' => $music['title'],
                'description' => $music['description'],
                'audio_file' => 'audio/galeri/dummy.mp3', // Placeholder path
                'is_active' => true
            ]);
        }
    }
}
