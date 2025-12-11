<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'hero_title',
                'value' => 'Warisan Budaya dalam Setiap Gerakan',
                'type' => 'text',
                'description' => 'Hero section main title'
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Bergabunglah dengan kami untuk mempelajari tari tradisional Nusantara dan mengembangkan potensi seni Anda.',
                'type' => 'text',
                'description' => 'Hero section subtitle'
            ],
            [
                'key' => 'since_year',
                'value' => '2012',
                'type' => 'text',
                'description' => 'Year when sanggar was established'
            ],
            [
                'key' => 'since_text',
                'value' => 'Melayani Pendidikan Seni Tari',
                'type' => 'text',
                'description' => 'Since year description text'
            ],
            [
                'key' => 'about_vision',
                'value' => 'Menjadi pusat keunggulan seni tari tradisional Nusantara yang menginspirasi generasi muda untuk melestarikan dan mengembangkan budaya Indonesia.',
                'type' => 'text',
                'description' => 'About section vision statement'
            ],
            [
                'key' => 'about_mission',
                'value' => json_encode([
                    'Melestarikan warisan budaya tari Indonesia melalui pembelajaran yang berkualitas',
                    'Mengembangkan karakter disiplin, percaya diri, dan kreativitas melalui seni tari',
                    'Menciptakan komunitas pembelajar yang solid dan saling mendukung',
                    'Memberikan panggung bagi siswa untuk mengekspresikan bakat mereka'
                ]),
                'type' => 'json',
                'description' => 'About section mission points'
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
