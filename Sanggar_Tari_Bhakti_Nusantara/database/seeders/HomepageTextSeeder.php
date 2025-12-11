<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomepageTextSection;

class HomepageTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $texts = [
            // Hero Section
            [
                'key' => 'hero_badge',
                'label' => 'Hero Badge Text',
                'content' => 'Sanggar Tari',
            ],
            [
                'key' => 'hero_title',
                'label' => 'Hero Title',
                'content' => 'Bhakti Nusantara',
            ],
            [
                'key' => 'hero_subtitle',
                'label' => 'Hero Subtitle',
                'content' => 'Ruang Ekspresi Tari Tradisional Indonesia',
            ],
            [
                'key' => 'hero_description',
                'label' => 'Hero Description',
                'content' => 'Menghidupkan warisan budaya melalui gerak, irama, dan kreativitas. Kami menghadirkan pelatihan terpadu untuk anak hingga dewasa dengan kurikulum seni tari yang modern namun berakar kuat pada tradisi Nusantara.',
            ],
            [
                'key' => 'hero_btn_primary',
                'label' => 'Hero Primary Button',
                'content' => 'Daftar Kelas Sekarang',
            ],
            [
                'key' => 'hero_btn_secondary',
                'label' => 'Hero Secondary Button',
                'content' => 'Lihat Produk',
            ],
            
            // About Section
            [
                'key' => 'about_subtitle',
                'label' => 'About Section Subtitle',
                'content' => 'Tentang Sanggar',
            ],
            [
                'key' => 'about_title',
                'label' => 'About Section Title',
                'content' => 'Seni Tari Sebagai Media Belajar Nilai Hidup',
            ],
            [
                'key' => 'about_description',
                'label' => 'About Section Description',
                'content' => 'Kami percaya bahwa gerakan tari menyimpan filosofi hidup. Program Bhakti Nusantara dirancang untuk mengasah teknik, disiplin, dan karakter.',
            ],
            
            // Schedule Section
            [
                'key' => 'schedule_subtitle',
                'label' => 'Schedule Section Subtitle',
                'content' => 'Jadwal Mingguan',
            ],
            [
                'key' => 'schedule_title',
                'label' => 'Schedule Section Title',
                'content' => 'Latihan Terstruktur Menyesuaikan Usia dan Level',
            ],
            [
                'key' => 'schedule_description',
                'label' => 'Schedule Section Description',
                'content' => 'Setiap peserta mendapatkan kelas sesuai kelompok usia dan kemampuan dengan kuota terbatas agar pelatih dapat fokus pada perkembangan individu.',
            ],
            
            // Gallery Section
            [
                'key' => 'gallery_subtitle',
                'label' => 'Gallery Section Subtitle',
                'content' => 'Galeri Kegiatan',
            ],
            [
                'key' => 'gallery_title',
                'label' => 'Gallery Section Title',
                'content' => 'Momen Terbaik di Panggung dan Studio',
            ],
            [
                'key' => 'gallery_description',
                'label' => 'Gallery Section Description',
                'content' => 'Dokumentasi perjalanan Bhakti Nusantara dalam berbagai festival, pentas sekolah, hingga kolaborasi lintas budaya.',
            ],
            
            // Testimonial Section
            [
                'key' => 'testimonial_subtitle',
                'label' => 'Testimonial Section Subtitle',
                'content' => 'Testimoni',
            ],
            [
                'key' => 'testimonial_title',
                'label' => 'Testimonial Section Title',
                'content' => 'Cerita Para Penari dan Orang Tua',
            ],
            [
                'key' => 'testimonial_description',
                'label' => 'Testimonial Section Description',
                'content' => 'Pengalaman nyata belajar di Bhakti Nusantara yang membawa perubahan positif pada percaya diri, disiplin, dan apresiasi budaya.',
            ],
            
            // CTA Section
            [
                'key' => 'cta_title',
                'label' => 'CTA Title',
                'content' => 'Siap Bergabung dengan Bhakti Nusantara?',
            ],
            [
                'key' => 'cta_description',
                'label' => 'CTA Description',
                'content' => 'Daftarkan diri Anda untuk sesi trial gratis dan rasakan atmosfer latihan di studio kami. Tim kami siap membantu menentukan kelas terbaik.',
            ],
            [
                'key' => 'cta_button',
                'label' => 'CTA Button Text',
                'content' => 'Booking Trial via WhatsApp',
            ],
            [
                'key' => 'cta_whatsapp',
                'label' => 'WhatsApp Number',
                'content' => '6281234567890',
            ],
        ];

        foreach ($texts as $text) {
            HomepageTextSection::updateOrCreate(
                ['key' => $text['key']],
                [
                    'label' => $text['label'],
                    'content' => $text['content']
                ]
            );
        }
    }
}
