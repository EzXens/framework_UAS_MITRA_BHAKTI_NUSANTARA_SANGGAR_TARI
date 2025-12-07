@extends('layouts.app')

@section('content')
    <style>
        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fade-up { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-fade-left { animation: fadeInLeft 0.8s ease-out forwards; }
        .animate-fade-right { animation: fadeInRight 0.8s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        [class*="animate-"] { opacity: 0; }

        /* --- Dark Glassmorphism (Black glass) --- */
        .glass-dark {
            background: rgba(12,12,12,0.48); /* gelap, semi-transparan */
            backdrop-filter: blur(10px) saturate(120%);
            -webkit-backdrop-filter: blur(10px) saturate(120%);
            border: 1px solid rgba(254,218,96,0.10);
            box-shadow: 0 6px 30px rgba(0,0,0,0.6);
            color: #EDEDED;
        }
        .glass-dark-strong {
            background: rgba(6,6,6,0.66);
            backdrop-filter: blur(12px) saturate(120%);
            -webkit-backdrop-filter: blur(12px) saturate(120%);
            border: 1px solid rgba(254,218,96,0.14);
            box-shadow: 0 10px 40px rgba(0,0,0,0.7);
            color: #FFF;
        }
        .glass-dark-soft {
            background: rgba(18,18,18,0.32);
            backdrop-filter: blur(8px) saturate(110%);
            -webkit-backdrop-filter: blur(8px) saturate(110%);
            border: 1px solid rgba(254,218,96,0.07);
            box-shadow: 0 6px 20px rgba(0,0,0,0.45);
            color: #F7F7F7;
        }

        /* helper: override utility bg-white/... supaya tidak menimpa */
        .bg-white\/5, .bg-white\/10, .bg-white\/70, .bg-white {
            background: transparent !important;
            color: inherit !important;
        }

        /* teks & tombol kontras pada glass gelap */
        .text-on-glass { color: #F3ECC2; }         /* teks deskriptif */
        .title-on-glass { color: #FEDA60; }       /* judul dengan aksen kuning */
        .muted-on-glass { color: #CFCFCF; }       /* teks pendukung */

        /* border / highlight kuning yang tetap lembut */
        .border-gold-soft { border-color: rgba(254,218,96,0.12) !important; }
        .shadow-gold { box-shadow: 0 6px 30px rgba(254,218,96,0.08) !important; }

        /* Carousel styles (keamanan kontras dipertahankan) */
        .carousel-container { position: relative; overflow: hidden; }
        .carousel-track { display: flex; transition: transform 0.5s ease-in-out; }
        .carousel-slide { min-width: 100%; }
        .carousel-dots { display: flex; justify-content: center; gap: 8px; margin-top: 16px; }
        .carousel-dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(254,218,96,0.25); cursor: pointer; transition: all 0.3s; }
        .carousel-dot.active { background: #FEDA60; transform: scale(1.2); }
        .carousel-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.55); color: #FEDA60; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; z-index: 10; transition: all 0.3s; }
        .carousel-btn:hover { background: rgba(0,0,0,0.8); }
        .carousel-btn.prev { left: 10px; }
        .carousel-btn.next { right: 10px; }

        /* Section Navigation */
        .section-nav {
            position: fixed;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 40;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .section-nav-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(254,218,96,0.3);
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        .section-nav-dot:hover {
            background: rgba(254,218,96,0.6);
            transform: scale(1.2);
        }
        .section-nav-dot.active {
            background: #FEDA60;
            border-color: #FEDA60;
            box-shadow: 0 0 10px rgba(254,218,96,0.5);
        }
        .section-nav-dot .tooltip {
            position: absolute;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(18,18,18,0.95);
            color: #FEDA60;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            pointer-events: none;
        }
        .section-nav-dot:hover .tooltip {
            opacity: 1;
            visibility: visible;
            right: 28px;
        }
        @media (max-width: 1023px) {
            .section-nav { display: none; }
        }

        /* Smooth scroll behavior */
        html { scroll-behavior: smooth; }
    </style>

    <!-- Section Navigation Dots -->
    <nav class="section-nav" id="sectionNav">
        <button class="section-nav-dot active" data-section="hero" onclick="scrollToSection('hero')">
            <span class="tooltip">Beranda</span>
        </button>
        <button class="section-nav-dot" data-section="tentang" onclick="scrollToSection('tentang')">
            <span class="tooltip">Tentang</span>
        </button>
        <button class="section-nav-dot" data-section="jadwal" onclick="scrollToSection('jadwal')">
            <span class="tooltip">Jadwal</span>
        </button>
        <button class="section-nav-dot" data-section="testimoni" onclick="scrollToSection('testimoni')">
            <span class="tooltip">Testimoni</span>
        </button>
        <button class="section-nav-dot" data-section="cta" onclick="scrollToSection('cta')">
            <span class="tooltip">Gabung</span>
        </button>
    </nav>

    <!-- Hero Section with Carousel -->
    <section id="hero" class="relative min-h-screen flex items-center overflow-hidden" style="background-image: url('{{ asset('images/bgtari.jpg') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/40 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-6 py-16 lg:py-20 grid gap-12 lg:grid-cols-2 items-center w-full">
            <!-- Hero Content -->
            <div class="space-y-6 rounded-3xl p-2">
                <span class="inline-flex px-4 py-1 rounded-full bg-[#FEDA60]/20 border border-[#FEDA60]/40 text-[#FEDA60] text-xs font-semibold uppercase tracking-[0.2em]">
                    Sanggar Tari
                </span>

                <h1 class="text-3xl lg:text-5xl font-bold title-on-glass leading-tight">
                    Bhakti Nusantara<br class="hidden lg:block">
                    <span class="text-[#FFFFFF]">Ruang Ekspresi Tari Tradisional Indonesia</span>
                </h1>

                <p class="text-sm lg:text-base text-on-glass max-w-xl leading-relaxed">
                    {{ $homepageTexts->get('hero_description')?->content ?? 'Menghidupkan warisan budaya melalui gerak, irama, dan kreativitas. Kami menghadirkan pelatihan terpadu untuk anak hingga dewasa dengan kurikulum seni tari yang modern namun berakar kuat pada tradisi Nusantara.' }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('classes.public') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-sm font-bold shadow-lg shadow-[#FEDA60]/40 hover:shadow-xl hover:scale-[1.05] transition-all">Daftar Kelas Sekarang</a>
                    <a href="{{ route('products') }}" class="px-6 py-3 rounded-full text-on-glass border-2 border-[#FEDA60] text-sm font-semibold hover:bg-[#FEDA60]/10 transition-all">Lihat Produk</a>
                </div>
            </div>

            <!-- Hero Carousel -->
            <div class="relative animate-fade-right delay-200">
                <div class="carousel-container rounded-3xl overflow-hidden border border-[#FEDA60]/30 shadow-2xl">
                    <div class="carousel-track" id="heroCarousel">
                        @forelse($homepageCarousels as $carousel)
                            <div class="carousel-slide">
                                <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" class="w-full h-80 lg:h-96 object-cover" title="{{ $carousel->title }}">
                            </div>
                        @empty
                            <div class="carousel-slide">
                                <img src="https://www.kahanjakhuang.or.id/an-component/media/upload-gambar-artikel/Nikah_Adat2.jpg" alt="Tari Tradisional 1" class="w-full h-80 lg:h-96 object-cover">
                            </div>
                            <div class="carousel-slide">
                                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg_rB2QsOhNl_CuaA-YtzrcN9LZqopoULw9ltg3hiKJmih6X7bxVA_X9RSo-VEbuVQnserQPK4GMnljWzxzoq9qKnmkXQvwaAWh1dHytG13yb67oeg1uvy_i0k5Hi8FoL64sUhjSdVi-kE7XWIlWPp_NJfWFqDK-hNBnYQV1e-PfpW0dma0WUBbiqQI7xbF/s1200/Seni%20Pertunjukan%20dari%20Kalimantan%20Timur_Tari%20Burung%20Enggang_Shutterstock%201560386843_Arya%20Dwiky%20Fadilah.jpg" alt="Tari Tradisional 2" class="w-full h-80 lg:h-96 object-cover">
                            </div>
                            <div class="carousel-slide">
                                <img src="https://cdn.antaranews.com/cache/1200x800/2024/07/06/18_1.jpg" alt="Tari Tradisional 3" class="w-full h-80 lg:h-96 object-cover">
                            </div>
                        @endforelse
                    </div>
                    <button class="carousel-btn prev" onclick="moveCarousel(-1)">&#10094;</button>
                    <button class="carousel-btn next" onclick="moveCarousel(1)">&#10095;</button>
                </div>
                <div class="carousel-dots" id="carouselDots">
                    @foreach($homepageCarousels->isNotEmpty() ? $homepageCarousels : collect([1,2,3]) as $key => $item)
                        <span class="carousel-dot {{ $key === 0 ? 'active' : '' }}" onclick="goToSlide({{ $key }})"></span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-[#FEDA60]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="min-h-screen flex items-center py-20 lg:py-28 relative overflow-hidden bg-gradient-to-b from-white to-[#FFF7E0]" style="background-image: url('{{ asset('images/bgbatik2.png') }}'); background-size: cover;">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff]/80 via-[#FFF1C7]/60 to-[#FFF1C7]/80 pointer-events-none z-0"></div>

        <div class="relative max-w-7xl mx-auto px-6 w-full">
            <!-- Heading Card -->
            <div class="bg-white/60 backdrop-blur-xl text-center rounded-2xl mb-6 animate-fade-up">
                <div class="border border-[#F5D577]/40 rounded-[32px] shadow-lg p-10">
                    @include('components.ui.section-heading', [
                        'subtitle' => 'Tentang Sanggar',
                        'title' => 'Seni Tari Sebagai Media Belajar Nilai Hidup',
                        'description' => 'Kami percaya bahwa gerakan tari menyimpan filosofi hidup. Program Bhakti Nusantara dirancang untuk mengasah teknik, disiplin, dan karakter.',
                        'dark' => false,
                        'descWhite' => false
                    ])
                </div>
            </div>

            <!-- Feature Cards -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($homepageIcons as $icon)
                    <div class="rounded-2xl bg-white/60 backdrop-blur-xl border border-[#E6D8A1]/40 p-6 space-y-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-up" style="animation-delay:{{ ($loop->index * 100 + 100) }}ms">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center shadow-inner">
                            <i class="{{ $icon->icon_class }}"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $icon->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $icon->description ?? 'Fitur unggulan kami untuk memberikan pengalaman terbaik.' }}</p>
                    </div>
                @empty
                    <!-- Card 1 -->
                    <div class="rounded-2xl bg-white/60 backdrop-blur-xl border border-[#E6D8A1]/40 p-6 space-y-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-up" style="animation-delay:100ms">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center shadow-inner">
                            <!-- Inline SVG (globe-style) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Kurasi Tari Nusantara</h3>
                        <p class="text-sm text-gray-600">Materi kami mencakup tari tradisional dari Sabang sampai Merauke dengan pendekatan inovatif.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="rounded-2xl bg-white/60 backdrop-blur-xl border border-[#E6D8A1]/40 p-6 space-y-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-up" style="animation-delay:200ms">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center shadow-inner">
                            <!-- Inline SVG (coach-style) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Pelatih Profesional</h3>
                        <p class="text-sm text-gray-600">Dipandu pengajar berpengalaman yang aktif di panggung nasional dan internasional.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="rounded-2xl bg-white/60 backdrop-blur-xl border border-[#E6D8A1]/40 p-6 space-y-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-up" style="animation-delay:300ms">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center shadow-inner">
                            <!-- Inline SVG (facility-style) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Fasilitas Lengkap</h3>
                        <p class="text-sm text-gray-600">Studio nyaman dengan ruang ganti, audio profesional, dan galeri kostum.</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="rounded-2xl bg-white/60 backdrop-blur-xl border border-[#E6D8A1]/40 p-6 space-y-4 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-up" style="animation-delay:400ms">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center shadow-inner">
                            <!-- Inline SVG (community-style) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Komunitas Kuat</h3>
                        <p class="text-sm text-gray-600">Jaringan alumni yang aktif berbagi ilmu dan kolaborasi lintas daerah.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Custom Sections -->
    @forelse($homepageSections as $section)
        <section class="min-h-screen flex items-center {{ $loop->even ? 'bg-white' : 'bg-gradient-to-b from-white to-[#FFF9E6]' }} py-16 lg:py-24 relative overflow-hidden">
            <div class="absolute inset-0 opacity-3"></div>
            <div class="relative max-w-7xl mx-auto px-6 w-full">
                <div class="grid gap-12 lg:gap-16 lg:grid-cols-2 items-center {{ $loop->odd ? '' : 'lg:grid-cols-2-reverse' }}">
                    <!-- Content -->
                    <div class="space-y-6 animate-fade-up">
                        <div>
                            <p class="inline-flex px-4 py-1 rounded-full bg-[#FEDA60]/20 border border-[#FEDA60]/40 text-[#FEDA60] text-xs font-semibold uppercase tracking-[0.2em]">
                                {{ $section->label ?? 'Bagian Spesial' }}
                            </p>
                            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mt-4">{{ $section->title }}</h2>
                            <p class="text-lg text-gray-700 mt-3">{{ $section->subtitle }}</p>
                        </div>
                        <p class="text-base lg:text-lg text-gray-600 leading-relaxed max-w-lg">{{ $section->content }}</p>
                        @if($section->link)
                            <div class="pt-4">
                                <a href="{{ $section->link }}" class="inline-flex px-6 py-3 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-bold shadow-lg shadow-[#FEDA60]/40 hover:shadow-xl hover:scale-105 transition-all">
                                    Pelajari Lebih Lanjut
                                </a>
                            </div>
                        @endif
                    </div>
                    <!-- Image -->
                    <div class="relative animate-fade-right {{ $loop->odd ? 'lg:col-start-2' : 'lg:col-start-1' }}">
                        @if($section->image)
                            <div class="rounded-3xl overflow-hidden border-2 border-[#FEDA60]/30 shadow-2xl shadow-[#FEDA60]/20">
                                <img src="{{ Storage::url($section->image) }}" alt="{{ $section->title }}" class="w-full h-96 object-cover">
                            </div>
                        @else
                            <div class="rounded-3xl overflow-hidden border-2 border-[#FEDA60]/30 shadow-2xl bg-gradient-to-br from-[#FEDA60]/20 to-[#F5B347]/20 h-96 flex items-center justify-center">
                                <p class="text-gray-400 text-center">Gambar tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @empty
    @endforelse

    <!-- Schedule Section -->
    <section class="min-h-screen flex items-center bg-white py-16 lg:py-24 relative" id="jadwal">
        <div class="absolute inset-0 opacity-5"></div>
        <div class="relative max-w-7xl mx-auto px-6 space-y-10 w-full">
            <div class="rounded-3xl glass-dark border-gold-soft p-8 shadow-[0_0_20px_rgba(254,218,96,0.15)] animate-fade-up">
                @include('components.ui.section-heading', [
                    'subtitle' => 'Jadwal Mingguan',
                    'title' => 'Latihan Terstruktur Menyesuaikan Usia dan Level',
                    'description' => 'Setiap peserta mendapatkan kelas sesuai kelompok usia dan kemampuan dengan kuota terbatas agar pelatih dapat fokus pada perkembangan individu.',
                    'dark' => true,
                    'descWhite' => true
                ])
            </div>
            <div class="glass-dark-strong rounded-3xl overflow-hidden shadow-lg shadow-[#FEDA60]/10 animate-scale-in delay-200">
                <div class="grid gap-0 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([
                        ['day' => 'Senin', 'time' => '16.00 - 18.00', 'level' => 'Anak Dasar'],
                        ['day' => 'Rabu', 'time' => '16.00 - 18.00', 'level' => 'Remaja Lanjutan'],
                        ['day' => 'Jumat', 'time' => '19.00 - 21.00', 'level' => 'Dewasa'],
                        ['day' => 'Sabtu', 'time' => '09.00 - 12.00', 'level' => 'Regu Pertunjukan'],
                    ] as $schedule)
                        <div class="p-8 border-[#FEDA60]/30 {{ !$loop->last ? 'border-b sm:border-b-0 sm:border-r' : '' }} hover:bg-[#FEDA60]/5 transition-colors">
                            <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-[0.3em]">{{ $schedule['day'] }}</p>
                            <p class="text-xl font-semibold mt-3 text-on-glass">{{ $schedule['time'] }}</p>
                            <p class="text-sm muted-on-glass mt-1">{{ $schedule['level'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="galeri_kegiatan" class="min-h-screen flex items-center py-20 lg:py-28 relative overflow-hidden bg-gradient-to-b from-white to-[#FFF7E0]" style="background-image: url('{{ asset('images/bgbatik2.png') }}'); background-size: cover;">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff]/80 via-[#FFF1C7]/60 to-[#FFF1C7]/80 pointer-events-none z-0"></div>
        <div class="max-w-7xl mx-auto px-6 space-y-12 ">
            <div class="bg-white/60 backdrop-blur-xl text-center rounded-2xl p-8 shadow-[0_0_20px_rgba(254,218,96,0.15)]">
                @include('components.ui.section-heading', [
                    'subtitle' => 'Galeri Kegiatan',
                    'title' => 'Momen Terbaik di Panggung dan Studio',
                    'description' => 'Dokumentasi perjalanan Bhakti Nusantara dalam berbagai festival, pentas sekolah, hingga kolaborasi lintas budaya.',
                    'dark' => false,
                    'descWhite' => false
                ])
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-[28px] overflow-hidden shadow-xl border border-[#FEDA60]/50 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_#FFF3C4,_#FEDA60_55%,_#F5B347_100%)] opacity-80"></div>
                <div class="relative p-8 lg:p-12 h-full">
                    <div class="grid gap-6 lg:grid-cols-2 h-full">
                        <div class="rounded-3xl border border-[#FEDA60]/40 p-6 shadow flex flex-col justify-between bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-black font-normal">Highlight</p>
                                <h3 class="text-xl font-bold text-black mt-2">Panggung Kolaborasi</h3>
                                <p class="text-sm text-black leading-relaxed opacity-90 mt-3">Kolaborasi lintas daerah dengan koreografi yang memadukan gerak kontemporer dan tradisi Bali.</p>
                            </div>
                            <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-black mt-6">
                                <span>Backstage</span>
                                <span>2024</span>
                            </div>
                        </div>
                        <div class="grid gap-4">
                            <div class="rounded-3xl border border-[#FEDA60]/40 p-5 shadow-sm bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-black font-normal">Ekspresi</p>
                                <p class="text-sm font-bold text-black">Detail Kostum</p>
                                <p class="text-xs text-black leading-relaxed opacity-90">Eksplorasi motif nusantara untuk generasi muda.</p>
                            </div>
                            <div class="rounded-3xl border border-[#FEDA60]/40 p-5 shadow-sm bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-black font-normal">Momentum</p>
                                <p class="text-sm font-bold text-black">Latihan Akhir</p>
                                <p class="text-xs text-black leading-relaxed opacity-90">Intensif menjelang pertunjukan nasional.</p>
                            </div>
                            <div class="rounded-3xl border border-[#FEDA60]/40 p-5 shadow-sm bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-black font-normal">Komunitas</p>
                                <p class="text-sm font-bold text-black">Forum Alumni</p>
                                <p class="text-xs text-black leading-relaxed opacity-90">Berbagi pengalaman dan peluang kolaborasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div class="z-10">
                <div class="space-y-6 z-10">
                    @foreach ([
                        ['title' => 'Festival Budaya 2024', 'desc' => 'Kolaborasi dengan seniman daerah untuk menampilkan tari kreasi kontemporer.'],
                        ['title' => 'Kelas Master Workshop', 'desc' => 'Latihan intensif dengan koreografer tamu dari Bali dan Yogyakarta.'],
                        ['title' => 'Tur Sekolah & Komunitas', 'desc' => 'Program edukasi tari untuk siswa sekolah dasar dan menengah.'],
                    ] as $item)
                        <article class="rounded-2xl border border-[#E2B136]/30 p-6 space-y-2 shadow-lg shadow-[#FEDA60]/10 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] text-black">
                            <h3 class="text-lg font-bold text-black">{{ $item['title'] }}</h3>
                            <p class="text-sm text-black leading-relaxed">{{ $item['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="bg-white py-16 lg:py-15">
        <div class="max-w-7xl mx-auto px-8 space-y-10">
        @include('components.ui.section-heading', [
            'subtitle' => 'Testimoni',
            'title' => 'Cerita Para Penari dan Orang Tua',
            'description' => 'Pengalaman nyata belajar di Bhakti Nusantara yang membawa perubahan positif pada percaya diri, disiplin, dan apresiasi budaya.',
            'dark' => true,
            'descWhite' => true,
        ])
        <div class="grid gap-6 lg:grid-cols-3">
            @foreach ([
                ['name' => 'Nadira Putri', 'role' => 'Siswa Regu Pertunjukan', 'quote' => 'Pelatih selalu memberi koreksi detail dan motivasi. Saya mendapat kesempatan tampil di festival tingkat provinsi.'],
                ['name' => 'Agus Santoso', 'role' => 'Orang Tua Siswa', 'quote' => 'Programnya terstruktur, ada laporan perkembangan berkala, dan anak saya jadi lebih disiplin serta percaya diri.'],
                ['name' => 'Sari Pramudita', 'role' => 'Alumni', 'quote' => 'Komunitasnya hangat dan sangat mendukung. Kini saya menjadi pengajar tari di sekolah, bekal dari sanggar sangat berguna.'],
            ] as $testimonial)
                <blockquote class="h-full rounded-3xl glass-dark p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                    <p class="text-sm leading-relaxed muted-on-glass">“{{ $testimonial['quote'] }}”</p>
                    <div class="pt-4 border-t border-[#FEDA60]/30">
                        <p class="text-sm font-semibold text-on-glass">{{ $testimonial['name'] }}</p>
                        <p class="text-xs text-[#8C6A08] uppercase tracking-[0.3em]">{{ $testimonial['role'] }}</p>
                    </div>
                </blockquote>
            @endforeach
        </div>
        </div>
    </section>

    <section id="cta" class="bg-white  pb-20">
        <div class="max-w-7xl mx-auto px-8">
        <div class="rounded-[32px] bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E] text-white px-8 py-12 lg:px-16 lg:py-16 flex flex-col lg:flex-row items-start lg:items-center gap-8 shadow-2xl border border-[#FEDA60]/20 relative overflow-hidden">
            <!-- Efek cahaya -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#FEDA60]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#F5B347]/10 rounded-full blur-3xl"></div>

            <div class="relative space-y-3  flex-1">
                <h2 class="text-2xl lg:text-4xl font-bold title-on-glass">Siap Bergabung dengan Bhakti Nusantara?</h2>
                <p class="text-sm lg:text-base text-on-glass leading-relaxed">Daftarkan diri Anda untuk sesi trial gratis dan rasakan atmosfer latihan di studio kami. Tim kami siap membantu menentukan kelas terbaik.</p>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20tertarik%20untuk%20booking%20trial%20di%20Sanggar%20Bhakti%20Nusantara" target="_blank" class="relative px-8 py-4 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-sm font-bold shadow-lg hover:shadow-xl hover:scale-[1.05] transition-all whitespace-nowrap flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Booking Trial via WhatsApp
            </a>
        </div>
        </div>
    </section>

    <!-- Carousel & Section Navigation JavaScript -->
    <script>
        // Carousel functionality — seamless forward-only autoplay
        let currentSlide = 0;
        const trackElement = document.getElementById('heroCarousel');
        let originalSlideCount = 0;
        let autoplayTimer = null;
        const AUTOPLAY_INTERVAL = 5000;
        let isTransitioning = false;

        function updateCarouselTransform() {
            if (!trackElement) return;
            trackElement.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function updateDots() {
            const dots = document.querySelectorAll('.carousel-dot');
            let activeIndex = currentSlide;
            if (currentSlide === originalSlideCount) activeIndex = 0; // clone -> show first dot
            dots.forEach((dot, idx) => dot.classList.toggle('active', idx === activeIndex));
        }

        function moveCarousel(direction) {
            if (!trackElement || originalSlideCount <= 0 || isTransitioning) return;
            isTransitioning = true;
            // Only allow forward autoplay to loop seamlessly via cloned slide.
            currentSlide = currentSlide + direction;
            // Prevent going beyond cloned end when using arrows; clamp to cloned position
            if (currentSlide > originalSlideCount) currentSlide = originalSlideCount;
            if (currentSlide < 0) currentSlide = 0;
            trackElement.style.transition = 'transform 0.5s ease-in-out';
            updateCarouselTransform();
            updateDots();
        }

        function goToSlide(index) {
            if (!trackElement || originalSlideCount <= 0) return;
            isTransitioning = true;
            currentSlide = Math.max(0, Math.min(index, originalSlideCount - 1));
            trackElement.style.transition = 'transform 0.5s ease-in-out';
            updateCarouselTransform();
            updateDots();
        }

        function startAutoplay() {
            stopAutoplay();
            autoplayTimer = setInterval(() => moveCarousel(1), AUTOPLAY_INTERVAL);
        }

        function stopAutoplay() {
            if (autoplayTimer) { clearInterval(autoplayTimer); autoplayTimer = null; }
        }

        function setupSeamlessAutoplay() {
            if (!trackElement) return;
            const slides = Array.from(trackElement.children);
            originalSlideCount = slides.length;
            if (originalSlideCount <= 1) return;

            // Clone first slide and append to allow seamless forward loop
            const firstClone = slides[0].cloneNode(true);
            firstClone.setAttribute('data-clone', 'true');
            trackElement.appendChild(firstClone);

            // Ensure transform starts at 0
            trackElement.style.transition = 'none';
            currentSlide = 0;
            updateCarouselTransform();
            // force reflow then enable transition
            void trackElement.offsetWidth;
            trackElement.style.transition = 'transform 0.5s ease-in-out';

            // When reaching the cloned slide, jump back to the real first slide without animation
            trackElement.addEventListener('transitionend', () => {
                isTransitioning = false;
                if (currentSlide === originalSlideCount) {
                    // we've just moved onto the cloned first slide — jump to real first
                    trackElement.style.transition = 'none';
                    currentSlide = 0;
                    updateCarouselTransform();
                    // force reflow and restore transition for next moves
                    void trackElement.offsetWidth;
                    trackElement.style.transition = 'transform 0.5s ease-in-out';
                }
                updateDots();
            });

            // Start autoplay
            startAutoplay();

            // Optional: pause autoplay on hover
            trackElement.parentElement?.addEventListener('mouseenter', stopAutoplay);
            trackElement.parentElement?.addEventListener('mouseleave', startAutoplay);
        }

        // Initialize carousel
        setupSeamlessAutoplay();

        // Section Navigation
        const sections = ['hero', 'tentang', 'program', 'jadwal', 'galeri', 'testimoni', 'cta'];

        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                const headerHeight = document.getElementById('main-header')?.offsetHeight || 0;
                const targetPosition = section.offsetTop - headerHeight;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }
        }

        function updateActiveNavDot() {
            const scrollPosition = window.scrollY + window.innerHeight / 3;
            const navDots = document.querySelectorAll('.section-nav-dot');

            let currentSection = sections[0];

            sections.forEach(sectionId => {
                const section = document.getElementById(sectionId);
                if (section && section.offsetTop <= scrollPosition) {
                    currentSection = sectionId;
                }
            });

            navDots.forEach(dot => {
                const dotSection = dot.getAttribute('data-section');
                dot.classList.toggle('active', dotSection === currentSection);
            });
        }

        // Throttle scroll event
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            if (scrollTimeout) return;
            scrollTimeout = setTimeout(() => {
                updateActiveNavDot();
                scrollTimeout = null;
            }, 50);
        });

        // Initial check
        updateActiveNavDot();

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        document.querySelectorAll('[class*="animate-"]').forEach(el => {
            observer.observe(el);
        });

        // Responsive helpers: set header height CSS variable and adjust hero padding
        function adjustForHeader() {
            const header = document.getElementById('main-header');
            const hero = document.getElementById('hero');
            if (!header || !hero) return;
            const h = header.offsetHeight;
            document.documentElement.style.setProperty('--header-height', h + 'px');
            // ensure hero content is not hidden behind sticky header on small screens
            hero.style.paddingTop = (h + 12) + 'px';
        }

        // Close mobile nav when clicking navigation links (improves hamburger UX)
        function bindMobileNavLinks() {
            const mobileLinks = document.querySelectorAll('#nav-menu a.nav-link');
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');
            const navOverlay = document.getElementById('nav-overlay');
            if (!mobileLinks.length) return;
            mobileLinks.forEach(a => {
                a.addEventListener('click', () => {
                    // if menu is visible on small screens, trigger close
                    if (navMenu && !navMenu.classList.contains('hidden')) {
                        navMenu.classList.remove('active');
                        navMenu.classList.add('hidden');
                    }
                    if (navToggle) navToggle.classList.remove('is-active');
                    if (navOverlay) {
                        navOverlay.classList.remove('active');
                        navOverlay.classList.add('hidden');
                    }
                    if (navToggle) navToggle.setAttribute('aria-expanded', 'false');
                });
            });
        }

        // Run initial adjustments and bind
        window.addEventListener('load', () => {
            adjustForHeader();
            bindMobileNavLinks();
        });
        window.addEventListener('resize', adjustForHeader);
    </script>
@endsection
