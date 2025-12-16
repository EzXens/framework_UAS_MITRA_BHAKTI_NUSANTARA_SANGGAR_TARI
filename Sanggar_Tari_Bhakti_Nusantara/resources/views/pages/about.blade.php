@extends('layouts.app')

@section('content')
    {{-- Hero Section with Enhanced Visual --}}
    
    <section class="relative overflow-hidden" style="background-image: url('{{ asset('images/bgbatik1.png') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] pointer-events-none z-0"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 lg:py-20 space-y-12">
        @include('components.ui.section-heading', [
            'subtitle' => 'Profil Sanggar',
            'title' => 'Bhakti Nusantara, Rumah Bagi Pecinta Tari Tradisional',
            'description' => 'Sejak 2012 kami mewadahi generasi muda untuk mempelajari dan menampilkan tari-tari Nusantara dengan standar pertunjukan profesional.'
        ])
        
        {{-- GRID (SYNC HEIGHT) --}}
        <div class="grid gap-12 lg:grid-cols-[1.1fr_0.9fr] items-stretch">

            {{-- LEFT COLUMN --}}
            <div class="space-y-8 h-full flex flex-col">

                {{-- VISI CARD --}}
                <article class="group rounded-3xl bg-white/80 backdrop-blur-sm border border-[#FEDA60]/40 p-8 space-y-4 shadow-lg shadow-[#FEDA60]/10 hover:shadow-2xl hover:shadow-[#FEDA60]/20 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F3B94A] flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-[#2E2E2E] mb-3">Visi</h3>
                            <p class="text-base text-[#4F4F4F] leading-relaxed">
                                {{ $visi }}
                            </p>
                        </div>
                    </div>
                </article>
                
                {{-- MISI CARD --}}
                <article class="group rounded-3xl bg-white/80 backdrop-blur-sm border border-[#FEDA60]/40 p-8 space-y-5 shadow-lg shadow-[#FEDA60]/10 hover:shadow-2xl hover:shadow-[#FEDA60]/20 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F3B94A] flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-[#2E2E2E] mb-4">Misi</h3>
                            <ul class="space-y-3 text-base text-[#4F4F4F] leading-relaxed">
                                @foreach($misi as $misiItem)
                                <li class="flex items-start gap-3">
                                    <span class="flex-shrink-0 w-1.5 h-1.5 rounded-full bg-[#FEDA60] mt-2"></span>
                                    <span>{{ $misiItem }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </article>

            </div>

            {{-- RIGHT COLUMN (IMAGE MATCH HEIGHT) --}}
            <div class="relative lg:sticky lg:top-8 h-full">
                <div class="absolute -inset-8 rounded-[10px] bg-gradient-to-br from-[#FEDA60]/30 to-[#F3B94A]/20 blur-3xl -z-10 animate-pulse"></div>

                <div class="relative rounded-[24px] border-2 border-[#FEDA60]/60 bg-white/90 backdrop-blur-sm shadow-2xl overflow-hidden p-2 h-full">

                    {{-- Decorative Elements --}}
                    <div class="absolute -top-20 right-[-12%] h-52 w-52 rounded-full bg-[conic-gradient(from_45deg,_#FFF4C6,_#FEDA60,_#F3B94A,_#FFF4C6)] opacity-60 blur-2xl"></div>
                    <div class="absolute bottom-[-20%] left-[-10%] h-60 w-60 rounded-full bg-[radial-gradient(circle_at_center,_#FFE9A9,_#F6B643)] opacity-50 blur-2xl"></div>

                    {{-- IMAGE --}}
                    <div class="relative rounded-2xl overflow-hidden group h-full">
                        <img src="{{ $aboutImage ? asset('storage/' . $aboutImage) : 'https://cdn.antaranews.com/cache/1200x800/2024/07/06/18_1.jpg' }}" 
                             alt="Festival Tari Kreasi" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                        <div class="absolute inset-0 bg-gradient-to-t from-[#2E2E2E]/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <p class="text-lg font-semibold mb-1">Festival Tari Kreasi</p>
                            <p class="text-sm opacity-90">Pertunjukan tahunan Bhakti Nusantara</p>
                        </div>
                    </div>

                    {{-- ACCENT BADGE --}}
                    <div class="absolute top-4 right-4 px-4 py-2 rounded-full bg-[#FEDA60] text-[#2E2E2E] text-xs font-semibold shadow-lg backdrop-blur-sm">
                        ✨ Sejak {{ $sinceYear }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


    {{-- Core Values Section with Enhanced Design --}}
    <section class="relative bg-gradient-to-br from-[#1a1a1a] via-[#2E2E2E] to-[#1a1a1a] overflow-hidden">
        {{-- Decorative Grid Pattern --}}
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #FEDA60 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 space-y-12 relative">
            @include('components.ui.section-heading', [
                'dark' => true,
                'subtitle' => 'Nilai Utama',
                'title' => 'Budaya, Kreativitas, dan Karakter',
                'description' => 'Setiap latihan dikemas untuk menanamkan rasa cinta terhadap budaya, kepekaan terhadap detail, serta sikap disiplin.'
            ])
            
            <div class="grid gap-8 lg:grid-cols-3">
                @foreach ([
                    ['title' => 'Pelestarian Budaya', 'desc' => 'Mempelajari filosofi di balik setiap gerak dan musik tradisi sebagai wujud penghargaan pada leluhur.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
                    ['title' => 'Inovasi Kreatif', 'desc' => 'Mendorong penari untuk bereksperimen dengan koreografi baru tanpa meninggalkan pakem.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>'],
                    ['title' => 'Pembinaan Karakter', 'desc' => 'Mengembangkan disiplin, kerja sama, dan kepemimpinan melalui kerja tim dalam produksi pertunjukan.', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>'],
                ] as $index => $item)
                    <article class="group relative rounded-3xl bg-gradient-to-br from-white/95 to-white/90 backdrop-blur-sm border border-[#FEDA60]/40 p-8 space-y-5 shadow-xl hover:shadow-2xl hover:shadow-[#FEDA60]/20 transition-all duration-300 hover:-translate-y-2" style="animation-delay: {{ $index * 100 }}ms;">
                        {{-- Icon Container --}}
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-[#FEDA60] to-[#F3B94A] rounded-2xl blur-xl opacity-50 group-hover:opacity-75 transition-opacity"></div>
                            <div class="relative w-full h-14 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F3B94A] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Content --}}
                        <div class="space-y-3">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">{{ $item['title'] }}</h3>
                            <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                        
                        {{-- Decorative Corner --}}
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-[#FEDA60]/10 to-transparent rounded-bl-[40px] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Instructors Section with Card Enhancement --}}
    <section class="relative" style="background-image: url('{{ asset('images/bgbatik2.png') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ffffff] via-[#FFF1C7]/80 to-[#FFF1C7] pointer-events-none z-0"></div>
        {{-- Decorative Background --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#FEDA60]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#F3B94A]/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 space-y-12 relative">
            @include('components.ui.section-heading', [
                'subtitle' => 'Instruktur Profesional',
                'title' => 'Tim Pengajar',
                'description' => 'Pelatih Bhakti Nusantara merupakan seniman aktif yang rutin tampil di festival Nusantara dan mendapat sertifikasi dari lembaga tari nasional.'
            ])
            
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @php
                            $colors = ['from-[#FEDA60]', 'from-[#F3B94A]', 'from-[#FFE9A9]', 'from-[#F6B643]'];
                        @endphp
                        @forelse($teachers as $teacher)
                            <article class="group relative rounded-3xl bg-white/90 backdrop-blur-sm border-2 border-[#FEDA60]/40 p-6 space-y-4 shadow-lg hover:shadow-2xl hover:shadow-[#FEDA60]/30 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
                                <a href="{{ route('teacher.show', $teacher) }}" class="absolute inset-0 z-10"></a>
                                {{-- Gradient Accent --}}
                                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r {{ $colors[$loop->index % 4] }} to-[#FEDA60] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                                
                                {{-- Avatar/Photo --}}
                                @if($teacher->photo)
                            <div class="relative w-16 h-16 rounded-2xl overflow-hidden shadow-lg mx-auto transform group-hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br {{ $colors[$loop->index % 4] }} to-[#F3B94A] flex items-center justify-center shadow-lg mx-auto transform group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Content --}}
                        <div class="text-center space-y-2">
                            <p class="text-lg font-bold text-[#2E2E2E]">{{ $teacher->name }}</p>
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8C6A08] font-semibold">{{ $teacher->position }}</p>
                            @if($teacher->specialization)
                                <p class="text-xs text-[#FEDA60] font-medium">{{ $teacher->specialization }}</p>
                            @endif
                            <div class="pt-2 border-t border-[#FEDA60]/30">
                                <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ Str::limit($teacher->bio, 100) }}</p>
                            </div>
                        </div>
                        
                        {{-- Experience Badge --}}
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-[#FFF0C2] text-[#8C6A08] text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            10+ Tahun
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-[#4F4F4F]">Belum ada data pengajar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
