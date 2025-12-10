<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomepageIcon;

class HomepageIconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * TIPS MENGGUNAKAN ICON:
     * 
     * 1. **Heroicons** (Recommended - Sudah digunakan di project ini)
     *    - Website: https://heroicons.com/
     *    - Cara: Copy SVG code langsung
     *    - Format: Simpan sebagai SVG string di field icon_class
     *    - Contoh: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path.../></svg>'
     * 
     * 2. **Font Awesome** (Alternative)
     *    - Website: https://fontawesome.com/icons
     *    - Cara: Gunakan class name
     *    - Format: icon_class = 'fas fa-globe' atau 'fab fa-facebook'
     *    - Note: Perlu install Font Awesome di layout
     * 
     * 3. **Bootstrap Icons**
     *    - Website: https://icons.getbootstrap.com/
     *    - Cara: Copy SVG atau gunakan icon font
     *    - Format: icon_class = 'bi bi-globe' atau SVG
     * 
     * 4. **Iconify** (Banyak pilihan)
     *    - Website: https://icon-sets.iconify.design/
     *    - Cara: Search icon, copy SVG
     *    - Format: SVG string
     */
    public function run(): void
    {
        $icons = [
            [
                'title' => 'Kurasi Tari Nusantara',
                'description' => 'Materi kami mencakup tari tradisional dari Sabang sampai Merauke dengan pendekatan inovatif.',
                'icon_class' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253" /></svg>',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatih Profesional',
                'description' => 'Dipandu pengajar berpengalaman yang aktif di panggung nasional dan internasional.',
                'icon_class' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z" /></svg>',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Fasilitas Lengkap',
                'description' => 'Studio nyaman dengan ruang ganti, audio profesional, dan galeri kostum.',
                'icon_class' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008z" /></svg>',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Komunitas Kuat',
                'description' => 'Jaringan alumni yang aktif berbagi ilmu dan kolaborasi lintas daerah.',
                'icon_class' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($icons as $icon) {
            HomepageIcon::updateOrCreate(
                ['title' => $icon['title']],
                $icon
            );
        }
    }
}
