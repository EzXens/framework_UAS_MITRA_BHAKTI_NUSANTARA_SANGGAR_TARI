<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Seed teachers/instructors data based on current about page
     */
    public function run(): void
    {
        $teachers = [
            [
                'name' => 'Ratna Widyasari',
                'position' => 'Direktur Artistik',
                'bio' => 'Pengalaman 10+ tahun dalam pertunjukan dan pendidikan tari tradisi. Lulusan ISI Yogyakarta dengan fokus pada tari klasik Jawa dan pengembangan koreografi kontemporer.',
                'photo' => null, 
                'specialization' => 'Tari Klasik Jawa & Koreografi',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Taufik Nugraha',
                'position' => 'Pelatih Koreografi',
                'bio' => 'Pengalaman 10+ tahun dalam pertunjukan dan pendidikan tari tradisi. Ahli dalam pengembangan gerakan inovatif yang tetap mempertahankan nilai-nilai tradisional.',
                'photo' => null,
                'specialization' => 'Koreografi & Komposisi Tari',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Mita Arindya',
                'position' => 'Pelatih Teknik',
                'bio' => 'Pengalaman 10+ tahun dalam pertunjukan dan pendidikan tari tradisi. Berpengalaman dalam melatih teknik dasar hingga tingkat mahir untuk berbagai jenis tari Nusantara.',
                'photo' => null,
                'specialization' => 'Teknik Tari & Body Conditioning',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Adi Wibowo',
                'position' => 'Pelatih Musik & Iringan',
                'bio' => 'Pengalaman 10+ tahun dalam pertunjukan dan pendidikan tari tradisi. Menguasai berbagai instrumen gamelan dan musik pengiring tari tradisional.',
                'photo' => null,
                'specialization' => 'Musik Tradisional & Iringan Tari',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::updateOrCreate(
                ['name' => $teacher['name']],
                $teacher
            );
        }

        $this->command->info('Teachers seeded successfully! Total: ' . count($teachers));
    }
}
