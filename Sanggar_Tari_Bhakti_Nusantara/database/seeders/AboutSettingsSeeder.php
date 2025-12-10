<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Seed about section settings (Visi, Misi, Image, Since Year)
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'about_vision',
                'value' => 'Menjadi sanggar tari rujukan nasional yang mengedepankan pelestarian budaya, inovasi koreografi, dan pengembangan karakter melalui seni tari.',
                'type' => 'text',
                'description' => 'About section - Vision statement'
            ],
            [
                'key' => 'about_mission',
                'value' => json_encode([
                    'Menghadirkan kurikulum tari tradisional yang sistematis dan adaptif.',
                    'Memberikan fasilitas latihan dan panggung yang layak bagi penari.',
                    'Menjalin kolaborasi dengan komunitas budaya dan institusi pendidikan.',
                    'Mendorong penari untuk aktif berkarya dan berkompetisi secara sehat.'
                ]),
                'type' => 'json',
                'description' => 'About section - Mission points'
            ],
            [
                'key' => 'since_year',
                'value' => '2012',
                'type' => 'text',
                'description' => 'Sanggar established year'
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('About settings seeded successfully!');
    }
}
