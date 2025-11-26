@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden " style="background-image: var(--bg2); background-size: cover;">
        <!-- Efek Cahaya Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-1/4 w-[500px] h-[500px] rounded-full bg-gradient-to-br from-[#FEDA60]/20 via-[#F5B347]/10 to-transparent blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-[600px] h-[600px] rounded-full bg-gradient-to-tl from-[#FFE184]/15 via-[#FEDA60]/10 to-transparent blur-3xl"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-6 py-16 lg:py-14 grid gap-12 lg:grid-cols-[1.1fr_0.9fr] items-center">
           <div class="space-y-6 rounded-3xl p-8 backdrop-blur-xl bg-white/5 border border-[#FEDA60]/20 shadow-[0_0_25px_rgba(254,218,96,0.3)]">

    <span class="inline-flex px-4 py-1 rounded-full bg-[#FEDA60]/20 border border-[#FEDA60]/40 text-[#FEDA60] text-xs font-semibold uppercase tracking-[0.2em]">
        Sanggar Tari
    </span>

    <h1 class="text-3xl lg:text-5xl font-bold text-[#FEDA60] leading-tight">
        Bhakti Nusantara<br class="hidden lg:block"> 
        <span class="text-[#E2B136]">Ruang Ekspresi Tari Tradisional Indonesia</span>
    </h1>

    <p class="text-sm lg:text-base text-gray-300 max-w-xl leading-relaxed">
        Menghidupkan warisan budaya melalui gerak, irama, dan kreativitas. Kami menghadirkan pelatihan terpadu untuk anak hingga dewasa dengan kurikulum seni tari yang modern namun berakar kuat pada tradisi Nusantara.
    </p>

    <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ route('register') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-sm font-bold shadow-lg shadow-[#FEDA60]/40 hover:shadow-xl hover:scale-[1.05] transition-all">Daftar Sekarang</a>
        <a href="{{ route(name: 'products') }}" class="px-6 py-3 rounded-full text-[#FEDA60] border-2 border-[#FEDA60] text-sm font-semibold hover:bg-[#FEDA60]/10 transition-all">Lihat Produk</a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4">
        <div class="rounded-2xl backdrop-blur-xl bg-white/5 border border-[#FEDA60]/20 p-4 shadow-lg text-center hover:bg-white/10 transition-all">
            <p class="text-2xl font-bold text-[#FEDA60]">12+</p>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em]">Tahun Eksis</p>
        </div>
        <div class="rounded-2xl bg-white/5 border border-[#FEDA60]/20 p-4 shadow-lg text-center hover:bg-white/10 transition-all">
            <p class="text-2xl font-bold text-[#FEDA60]">35+</p>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em]">Koreografi</p>
        </div>
        <div class="rounded-2xl bg-white/5 border border-[#FEDA60]/20 p-4 shadow-lg text-center hover:bg-white/10 transition-all">
            <p class="text-2xl font-bold text-[#FEDA60]">120+</p>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em]">Siswa Aktif</p>
        </div>
        <div class="rounded-2xl bg-white/5 border border-[#FEDA60]/20 p-4 shadow-lg text-center hover:bg-white/10 transition-all">
            <p class="text-2xl font-bold text-[#FEDA60]">28</p>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em]">Penghargaan</p>
        </div>
    </div>

  </div>

            {{-- <div class="relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_#FEDA60_0%,_transparent_65%)] blur-3xl"></div>
                <div class="relative rounded-[36px] border border-[#FEDA60]/60 bg-white shadow-2xl overflow-hidden">
                    <div class="absolute -top-16 -left-24 h-52 w-52 rounded-full bg-gradient-to-br from-[#FFE184] via-[#FBCF6E] to-[#F5B347] opacity-60"></div>
                    <div class="absolute bottom-[-20%] right-[-10%] h-56 w-56 rounded-full bg-[conic-gradient(from_120deg,_#FFF3B8,_#FEDA60,_#F4BD4D,_#FFF3B8)] opacity-70"></div>
                    <div class="relative p-8 lg:p-10 space-y-6">
                        <div class="flex items-center justify-between">
                            <span class="px-4 py-2 rounded-full bg-[#FFF2B5] text-[#8C6A08] text-xs font-semibold uppercase tracking-[0.3em]">Showcase</span>
                            <span class="text-sm font-semibold text-[#8C6A08]">Batch 2025</span>
                        </div>
                        <div class="rounded-3xl bg-gradient-to-br from-[#FFE184] via-[#FBD067] to-[#F6B643] text-[#E2B136] p-6 shadow-lg space-y-4">
                            <div class="flex items-center justify-between">
                                <p class="text-lg font-semibold">Festival Tari Kreasi</p>
                                <span class="px-3 py-1 rounded-full bg-white/70 text-xs font-semibold uppercase tracking-[0.2em] text-[#8C6A08]">12 Mei</span>
                            </div>
                            <p class="text-sm text-[#4F4F4F] leading-relaxed opacity-90">Latihan intensif untuk koreografi panggung utama dengan fokus pada ekspresi dan transisi dinamis.</p>
                            <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-[#8C6A08]">
                                <span>Studio A</span>
                                <span>18.00 WIB</span>
                            </div>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-[#FEDA60]/60 bg-white/70 p-5 shadow-sm space-y-3">
                                <p class="text-sm font-semibold text-[#2E2E2E]">Kelas Teknik</p>
                                <p class="text-xs text-[#4F4F4F] leading-relaxed opacity-90">Latihan postur, fleksibilitas, dan isolasi gerak setiap Selasa &amp; Kamis.</p>
                                <span class="inline-flex items-center gap-2 text-xs font-semibold text-[#8C6A08]">Daftar <span class="h-1 w-8 rounded-full bg-[#FEDA60]"></span></span>
                            </div>
                            <div class="rounded-2xl border border-[#FEDA60]/60 bg-white/70 p-5 shadow-sm space-y-3">
                                <p class="text-sm font-semibold text-[#2E2E2E]">Mentoring Koreografi</p>
                                <p class="text-xs text-[#4F4F4F] leading-relaxed opacity-90">Pendampingan personal untuk penyusunan karya solo dan duet.</p>
                                <span class="inline-flex items-center gap-2 text-xs font-semibold text-[#8C6A08]">Jadwalkan <span class="h-1 w-8 rounded-full bg-[#FEDA60]"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="relative">
    <!-- Efek cahaya belakang -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_#FEDA60_0%,_transparent_65%)] blur-3xl"></div>

    <!-- Card utama -->
    {{-- <div class="relative rounded-[36px] border border-[#FEDA60]/60 bg-white shadow-2xl overflow-hidden">
        <!-- Ornamen dekoratif -->
        <div class="absolute -top-16 -left-24 h-52 w-52 rounded-full bg-gradient-to-br from-[#FFE184] via-[#FBCF6E] to-[#F5B347] opacity-60"></div>
        <div class="absolute bottom-[-20%] right-[-10%] h-56 w-56 rounded-full bg-[conic-gradient(from_120deg,_#FFF3B8,_#FEDA60,_#F4BD4D,_#FFF3B8)] opacity-70"></div>

        <!-- Konten gambar -->
        <div class="relative p-8 lg:p-10 space-y-6">
            <div class="flex items-center justify-between">
                <span class="px-4 py-2 rounded-full bg-[#FFF2B5] text-[#8C6A08] text-xs font-semibold uppercase tracking-[0.3em]">Gallery</span>
                <span class="text-sm font-semibold text-[#8C6A08]">Batch 2025</span>
            </div>

            <!-- Gambar utama -->
            <div class="rounded-3xl overflow-hidden shadow-lg border border-[#FEDA60]/50">
                <img src="https://cdn.antaranews.com/cache/1200x800/2024/07/06/18_1.jpg" alt="Festival Tari Kreasi" class="w-full h-64 object-cover">
            </div>

            <!-- Keterangan di bawah gambar -->
            <div class="text-center space-y-2">
                <p class="text-lg font-semibold text-[#2E2E2E]">Festival Tari Kreasi</p>
                <p class="text-sm text-[#4F4F4F] opacity-90 leading-relaxed">
                    Dokumentasi latihan intensif dan pertunjukan seni tari modern oleh peserta Batch 2025.
                </p>
            </div>
        </div>
    </div> --}}
</div>

        </div>
    </section>

    <section class=" py-16 lg:py-24 " id="tentang " style="background-image: var(--bgbatik2); background-size: cover;">
        <div class="max-w-7xl mx-auto px-6 grid gap-12 lg:grid-cols-[0.9fr_1.1fr] items-center">
        <div class="relative">
            {{-- <div class="absolute -inset-6 rounded-[36px] bg-[#FFF3B8]/60 -z-10"></div>
            <div class="relative rounded-[32px] border border-[#FEDA60]/60 bg-white shadow-xl overflow-hidden p-8 space-y-6">
                <div class="absolute -top-14 right-10 h-40 w-40 rounded-full bg-[radial-gradient(circle_at_center,_#FFE9A9,_#F6B643)] opacity-70"></div>
                <div class="absolute bottom-[-20%] left-10 h-48 w-48 rounded-full bg-[conic-gradient(from_45deg,_#FFF3C4,_#FEDA60,_#F4BD4D,_#FFF3C4)] opacity-70"></div>
                <div class="relative grid gap-4">
                    <div class="rounded-3xl bg-gradient-to-br from-[#FFE89F] via-[#F9CE63] to-[#F6B643] p-6 text-[#E2B136] shadow-lg">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#8C6A08]">Studio</p>
                        <p class="text-xl font-semibold mt- text-[#242424]">Ruang Tari Bhakti Nusantara</p>
                        <p class="text-sm text-[#E2B136] leading-relaxed opacity-90 mt-3 text-black/70">Studio berlantai kayu, cermin panorama, dan sistem audio profesional untuk mendukung latihan intensif.</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-[#FEDA60]/50 bg-white/80 p-5 shadow-sm space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Fasilitas</p>
                            <p class="text-sm font-semibold text-[#2E2E2E]">Ruang Kostum</p>
                            <p class="text-xs text-[#E2B136] leading-relaxed opacity-90">Koleksi busana lengkap dari Sabang sampai Merauke.</p>
                        </div>
                        <div class="rounded-2xl border border-[#FEDA60]/50 bg-white/80 p-5 shadow-sm space-y-2">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Fasilitas</p>
                            <p class="text-sm font-semibold text-[#2E2E2E]">Studio Musik</p>
                            <p class="text-xs text-[#E2B136] leading-relaxed opacity-90">Peralatan gamelan dan musik pengiring modern.</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="space-y-8">
            @include('components.ui.section-heading', [
                'subtitle' => 'Tentang Sanggar',
                'title' => 'Seni Tari Sebagai Media Belajar Nilai Hidup',
                'description' => 'Kami percaya bahwa gerakan tari menyimpan filosofi hidup. Program Bhakti Nusantara dirancang untuk mengasah teknik, disiplin, dan karakter sambil menikmati kekayaan budaya Indonesia.'
            ])
            <div class="grid gap-6 sm:grid-cols-2">
                <div class="rounded-2xl bg-white border border-[#F1D98C] p-6 space-y-2">
                    <h3 class="text-lg font-semibold text-[#2E2E2E]">Kurasi Tari Nusantara</h3>
                    <p class="text-sm text-[#E2B136]">Materi kami mencakup tari tradisional dari Sabang sampai Merauke dengan pendekatan inovatif.</p>
                </div>
                <div class="rounded-2xl bg-white border border-[#F1D98C] p-6 space-y-2">
                    <h3 class="text-lg font-semibold text-[#2E2E2E]">Pelatih Profesional</h3>
                    <p class="text-sm text-[#E2B136]">Dipandu pengajar berpengalaman yang aktif di panggung nasional dan internasional.</p>
                </div>
                <div class="rounded-2xl bg-white border border-[#F1D98C] p-6 space-y-2">
                    <h3 class="text-lg font-semibold text-[#2E2E2E]">Fasilitas Lengkap</h3>
                    <p class="text-sm text-[#E2B136]">Studio nyaman dengan ruang ganti, audio profesional, dan galeri kostum.</p>
                </div>
                <div class="rounded-2xl bg-white border border-[#F1D98C] p-6 space-y-2">
                    <h3 class="text-lg font-semibold text-[#2E2E2E]">Komunitas Kuat</h3>
                    <p class="text-sm text-[#E2B136]">Jaringan alumni yang aktif berbagi ilmu dan kolaborasi lintas daerah.</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="bg-[#FFF6D5] py-16 lg:py-24" id="program">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            @include('components.ui.section-heading', [
                'subtitle' => 'Program Unggulan',
                'title' => 'Kelas Tari untuk Semua Tingkatan',
                'description' => 'Dari kelas dasar hingga tingkat profesional, setiap kurikulum dirancang berjenjang dengan evaluasi berkala dan kesempatan tampil di panggung.'
            ])
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['title' => 'Kelas Anak & Remaja', 'desc' => 'Fundamental gerak, eksplorasi ritme, dan pengenalan kostum tradisi.'],
                    ['title' => 'Kelas Dewasa', 'desc' => 'Pendalaman teknik koreografi, eksplorasi karakter, dan penataan panggung.'],
                    ['title' => 'Regu Pertunjukan', 'desc' => 'Program intensif untuk persiapan festival dan kompetisi nasional.'],
                ] as $program)
                    <article class="rounded-3xl bg-white border border-[#E2B136]/30 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                        <h3 class="text-xl font-semibold text-[#2E2E2E]">{{ $program['title'] }}</h3>
                        <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ $program['desc'] }}</p>
                        <a href="{{ route('products') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#8C6A08]">Detail Produk
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75 6.75M19.5 12l-6.75-6.75" />
                            </svg>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 lg:py-24" id="jadwal">
        <div class="max-w-7xl mx-auto px-6 space-y-10">
        @include('components.ui.section-heading', [
            'subtitle' => 'Jadwal Mingguan',
            'title' => 'Latihan Terstruktur Menyesuaikan Usia dan Level',
            'description' => 'Setiap peserta mendapatkan kelas sesuai kelompok usia dan kemampuan dengan kuota terbatas agar pelatih dapat fokus pada perkembangan individu.'
        ])
        <div class="bg-white border border-[#FEDA60]/40 rounded-3xl overflow-hidden shadow-lg shadow-[#FEDA60]/10">
            <div class="grid gap-0 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['day' => 'Senin', 'time' => '16.00 - 18.00', 'level' => 'Anak Dasar'],
                    ['day' => 'Rabu', 'time' => '16.00 - 18.00', 'level' => 'Remaja Lanjutan'],
                    ['day' => 'Jumat', 'time' => '19.00 - 21.00', 'level' => 'Dewasa'],
                    ['day' => 'Sabtu', 'time' => '09.00 - 12.00', 'level' => 'Regu Pertunjukan'],
                ] as $schedule)
                    <div class="p-8 border-[#FEDA60]/30 {{ !$loop->last ? 'border-b sm:border-b-0 sm:border-r' : '' }}">
                        <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-[0.3em]">{{ $schedule['day'] }}</p>
                        <p class="text-xl font-semibold mt-3 text-[#2E2E2E]">{{ $schedule['time'] }}</p>
                        <p class="text-sm text-[#4F4F4F] mt-1">{{ $schedule['level'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>

    <section class="bg-[#FFF6D5] py-16 lg:py-24" id="galeri">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            @include('components.ui.section-heading', [
                'subtitle' => 'Galeri Kegiatan',
                'title' => 'Momen Terbaik di Panggung dan Studio',
                'description' => 'Dokumentasi perjalanan Bhakti Nusantara dalam berbagai festival, pentas sekolah, hingga kolaborasi lintas budaya.'
            ])
            <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 rounded-[28px] overflow-hidden shadow-xl border border-[#FEDA60]/50 bg-white relative">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_#FFF3C4,_#FEDA60_55%,_#F5B347_100%)] opacity-80"></div>
                <div class="relative p-8 lg:p-12 h-full">
                    <div class="grid gap-6 lg:grid-cols-2 h-full">
                        <div class="rounded-3xl bg-white/70 border border-[#FEDA60]/40 p-6 shadow flex flex-col justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Highlight</p>
                                <h3 class="text-xl font-semibold text-[#E2B136] mt-2">Panggung Kolaborasi</h3>
                                <p class="text-sm text-[#4F4F4F] leading-relaxed opacity-90 mt-3">Kolaborasi lintas daerah dengan koreografi yang memadukan gerak kontemporer dan tradisi Bali.</p>
                            </div>
                            <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-[#8C6A08] mt-6">
                                <span>Backstage</span>
                                <span>2024</span>
                            </div>
                        </div>
                        <div class="grid gap-4">
                            <div class="rounded-3xl bg-white/70 border border-[#FEDA60]/40 p-5 shadow-sm space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Ekspresi</p>
                                <p class="text-sm font-semibold text-[#2E2E2E]">Detail Kostum</p>
                                <p class="text-xs text-[#4F4F4F] leading-relaxed opacity-90">Eksplorasi motif nusantara untuk generasi muda.</p>
                            </div>
                            <div class="rounded-3xl bg-white/70 border border-[#FEDA60]/40 p-5 shadow-sm space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Momentum</p>
                                <p class="text-sm font-semibold text-[#2E2E2E]">Latihan Akhir</p>
                                <p class="text-xs text-[#4F4F4F] leading-relaxed opacity-90">Intensif menjelang pertunjukan nasional.</p>
                            </div>
                            <div class="rounded-3xl bg-white/70 border border-[#FEDA60]/40 p-5 shadow-sm space-y-2">
                                <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08]">Komunitas</p>
                                <p class="text-sm font-semibold text-[#2E2E2E]">Forum Alumni</p>
                                <p class="text-xs text-[#4F4F4F] leading-relaxed opacity-90">Berbagi pengalaman dan peluang kolaborasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="space-y-6">
                    @foreach ([
                        ['title' => 'Festival Budaya 2024', 'desc' => 'Kolaborasi dengan seniman daerah untuk menampilkan tari kreasi kontemporer.'],
                        ['title' => 'Kelas Master Workshop', 'desc' => 'Latihan intensif dengan koreografer tamu dari Bali dan Yogyakarta.'],
                        ['title' => 'Tur Sekolah & Komunitas', 'desc' => 'Program edukasi tari untuk siswa sekolah dasar dan menengah.'],
                    ] as $item)
                        <article class="rounded-2xl bg-white border border-[#E2B136]/30 p-6 space-y-2 shadow-lg shadow-[#FEDA60]/10">
                            <h3 class="text-lg font-semibold text-[#2E2E2E]">{{ $item['title'] }}</h3>
                            <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ $item['desc'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-6xl mx-auto px-6 space-y-10">
        @include('components.ui.section-heading', [
            'subtitle' => 'Testimoni',
            'title' => 'Cerita Para Penari dan Orang Tua',
            'description' => 'Pengalaman nyata belajar di Bhakti Nusantara yang membawa perubahan positif pada percaya diri, disiplin, dan apresiasi budaya.'
        ])
        <div class="grid gap-6 lg:grid-cols-3">
            @foreach ([
                ['name' => 'Nadira Putri', 'role' => 'Siswa Regu Pertunjukan', 'quote' => 'Pelatih selalu memberi koreksi detail dan motivasi. Saya mendapat kesempatan tampil di festival tingkat provinsi.'],
                ['name' => 'Agus Santoso', 'role' => 'Orang Tua Siswa', 'quote' => 'Programnya terstruktur, ada laporan perkembangan berkala, dan anak saya jadi lebih disiplin serta percaya diri.'],
                ['name' => 'Sari Pramudita', 'role' => 'Alumni', 'quote' => 'Komunitasnya hangat dan sangat mendukung. Kini saya menjadi pengajar tari di sekolah, bekal dari sanggar sangat berguna.'],
            ] as $testimonial)
                <blockquote class="h-full rounded-3xl bg-white border border-[#E2B136]/30 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10">
                    <p class="text-sm leading-relaxed text-[#4F4F4F]">“{{ $testimonial['quote'] }}”</p>
                    <div class="pt-4 border-t border-[#FEDA60]/30">
                        <p class="text-sm font-semibold text-[#2E2E2E]">{{ $testimonial['name'] }}</p>
                        <p class="text-xs text-[#8C6A08] uppercase tracking-[0.3em]">{{ $testimonial['role'] }}</p>
                    </div>
                </blockquote>
            @endforeach
        </div>
        </div>
    </section>

    <section class="bg-white pb-20">
        <div class="max-w-5xl mx-auto px-6">
        <div class="rounded-[32px] bg-gradient-to-br from-[#2E2E2E] via-[#1a1a1a] to-[#2E2E2E] text-white px-8 py-12 lg:px-16 lg:py-16 flex flex-col lg:flex-row items-start lg:items-center gap-8 shadow-2xl border border-[#FEDA60]/20 relative overflow-hidden">
            <!-- Efek cahaya -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#FEDA60]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#F5B347]/10 rounded-full blur-3xl"></div>
            
            <div class="relative space-y-3 flex-1">
                <h2 class="text-2xl lg:text-4xl font-bold text-[#FEDA60]">Siap Bergabung dengan Bhakti Nusantara?</h2>
                <p class="text-sm lg:text-base text-gray-300 leading-relaxed">Daftarkan diri Anda untuk sesi trial gratis dan rasakan atmosfer latihan di studio kami. Tim kami siap membantu menentukan kelas terbaik.</p>
            </div>
            <a href="mailto:info@bhaktinusantara.id" class="relative px-8 py-4 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] text-sm font-bold shadow-lg hover:shadow-xl hover:scale-[1.05] transition-all whitespace-nowrap">Booking Trial</a>
        </div>
        </div>
    </section>
@endsection
