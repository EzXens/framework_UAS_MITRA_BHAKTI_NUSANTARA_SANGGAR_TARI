<footer class="bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E] text-white relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#FEDA60] rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-[#FEDA60] rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-8 py-16">
        <div class="grid gap-12 lg:grid-cols-12">

            <!-- BRAND COLUMN -->
            <div class="lg:col-span-4 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#FEDA60] rounded-xl blur-lg opacity-30"></div>
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Bhakti Nusantara" class="relative h-14 w-14 object-contain">
                    </div>
                    <div>
                        <span class="text-xl font-bold text-[#FEDA60]">Bhakti Nusantara</span>
                        <div class="w-12 h-0.5 bg-[#FEDA60] rounded-full mt-1"></div>
                    </div>
                </div>
                <p class="text-gray-300 leading-relaxed text-base">
                    Sanggar tari Bhakti Nusantara menghadirkan pelestarian budaya melalui pelatihan intensif, pertunjukan berkualitas, dan komunitas kreatif bagi generasi muda.
                </p>
                <div class="pt-4 border-t border-white/10">
                    <p class="text-sm text-[#FEDA60] font-medium">Sejak 2024</p>
                    <p class="text-xs text-gray-400 mt-1">Melayani Pendidikan Seni Tari</p>
                </div>
            </div>

            <!-- NAVIGATION COLUMN -->
            <div class="lg:col-span-4 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-[#FEDA60] mb-6 relative">
                        Navigasi
                        <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-[#FEDA60] rounded-full"></div>
                    </h3>
                    <nav class="space-y-3">
                        @foreach([
                            ['route' => 'home', 'label' => 'Beranda'],
                            ['route' => 'about', 'label' => 'Tentang'],
                            ['route' => 'products', 'label' => 'Produk'],
                            ['route' => 'classes.public', 'label' => 'Kelas'],
                            ['route' => 'gallery', 'label' => 'Galeri'],
                            ['route' => 'contact', 'label' => 'Kontak']
                        ] as $item)
                            <a href="{{ route($item['route']) }}"
                               class="group flex items-center gap-3 text-gray-300 hover:text-[#FEDA60] transition-all duration-300 hover:translate-x-1">
                                <div class="w-1.5 h-1.5 bg-[#FEDA60] rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <span class="text-sm font-medium">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>

            <!-- CONTACT & SOCIAL COLUMN -->
            <div class="lg:col-span-4 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-[#FEDA60] mb-6 relative">
                        Hubungi Kami
                        <div class="absolute -bottom-2 left-0 w-8 h-0.5 bg-[#FEDA60] rounded-full"></div>
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 group">
                            <div class="w-10 h-10 rounded-lg bg-[#FEDA60]/10 border border-[#FEDA60]/20 flex items-center justify-center flex-shrink-0 group-hover:bg-[#FEDA60]/20 transition-colors">
                                <svg class="w-5 h-5 text-[#FEDA60]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="text-sm text-gray-300 leading-relaxed">
                                <p class="font-medium text-white">Jl. PM. Noor Perum Bumi Sempaja</p>
                                <p>Blok AB No.17 RT.001 Kec. Samarinda Utara</p>
                                <p>Samarinda Kalimantan Timur</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 group">
                            <div class="w-10 h-10 rounded-lg bg-[#FEDA60]/10 border border-[#FEDA60]/20 flex items-center justify-center flex-shrink-0 group-hover:bg-[#FEDA60]/20 transition-colors">
                                <svg class="w-5 h-5 text-[#FEDA60]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-300 font-medium">+62 812-581-8180</span>
                        </div>

                        <div class="flex items-center gap-3 group">
                            <div class="w-10 h-10 rounded-lg bg-[#FEDA60]/10 border border-[#FEDA60]/20 flex items-center justify-center flex-shrink-0 group-hover:bg-[#FEDA60]/20 transition-colors">
                                <svg class="w-5 h-5 text-[#FEDA60]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-300 font-medium">info@bhaktinusantara.id</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="flex justify-center border-t border-white/10 bg-black/20 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-400 text-center md:text-left">
                    © {{ date('Y') }} <span class="text-[#FEDA60] font-semibold">Bhakti Nusantara</span>.
                    Seluruh hak cipta dilindungi.
                </p>
            </div>
        </div>
    </div>
</footer>
