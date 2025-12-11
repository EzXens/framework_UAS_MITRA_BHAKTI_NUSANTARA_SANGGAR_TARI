<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'name' => 'Tari Saman (Pemula)',
                'description' => 'Kelas tari Saman untuk pemula. Belajar gerakan dasar dan koordinasi kelompok dalam tarian khas Aceh ini.',
                'instructor' => 'Ibu Siti Rahmawati',
                'schedule' => 'Senin & Rabu, 16:00-18:00',
                'capacity' => 20,
            ],
            [
                'name' => 'Tari Pendet (Intermediate)',
                'description' => 'Kelas tari Pendet tingkat menengah. Pelajari keanggunan gerakan tari penyambutan dari Bali.',
                'instructor' => 'Ibu Ketut Ayu',
                'schedule' => 'Selasa & Kamis, 15:00-17:00',
                'capacity' => 15,
            ],
            [
                'name' => 'Tari Jaipong (Advanced)',
                'description' => 'Kelas tari Jaipong tingkat lanjut. Eksplorasi gerakan dinamis dan ekspresif khas Jawa Barat.',
                'instructor' => 'Ibu Dewi Kusuma',
                'schedule' => 'Rabu & Jumat, 18:00-20:00',
                'capacity' => 12,
            ],
            [
                'name' => 'Tari Tradisional Anak',
                'description' => 'Kelas khusus untuk anak-anak usia 6-12 tahun. Belajar berbagai tarian tradisional dengan cara yang menyenangkan.',
                'instructor' => 'Ibu Rina Safitri',
                'schedule' => 'Sabtu, 09:00-11:00',
                'capacity' => 25,
            ],
            [
                'name' => 'Kelas Privat Tari',
                'description' => 'Kelas privat one-on-one dengan instruktur berpengalaman. Jadwal fleksibel sesuai kebutuhan.',
                'instructor' => 'Berbagai Instruktur',
                'schedule' => 'Fleksibel (by appointment)',
                'capacity' => 1,
            ],
        ];

        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
}
