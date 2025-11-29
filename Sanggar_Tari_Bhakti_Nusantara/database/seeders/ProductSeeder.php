<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kostum Tari Saman',
                'description' => 'Kostum tradisional untuk tari Saman lengkap dengan aksesoris. Terbuat dari bahan berkualitas tinggi yang nyaman digunakan.',
                'price' => 350000,
                'stock' => 15,
            ],
            [
                'name' => 'Kostum Tari Pendet',
                'description' => 'Kostum Bali untuk tari Pendet dengan hiasan bunga dan kain tradisional. Tersedia dalam berbagai ukuran.',
                'price' => 450000,
                'stock' => 10,
            ],
            [
                'name' => 'Kipas Tari Pakarena',
                'description' => 'Kipas cantik untuk tari Pakarena dari Sulawesi Selatan. Terbuat dari bahan bambu dan kain sutra.',
                'price' => 150000,
                'stock' => 25,
            ],
            [
                'name' => 'Selendang Tari Jaipong',
                'description' => 'Selendang warna-warni untuk tari Jaipong. Terbuat dari sutra halus dengan motif tradisional.',
                'price' => 120000,
                'stock' => 30,
            ],
            [
                'name' => 'Paket Properti Tari Lengkap',
                'description' => 'Paket lengkap properti tari untuk berbagai jenis tarian tradisional Indonesia. Cocok untuk sanggar atau sekolah.',
                'price' => 2500000,
                'stock' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
