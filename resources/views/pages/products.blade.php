@extends('layouts.app')

@section('content')
    @php
        $productCards = [
            ['title' => 'This outstanding object', 'description' => 'Call out a feature, benefit, or value of produk unggulan yang dapat berdiri sendiri.', 'background' => 'radial-gradient(circle at center, #F5F6DB 0%, #D9E1C2 60%, #E9EACD 100%)'],
            ['title' => 'This astounding article', 'description' => 'Kartu membantu Anda menampilkan koleksi produk, layanan, atau studi kasus dengan fleksibel.', 'background' => 'radial-gradient(circle at top, #F4E7D5 0%, #D9C8AA 55%, #EBDDC6 100%)'],
            ['title' => 'This brilliant bit', 'description' => 'Tambahkan lebih banyak kartu untuk membuat kisi sesuai ukuran dan bentuk yang dibutuhkan.', 'background' => 'radial-gradient(circle at center, #D4F0E7 0%, #9FC8C4 55%, #BFDCD6 100%)'],
        ];

        $productGrid = [];
        for ($i = 0; $i < 3; $i++) {
            foreach ($productCards as $card) {
                $productGrid[] = $card;
            }
        }
    @endphp

    <section class="bg-linear-to-b from-white via-[#FFF9E5] to-[#FFF6D5] text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-14 space-y-12">
            <div class="space-y-4">
                <span class="inline-flex items-center gap-2 text-sm font-semibold text-[#F5C85D] uppercase tracking-[0.35em]">Produk</span>
                <h1 class="text-3xl lg:text-5xl font-semibold text-[#242424]">Koleksi Pilihan Bhakti Nusantara</h1>
                <p class="max-w-2xl text-sm lg:text-base text-black/70 leading-relaxed">Eksplorasi paket pentas, kostum, serta materi pembelajaran terkurasi untuk mendukung pengalaman seni tari yang lebih berkesan.</p>
            </div>
            <div class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($productGrid as $product)
                    <article class="flex flex-col overflow-hidden rounded-[28px] border border-white/10 bg-white/5 backdrop-blur">
                        <div class="h-40 w-full" style="background-image: {{ $product['background'] }}; background-size: cover;"></div>
                        <div class="flex flex-col gap-4 p-6 bg-white text-[#2E2E2E]">
                            <h3 class="text-lg font-semibold">{{ $product['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-[#4F4F4F]">{{ $product['description'] }}</p>
                            <a href="mailto:info@bhaktinusantara.id" class="inline-flex items-center gap-2 text-sm font-semibold text-[#8C6A08]">
                                Call to action
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75 6.75M19.5 12l-6.75-6.75" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection
