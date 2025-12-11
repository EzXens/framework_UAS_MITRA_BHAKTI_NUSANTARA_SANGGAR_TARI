<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageTextSection;

class HomepageTextSectionSeeder extends Seeder
{
    /**
     * Seed homepage text sections based on current home.blade.php
     */
    public function run(): void
    {
        $sections = [
            // About Section
            [
                'key' => 'about_subtitle',
                'label' => 'About - Subtitle',
                'content' => 'Tentang Sanggar',
            ],
            [
                'key' => 'about_title',
                'label' => 'About - Judul',
                'content' => 'Seni Tari Sebagai Media Belajar Nilai Hidup',
            ],
            [
                'key' => 'about_description',
                'label' => 'About - Deskripsi',
                'content' => 'Kami percaya bahwa gerakan tari menyimpan filosofi hidup. Program Bhakti Nusantara dirancang untuk mengasah teknik, disiplin, dan karakter.',
            ],

            // Schedule Section
            [
                'key' => 'schedule_subtitle',
                'label' => 'Jadwal - Subtitle',
                'content' => 'Jadwal Mingguan',
            ],
            [
                'key' => 'schedule_title',
                'label' => 'Jadwal - Judul',
                'content' => 'Latihan Terstruktur Menyesuaikan Usia dan Level',
            ],
            [
                'key' => 'schedule_description',
                'label' => 'Jadwal - Deskripsi',
                'content' => 'Setiap peserta mendapatkan kelas sesuai kelompok usia dan kemampuan dengan kuota terbatas agar pelatih dapat fokus pada perkembangan individu.',
            ],

            // Gallery Section
            [
                'key' => 'gallery_subtitle',
                'label' => 'Galeri - Subtitle',
                'content' => 'Galeri Kegiatan',
            ],
            [
                'key' => 'gallery_title',
                'label' => 'Galeri - Judul',
                'content' => 'Momen Terbaik di Panggung dan Studio',
            ],
            [
                'key' => 'gallery_description',
                'label' => 'Galeri - Deskripsi',
                'content' => 'Dokumentasi perjalanan Bhakti Nusantara dalam berbagai festival, pentas sekolah, hingga kolaborasi lintas budaya.',
            ],

            // Testimonial Section
            [
                'key' => 'testimonial_subtitle',
                'label' => 'Testimoni - Subtitle',
                'content' => 'Testimoni',
            ],
            [
                'key' => 'testimonial_title',
                'label' => 'Testimoni - Judul',
                'content' => 'Cerita Para Penari dan Orang Tua',
            ],
            [
                'key' => 'testimonial_description',
                'label' => 'Testimoni - Deskripsi',
                'content' => 'Pengalaman nyata belajar di Bhakti Nusantara yang membawa perubahan positif pada percaya diri, disiplin, dan apresiasi budaya.',
            ],

            // CTA Section
            [
                'key' => 'cta_title',
                'label' => 'CTA - Judul',
                'content' => 'Siap Bergabung dengan Bhakti Nusantara?',
            ],
            [
                'key' => 'cta_description',
                'label' => 'CTA - Deskripsi',
                'content' => 'Daftarkan diri Anda untuk sesi trial gratis dan rasakan atmosfer latihan di studio kami. Tim kami siap membantu menentukan kelas terbaik.',
            ],
            [
                'key' => 'cta_button',
                'label' => 'CTA - Teks Tombol',
                'content' => 'Booking Trial via WhatsApp',
            ],
            [
                'key' => 'cta_whatsapp',
                'label' => 'CTA - Nomor WhatsApp',
                'content' => '6281234567890',
            ],
        ];

        foreach ($sections as $section) {
            HomepageTextSection::updateOrCreate(
                ['key' => $section['key']],
                $section
            );
        }

        $this->command->info('Homepage text sections seeded successfully! Total: ' . count($sections));
    }
}
