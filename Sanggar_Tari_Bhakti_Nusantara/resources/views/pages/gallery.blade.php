@extends('layouts.app')

@section('content')
    <section class="bg-gradient-to-b from-white via-[#FFF9E5] to-[#FFF6D5] py-6">
        <div class="relative mx-auto max-w-7xl px-6 pb-12 pt-16 text-center">
            <span id="galeri-sanggar" class="inline-flex items-center gap-2 rounded-full border border-[#FEDA60]/60 bg-white/80 px-4 py-1 text-sm font-semibold uppercase tracking-[0.35em] text-[#8C6A08] shadow-sm shadow-[#FEDA60]/30">
                Galeri Sanggar
            </span>
            <h1 class="mt-6 text-3xl font-semibold text-[#2E2E2E] md:text-5xl md:leading-tight">
                Rangkaian Momen Bhakti Nusantara Dalam Satu Kanvas Digital
            </h1>
            <p class="mt-4 text-base text-[#4F4F4F] md:text-lg">
                Jelajahi koleksi gambar, video, dan musik yang menangkap semangat, dedikasi, dan harmoni setiap penampilan kami.
            </p>
            <div class="pointer-events-none absolute inset-x-6 -bottom-8 h-24 rounded-full bg-gradient-to-r from-[#FFF6D5]/0 via-[#FEDA60]/25 to-[#FFF6D5]/0 blur-2xl"></div>
        </div>

            @php
                // Data now comes from the controller via database
            @endphp

            {{-- carousel lama --}}
            {{-- <div class="mx-auto max-w-7xl px-6 pb-6">
                <div class="relative mx-auto max-w-7xl w-full px-6 h-[420px] overflow-hidden rounded-[32px] border border-white/40 bg-white/30 shadow-[0_22px_55px_-20px_rgba(254,218,96,0.55)] backdrop-blur-md md:h-[520px]" data-carousel>
                    <div class="flex h-full  transition-transform duration-700 ease-in-out" data-carousel-track>
                        @foreach ($carouselSlides as $slide)
                            <div class="relative flex h-full w-full flex-shrink-0" data-title="{{ $slide->title }}" data-description="{{ $slide->description }}">
                                <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" class="h-full w-full object-cover transition duration-[2500ms] ease-out will-change-transform" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/35 to-transparent"></div>
                                <div class="absolute bottom-10 left-6 right-6 hidden rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm lg:block">
                                    <p class="text-xs uppercase tracking-[0.4em] text-[#FEDA60]/90">Sorotan</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $slide->title }}</p>
                                    <p class="mt-1 text-sm text-white/75">{{ $slide->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="sr-only" data-carousel-title>{{ $carouselSlides->first()->title ?? '' }}</div>
                    <div class="sr-only" data-carousel-description>{{ $carouselSlides->first()->description ?? '' }}</div>

                    <div class="absolute inset-y-0 left-0 right-0 z-20 flex items-center justify-between px-4">
                        <button type="button" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/30 bg-white/70 text-[#2E2E2E] shadow-lg shadow-black/10 transition hover:bg-[#FEDA60] focus:outline-none focus:ring-2 focus:ring-[#FEDA60]/80" data-carousel-prev aria-label="Slide sebelumnya">
                            <span class="sr-only">Sebelumnya</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button type="button" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-white/30 bg-white/70 text-[#2E2E2E] shadow-lg shadow-black/10 transition hover:bg-[#FEDA60] focus:outline-none focus:ring-2 focus:ring-[#FEDA60]/80" data-carousel-next aria-label="Slide selanjutnya">
                            <span class="sr-only">Berikutnya</span>
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>

                    <div class="absolute bottom-6 z-20 flex w-full justify-center gap-2">
                        @foreach ($carouselSlides as $index => $slide)
                            <button type="button" class="h-2.5 rounded-full border border-white/50 transition-all duration-300 {{ $index === 0 ? 'w-8 bg-[#FEDA60]' : 'w-3 bg-white/40' }}" data-carousel-indicator="{{ $index }}" aria-label="Tampilkan {{ $slide->title }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div> --}}
            {{-- end of carousel lama --}}

            {{-- carousel baru 3d --}}
            <!-- ================= CAROUSEL 3D ================= -->
    <div class="relative w-full flex flex-col items-center justify-center py-30 overflow-hidden">

        <div id="carousel3d" class="relative flex items-center justify-center w-full h-[350px] sm:h-[400px]"
            style="perspective:2000px; transform-style:preserve-3d;">

            @foreach ($carouselSlides as $index => $slide)
                <div class="absolute transition-all duration-700 ease-in-out transform"
                    data-index="{{ $index }}">
                    <img src="{{ asset($slide->image) }}"
                        class="rounded-2xl shadow-2xl w-[700px] h-[500px] mx-auto object-cover" />

                    <!-- Caption / Optional -->
                    <div class="text-center mt-4">
                        <p class="text-lg font-semibold text-[#2E2E2E]">{{ $slide->title }}</p>
                        <p class="text-sm text-[#4F4F4F]">{{ $slide->description }}</p>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Tombol Navigasi -->
        <button id="prevBtn"
            class="absolute left-6 top-1/2 -translate-y-1/2 z-20 bg-[#FEDA60] text-black px-4 py-2 rounded-full shadow-lg">
            ❮
        </button>

        <button id="nextBtn"
            class="absolute right-6 top-1/2 -translate-y-1/2 z-20 bg-[#FEDA60] text-black px-4 py-2 rounded-full shadow-lg">
            ❯
        </button>

        <!-- Indikator Dot -->
        <div class="flex justify-center space-x-2 mt-6">
            @for ($i = 0; $i < $carouselSlides->count(); $i++)
                <button class="dot w-3 h-3 rounded-full bg-[#FEDA60]" onclick="goTo3D({{ $i }})"></button>
            @endfor
        </div>

    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides3D = document.querySelectorAll('#carousel3d [data-index]');
        const dots3D = document.querySelectorAll('.dot');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        let current3D = 0;

        function render3D() {
            slides3D.forEach((slide, i) => {
                const diff = i - current3D;
                const offset =
                    (diff > slides3D.length / 2) ? diff - slides3D.length :
                    (diff < -slides3D.length / 2) ? diff + slides3D.length :
                    diff;

                slide.style.opacity = (i === current3D) ? 1 : 0.85;
                slide.style.zIndex = (i === current3D) ? 20 : 10;
                slide.style.transform =
                    `translateX(${offset * 65}%) scale(${i === current3D ? 1 : 0.85}) rotateY(${offset * -45}deg)`;
                slide.style.filter = (i === current3D) ? 'none' : 'blur(1.5px) brightness(0.9)';
            });

            dots3D.forEach((dot, i) => {
                dot.classList.toggle('bg-[#FEDA60]', i === current3D);
                dot.classList.toggle('bg-gray-400', i !== current3D);
            });
        }

        function next3D() {
            current3D = (current3D + 1) % slides3D.length;
            render3D();
        }

        function prev3D() {
            current3D = (current3D - 1 + slides3D.length) % slides3D.length;
            render3D();
        }

        window.goTo3D = function(i) {
            current3D = i;
            render3D();
        }

        nextBtn.addEventListener('click', next3D);
        prevBtn.addEventListener('click', prev3D);

        setInterval(next3D, 5000);

        render3D();
    });
</script>
            {{-- end carousel baru 3d --}}
    </section>

    <section class="relative mx-auto max-w-7xl px-6 pb-20 pt-12 lg:pt-16">
        <div class="pointer-events-none absolute inset-x-0 top-8 -z-[1] h-[420px] rounded-full bg-gradient-to-r from-[#FFF6D5]/0 via-[#FEDA60]/20 to-[#FFF6D5]/0 blur-3xl"></div>
        <div class="relative rounded-[36px] border border-[#FEDA60]/35 bg-white/95 p-6 shadow-xl shadow-[#FEDA60]/10 md:p-12">
            <div class="flex flex-col items-start gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-[#C29C24]">Kurasi Media</p>
                    <h3 class="mt-2 text-2xl font-semibold text-[#2E2E2E] md:text-3xl">Temukan Cerita Dalam Setiap Format</h3>
                    <p class="mt-2 max-w-xl text-sm text-[#4F4F4F] md:text-base">Pilih kategori untuk menjelajah momen-momen terbaik, dari bidikan fotografi, cuplikan panggung, hingga musik yang mengiringi setiap peristiwa.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60] {{ $activeTab === 'images' ? 'bg-[#FEDA60] text-[#2E2E2E] shadow-lg shadow-[#FEDA60]/40 border-transparent' : 'bg-white hover:bg-[#FEDA60]/30' }}" data-tab="images" aria-selected="{{ $activeTab === 'images' ? 'true' : 'false' }}">
                        Gambar
                    </button>
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60] {{ $activeTab === 'video' ? 'bg-[#FEDA60] text-[#2E2E2E] shadow-lg shadow-[#FEDA60]/40 border-transparent' : 'bg-white hover:bg-[#FEDA60]/30' }}" data-tab="video" aria-selected="{{ $activeTab === 'video' ? 'true' : 'false' }}">
                        Video
                    </button>
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60] {{ $activeTab === 'music' ? 'bg-[#FEDA60] text-[#2E2E2E] shadow-lg shadow-[#FEDA60]/40 border-transparent' : 'bg-white hover:bg-[#FEDA60]/30' }}" data-tab="music" aria-selected="{{ $activeTab === 'music' ? 'true' : 'false' }}">
                        Musik
                    </button>
                </div>
            </div>

            @include('pages.gallery-media-section', ['imageGallery' => $imageGallery, 'videoGallery' => $videoGallery, 'musicTracks' => $musicTracks, 'activeTab' => $activeTab])
        </div>
    </section>

    <div id="gallery-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 md:px-4 md:py-10 opacity-0 transition-opacity duration-200 ease-out pointer-events-none">
        <div class="absolute inset-0 opacity-0 transition-opacity duration-200" data-modal-overlay>
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
            <div class="absolute inset-0 opacity-65 mix-blend-soft-light bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 160 160%22 fill=%22none%22%3E%3Cpath d=%22M80 0L160 80L80 160L0 80Z%22 stroke=%23FEDA60 stroke-width=%221.1%22 opacity=%220.32%22/%3E%3Cpath d=%22M0 0L80 80L0 160%22 stroke=%23F4C453 stroke-width=%220.8%22 opacity=%220.24%22/%3E%3Cpath d=%22M160 0L80 80L160 160%22 stroke=%23F4C453 stroke-width=%220.8%22 opacity=%220.24%22/%3E%3Ccircle cx=%2280%22 cy=%2280%22 r=%226%22 fill=%23FEDA60 opacity=%220.18%22/%3E%3C/svg%3E')] bg-[length:180px_180px]"></div>
        </div>
        <div class="relative z-10 w-full max-w-5xl transform overflow-hidden rounded-xl border border-white/35 bg-white/95 shadow-xl shadow-black/30 transition-all duration-200 ease-out translate-y-4 scale-95 opacity-0 flex flex-col max-h-[90vh]" data-modal-content>
            <div class="pointer-events-none absolute inset-0 opacity-85 mix-blend-soft-light bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 120 120%22 fill=%22none%22%3E%3Cpath d=%22M60 0L120 60L60 120L0 60Z%22 stroke=%23FEDA60 stroke-width=%221%22 opacity=%220.35%22/%3E%3Cpath d=%22M0 0L60 60L0 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Cpath d=%22M120 0L60 60L120 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Ccircle cx=%2260%22 cy=%2260%22 r=%225%22 fill=%23FEDA60 opacity=%220.2%22/%3E%3C/svg%3E')] bg-[length:140px_140px]" aria-hidden="true"></div>
            <div class="grid gap-5 p-5 md:grid-cols-[3fr,2fr] md:p-8 overflow-y-auto flex-1 w-full">
                <div class="flex items-center justify-center bg-black/5 rounded-lg">
                    <div class="relative flex w-full h-full max-h-[40vh] md:max-h-[70vh] min-h-[250px] items-center justify-center overflow-hidden rounded-lg" data-modal-media>
                        <div class="pointer-events-none absolute inset-0 opacity-75 mix-blend-multiply bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 120 120%22 fill=%22none%22%3E%3Cpath d=%22M60 0L120 60L60 120L0 60Z%22 stroke=%23FEDA60 stroke-width=%221%22 opacity=%220.35%22/%3E%3Cpath d=%22M0 0L60 60L0 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Cpath d=%22M120 0L60 60L120 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Ccircle cx=%2260%22 cy=%2260%22 r=%225%22 fill=%23FEDA60 opacity=%220.18%22/%3E%3C/svg%3E')] bg-[length:120px_120px]" aria-hidden="true"></div>
                        <div class="absolute inset-0 flex items-center justify-center bg-white/80" data-modal-loading hidden>
                            <div class="flex items-center gap-2 rounded-full border border-[#FEDA60]/50 bg-white px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.25em] text-[#8C6A08]">
                                <span class="h-2 w-2 animate-pulse rounded-full bg-[#FEDA60]"></span>
                                Memuat
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="space-y-2">
                        <span class="inline-flex items-center gap-2 rounded-full bg-[#FFF6D5] px-3 py-1 text-[9px] font-semibold uppercase tracking-[0.28em] text-[#C29C24]">
                            Galeri
                        </span>
                        <h3 class="text-lg font-semibold text-[#2E2E2E] md:text-xl" data-modal-title></h3>
                        <p class="text-[13px] leading-relaxed text-[#4F4F4F]" data-modal-description></p>
                    </div>
                    <div class="mt-4 md:mt-auto flex flex-wrap items-center gap-2" data-modal-actions>
                        <button type="button" class="inline-flex items-center gap-2 rounded-full border border-[#FEDA60]/60 bg-white px-4 py-1.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#8C6A08] transition hover:bg-[#FEDA60]/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-open>
                            <span data-modal-open-label>Buka Asli</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6h4.75a.75.75 0 0 1 .75.75V11.5m0-5.75-6.75 6.75m0 0V9.75m0 3.5H8.25" />
                            </svg>
                        </button>
                        <button type="button" class="inline-flex items-center gap-2 rounded-full border border-transparent bg-[#FEDA60] px-4 py-1.5 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#2E2E2E] transition hover:bg-[#FEDA60]/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-close-secondary>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <section class="bg-[#2E2E2E] text-white">
        <div class="max-w-6xl mx-auto px-6 py-16 lg:py-24 space-y-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-semibold">Ingin Berkolaborasi?</h2>
                    <p class="text-sm lg:text-base text-white/70 leading-relaxed">Kami terbuka untuk permintaan dokumentasi, liputan media, dan kolaborasi seni lintas komunitas.</p>
                </div>
                <a href="mailto:media@bhaktinusantara.id" class="px-6 py-3 rounded-full bg-[#FEDA60] text-[#2E2E2E] text-sm font-semibold">Hubungi Tim Media</a>
            </div>
        </div>
    </section> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // AJAX Tab Switching and Pagination
            let isLoading = false;
            
            const loadMediaContent = async (tab, page = 1) => {
                if (isLoading) return;
                isLoading = true;
                
                const mediaContent = document.getElementById('media-content');
                if (!mediaContent) return;
                
                // Add loading state
                mediaContent.style.opacity = '0.5';
                mediaContent.style.pointerEvents = 'none';
                
                try {
                    const url = new URL('{{ route("gallery") }}', window.location.origin);
                    url.searchParams.set('tab', tab);
                    url.searchParams.set('page', page);
                    
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });
                    
                    if (!response.ok) throw new Error('Network response was not ok');
                    
                    const data = await response.json();
                    
                    // Update content
                    mediaContent.outerHTML = data.html;
                    
                    // Update tab buttons
                    updateTabButtons(data.activeTab);
                    
                    // Update URL without reload
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('tab', data.activeTab);
                    newUrl.searchParams.set('page', page);
                    window.history.pushState({}, '', newUrl);
                    
                    // Re-initialize event listeners
                    initializeMediaContent();
                    
                } catch (error) {
                    console.error('Error loading media:', error);
                } finally {
                    const newMediaContent = document.getElementById('media-content');
                    if (newMediaContent) {
                        newMediaContent.style.opacity = '1';
                        newMediaContent.style.pointerEvents = 'auto';
                    }
                    isLoading = false;
                }
            };
            
            const updateTabButtons = (activeTab) => {
                document.querySelectorAll('[data-tab]').forEach(button => {
                    const isActive = button.dataset.tab === activeTab;
                    if (isActive) {
                        button.classList.add('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-lg', 'shadow-[#FEDA60]/40', 'border-transparent');
                        button.classList.remove('bg-white', 'hover:bg-[#FEDA60]/30');
                        button.setAttribute('aria-selected', 'true');
                    } else {
                        button.classList.remove('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-lg', 'shadow-[#FEDA60]/40', 'border-transparent');
                        button.classList.add('bg-white', 'hover:bg-[#FEDA60]/30');
                        button.setAttribute('aria-selected', 'false');
                    }
                });
            };
            
            const initializeMediaContent = () => {
                // Re-attach modal triggers
                document.querySelectorAll('[data-modal-trigger]').forEach((trigger) => {
                    trigger.replaceWith(trigger.cloneNode(true));
                });
                
                const newTriggers = document.querySelectorAll('[data-modal-trigger]');
                newTriggers.forEach((trigger) => {
                    trigger.addEventListener('click', () => {
                        if (window.openGalleryModal) {
                            window.openGalleryModal({
                                kind: trigger.dataset.modalKind ?? 'image',
                                src: trigger.dataset.modalSrc ?? '',
                                title: trigger.dataset.modalTitle ?? '',
                                description: trigger.dataset.modalDescription ?? '',
                            });
                        }
                    });
                });
                
                // Re-attach pagination links
                document.querySelectorAll('#media-content a[href*="page="]').forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const url = new URL(link.href);
                        const tab = url.searchParams.get('tab') || 'images';
                        const page = url.searchParams.get('page') || 1;
                        loadMediaContent(tab, page);
                        
                        // Scroll to media section
                        const mediaSection = document.getElementById('media-content');
                        if (mediaSection) {
                            mediaSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                });
                
                // Re-initialize music players
                initializeMusicPlayers();

                if (window.tutorialSystem && window.tutorialSystem.currentTutorial) {
                    window.tutorialSystem.showStep(false);
                }
            };
            
            const initializeMusicPlayers = () => {
                const musicItems = Array.from(document.querySelectorAll('[data-music-item]'));
                if (!musicItems.length) return;
                
                let activeAudio = null;
                let activeButton = null;

                const setButtonState = (button, isPlaying) => {
                    const playIcon = button.querySelector('[data-music-icon-play]');
                    const pauseIcon = button.querySelector('[data-music-icon-pause]');
                    const label = button.querySelector('[data-music-label]');
                    playIcon?.classList.toggle('hidden', isPlaying);
                    pauseIcon?.classList.toggle('hidden', !isPlaying);
                    if (label) {
                        label.textContent = isPlaying ? 'Pause' : 'Play';
                    }
                };

                const formatTime = (seconds) => {
                    if (isNaN(seconds)) return '0:00';
                    const mins = Math.floor(seconds / 60);
                    const secs = Math.floor(seconds % 60);
                    return `${mins}:${secs.toString().padStart(2, '0')}`;
                };

                musicItems.forEach((item) => {
                    const audioEl = item.querySelector('audio');
                    const toggleBtn = item.querySelector('[data-music-toggle]');
                    const progressBar = item.querySelector('[data-music-progress]');
                    const progressContainer = item.querySelector('[data-music-progress-container]');
                    const currentTimeEl = item.querySelector('[data-music-current]');
                    const durationEl = item.querySelector('[data-music-duration]');

                    if (!audioEl || !toggleBtn) return;

                    setButtonState(toggleBtn, false);
                    let isSeeking = false;

                    // Load metadata to get duration
                    audioEl.addEventListener('loadedmetadata', () => {
                        if (durationEl) {
                            durationEl.textContent = formatTime(audioEl.duration);
                        }
                    });

                    // Update progress bar and current time
                    audioEl.addEventListener('timeupdate', () => {
                        if (progressBar && !isSeeking) {
                            const percent = (audioEl.currentTime / audioEl.duration) * 100;
                            progressBar.style.width = percent + '%';
                        }
                        if (currentTimeEl && !isSeeking) {
                            currentTimeEl.textContent = formatTime(audioEl.currentTime);
                        }
                    });

                    // Seek function
                    const updateProgress = (clientX) => {
                        if (!progressContainer || !audioEl.duration || isNaN(audioEl.duration)) return;
                        
                        const rect = progressContainer.getBoundingClientRect();
                        const x = clientX - rect.left;
                        
                        // Clamp between 0 and width
                        const clampedX = Math.max(0, Math.min(x, rect.width));
                        const percent = clampedX / rect.width;
                        const newTime = percent * audioEl.duration;
                        
                        // Update audio time
                        audioEl.currentTime = newTime;
                        
                        // Update progress bar visually
                        if (progressBar) {
                            progressBar.style.width = (percent * 100) + '%';
                        }
                        
                        // Update time display
                        if (currentTimeEl) {
                            currentTimeEl.textContent = formatTime(newTime);
                        }
                    };

                    // Click to seek
                    if (progressContainer) {
                        progressContainer.addEventListener('click', (e) => {
                            updateProgress(e.clientX);
                        });

                        // Mouse drag to seek
                        progressContainer.addEventListener('mousedown', (e) => {
                            isSeeking = true;
                            updateProgress(e.clientX);
                        });
                    }

                    // Document-level mouse tracking
                    if (progressContainer) {
                        document.addEventListener('mousemove', (e) => {
                            if (isSeeking) {
                                updateProgress(e.clientX);
                            }
                        });

                        document.addEventListener('mouseup', () => {
                            isSeeking = false;
                        });

                        // Touch support
                        progressContainer.addEventListener('touchstart', (e) => {
                            isSeeking = true;
                            const touch = e.touches[0];
                            updateProgress(touch.clientX);
                        });

                        document.addEventListener('touchmove', (e) => {
                            if (isSeeking) {
                                const touch = e.touches[0];
                                updateProgress(touch.clientX);
                            }
                        });

                        document.addEventListener('touchend', () => {
                            isSeeking = false;
                        });
                    }

                    toggleBtn.addEventListener('click', () => {
                        if (audioEl.paused || audioEl.ended) {
                            if (activeAudio && activeAudio !== audioEl) {
                                activeAudio.pause();
                                activeAudio.currentTime = 0;
                            }
                            if (activeButton && activeButton !== toggleBtn) {
                                setButtonState(activeButton, false);
                            }
                            audioEl.play().then(() => {
                                activeAudio = audioEl;
                                activeButton = toggleBtn;
                                setButtonState(toggleBtn, true);
                            }).catch(() => {
                                setButtonState(toggleBtn, false);
                            });
                        } else {
                            audioEl.pause();
                            audioEl.currentTime = 0;
                            if (activeAudio === audioEl) {
                                activeAudio = null;
                                activeButton = null;
                            }
                            setButtonState(toggleBtn, false);
                        }
                    });

                    audioEl.addEventListener('ended', () => {
                        if (activeAudio === audioEl) {
                            activeAudio = null;
                            activeButton = null;
                        }
                        setButtonState(toggleBtn, false);
                    });

                    audioEl.addEventListener('pause', () => {
                        if (activeAudio === audioEl && !audioEl.ended) {
                            activeAudio = null;
                            activeButton = null;
                            setButtonState(toggleBtn, false);
                        }
                    });
                });
            };
            
            // Tab button click handlers
            document.querySelectorAll('[data-tab]').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const tab = button.dataset.tab;
                    loadMediaContent(tab, 1);
                });
            });
            
            // Initialize on page load
            initializeMediaContent();
            
            // Carousel code (unchanged)
            // document.querySelectorAll('[data-carousel]').forEach((carousel) => {
            //     if (carousel.dataset.carouselInit === 'true') {
            //         return;
            //     }
            //     carousel.dataset.carouselInit = 'true';

            //     const track = carousel.querySelector('[data-carousel-track]');
            //     const prevBtn = carousel.querySelector('[data-carousel-prev]');
            //     const nextBtn = carousel.querySelector('[data-carousel-next]');
            //     const indicators = Array.from(carousel.querySelectorAll('[data-carousel-indicator]'));
            //     const titleEl = carousel.querySelector('[data-carousel-title]');
            //     const descEl = carousel.querySelector('[data-carousel-description]');

            //     if (!track) {
            //         return;
            //     }

            //     const originalSlides = Array.from(track.children);
            //     if (originalSlides.length <= 1) {
            //         titleEl && (titleEl.textContent = originalSlides[0]?.dataset.title ?? '');
            //         descEl && (descEl.textContent = originalSlides[0]?.dataset.description ?? '');
            //         return;
            //     }

            //     const firstClone = originalSlides[0].cloneNode(true);
            //     const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);
            //     firstClone.dataset.clone = 'true';
            //     lastClone.dataset.clone = 'true';
            //     track.appendChild(firstClone);
            //     track.insertBefore(lastClone, originalSlides[0]);

            //     const slides = Array.from(track.children);
            //     let currentIndex = 1;
            //     const AUTOPLAY_INTERVAL = 4000;
            //     let autoPlayTimer = null;
            //     let isTransitioning = false;

            //     const enableTransition = () => {
            //         track.style.transitionProperty = 'transform';
            //         track.style.transitionDuration = '700ms';
            //         track.style.transitionTimingFunction = 'cubic-bezier(0.4, 0, 0.2, 1)';
            //     };

            //     const disableTransition = () => {
            //         track.style.transitionDuration = '0ms';
            //     };

            //     const getNormalizedIndex = () => {
            //         return (currentIndex - 1 + originalSlides.length) % originalSlides.length;
            //     };

            //     const updateMeta = () => {
            //         const normalizedIndex = getNormalizedIndex();
            //         const activeSlide = originalSlides[normalizedIndex];
            //         if (titleEl && activeSlide?.dataset.title) {
            //             titleEl.textContent = activeSlide.dataset.title;
            //         }
            //         if (descEl && activeSlide?.dataset.description) {
            //             descEl.textContent = activeSlide.dataset.description;
            //         }
            //         indicators.forEach((indicator, idx) => {
            //             const isActive = idx === normalizedIndex;
            //             indicator.classList.toggle('w-8', isActive);
            //             indicator.classList.toggle('bg-[#FEDA60]', isActive);
            //             indicator.classList.toggle('w-3', !isActive);
            //             indicator.classList.toggle('bg-white/40', !isActive);
            //             indicator.setAttribute('aria-current', isActive ? 'true' : 'false');
            //         });
            //     };

            //     const setTranslate = () => {
            //         track.style.transform = `translateX(-${currentIndex * 100}%)`;
            //         updateMeta();
            //     };

            //     const moveTo = (index, { viaAutoplay = false } = {}) => {
            //         if (isTransitioning) {
            //             return;
            //         }

            //         const targetIndex = Math.max(0, Math.min(index, slides.length - 1));
            //         const previousIndex = currentIndex;

            //         if (targetIndex === previousIndex) {
            //             if (!viaAutoplay) {
            //                 restartAutoPlay();
            //             }
            //             return;
            //         }

            //         currentIndex = targetIndex;
            //         isTransitioning = true;
            //         enableTransition();
            //         setTranslate();
            //         if (!viaAutoplay) {
            //             restartAutoPlay();
            //         }
            //     };

            //     const moveNext = (viaAutoplay = false) => moveTo(currentIndex + 1, { viaAutoplay });
            //     const movePrev = () => moveTo(currentIndex - 1);

            //     const snapTo = (index) => {
            //         disableTransition();
            //         currentIndex = index;
            //         setTranslate();
            //         void track.offsetWidth;
            //         enableTransition();
            //     };

            //     const stopAutoPlay = () => {
            //         if (autoPlayTimer) {
            //             clearInterval(autoPlayTimer);
            //             autoPlayTimer = null;
            //         }
            //     };

            //     const restartAutoPlay = () => {
            //         stopAutoPlay();
            //         autoPlayTimer = setInterval(() => moveNext(true), AUTOPLAY_INTERVAL);
            //     };

            //     prevBtn?.addEventListener('click', () => movePrev());
            //     nextBtn?.addEventListener('click', () => moveNext());
            //     indicators.forEach((indicator, idx) => {
            //         indicator.addEventListener('click', () => moveTo(idx + 1));
            //     });

            //     carousel.addEventListener('mouseenter', stopAutoPlay);
            //     carousel.addEventListener('mouseleave', restartAutoPlay);

            //     track.addEventListener('transitionend', (event) => {
            //         if (event.target !== track || event.propertyName !== 'transform') {
            //             return;
            //         }

            //         isTransitioning = false;

            //         if (currentIndex === slides.length - 1) {
            //             snapTo(1);
            //         } else if (currentIndex === 0) {
            //             snapTo(originalSlides.length);
            //         }
            //     });

            //     disableTransition();
            //     setTranslate();
            //     void track.offsetWidth;
            //     enableTransition();
            //     restartAutoPlay();
            // });


          
            // Tab switching is now handled via page navigation (removed JavaScript tab switching)

            const modal = document.getElementById('gallery-modal');
            if (modal) {
                const overlay = modal.querySelector('[data-modal-overlay]');
                const content = modal.querySelector('[data-modal-content]');
                const closeBtn = modal.querySelector('[data-modal-close]');
                const secondaryCloseBtn = modal.querySelector('[data-modal-close-secondary]');
                const openOriginalBtn = modal.querySelector('[data-modal-open]');
                const openOriginalLabel = modal.querySelector('[data-modal-open-label]');
                const loadingIndicator = modal.querySelector('[data-modal-loading]');
                const titleEl = modal.querySelector('[data-modal-title]');
                const descEl = modal.querySelector('[data-modal-description]');
                const mediaContainer = modal.querySelector('[data-modal-media]');
                let activeMediaElement = null;
                let activeSource = '';
                let activeKind = 'image';
                let lastFocusedElement = null;
                let isClosing = false;

                const setMediaMode = (mode) => {
                    if (!mediaContainer) {
                        return;
                    }
                    mediaContainer.classList.remove('aspect-video', 'md:aspect-[16/9]', 'aspect-[4/3]', 'md:aspect-[16/10]');
                    if (mode === 'video') {
                        mediaContainer.classList.add('aspect-video', 'md:aspect-[16/9]');
                    } else {
                        mediaContainer.classList.add('aspect-[4/3]', 'md:aspect-[16/10]');
                    }
                };

                const showLoading = () => {
                    if (loadingIndicator) {
                        loadingIndicator.hidden = false;
                    }
                };

                const hideLoading = () => {
                    if (loadingIndicator) {
                        loadingIndicator.hidden = true;
                    }
                };

                const cleanupMedia = () => {
                    if (activeMediaElement) {
                        if (['VIDEO', 'AUDIO'].includes(activeMediaElement.tagName)) {
                            activeMediaElement.pause?.();
                            activeMediaElement.removeAttribute('src');
                            activeMediaElement.load?.();
                        }
                        activeMediaElement.remove();
                        activeMediaElement = null;
                    }
                    hideLoading();
                    activeSource = '';
                    activeKind = 'image';
                };

                const restoreFocus = () => {
                    if (lastFocusedElement) {
                        lastFocusedElement.focus({ preventScroll: true });
                        lastFocusedElement = null;
                    }
                };

                const finalizeClose = () => {
                    modal.classList.add('hidden');
                    modal.classList.remove('opacity-100');
                    modal.classList.remove('pointer-events-none');
                    content?.classList.add('translate-y-4', 'opacity-0', 'scale-95');
                    overlay?.classList.remove('opacity-100');
                    cleanupMedia();
                    restoreFocus();
                    document.body.classList.remove('overflow-hidden');
                    isClosing = false;
                };

                const closeModal = () => {
                    if (modal.classList.contains('hidden') || isClosing) {
                        return;
                    }
                    isClosing = true;
                    modal.classList.add('pointer-events-none');
                    modal.classList.remove('opacity-100');
                    overlay?.classList.remove('opacity-100');
                    content?.classList.remove('translate-y-0', 'opacity-100', 'scale-100');
                    content?.classList.add('translate-y-4', 'opacity-0', 'scale-95');
                };

                const openModal = ({ kind, src, title, description }) => {
                    if (!src) {
                        return;
                    }
                    if (isClosing) {
                        finalizeClose();
                    }
                    cleanupMedia();
                    lastFocusedElement = document.activeElement instanceof HTMLElement ? document.activeElement : null;

                    activeKind = kind === 'video' ? 'video' : 'image';
                    activeSource = src;

                    if (openOriginalLabel) {
                        openOriginalLabel.textContent = activeKind === 'video' ? 'Putar di Tab Baru' : 'Buka Resolusi Asli';
                    }

                    if (titleEl) {
                        titleEl.textContent = title ?? '';
                        titleEl.classList.toggle('hidden', !title);
                    }
                    if (descEl) {
                        descEl.textContent = description ?? '';
                        descEl.classList.toggle('hidden', !description);
                    }

                    if (!mediaContainer) {
                        return;
                    }

                    setMediaMode(activeKind);
                    showLoading();

                    if (activeKind === 'video' && /\.(mp4|webm|ogg)(\?.*)?$/i.test(src)) {
                        const videoEl = document.createElement('video');
                        videoEl.src = src;
                        videoEl.controls = true;
                        videoEl.autoplay = true;
                        videoEl.playsInline = true;
                        videoEl.className = 'h-full w-full object-cover';
                        videoEl.addEventListener('loadeddata', hideLoading, { once: true });
                        videoEl.addEventListener('error', hideLoading, { once: true });
                        mediaContainer.appendChild(videoEl);
                        activeMediaElement = videoEl;
                    } else if (activeKind === 'video') {
                        const iframeEl = document.createElement('iframe');
                        iframeEl.src = src;
                        iframeEl.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
                        iframeEl.allowFullscreen = true;
                        iframeEl.className = 'h-full w-full';
                        iframeEl.addEventListener('load', hideLoading, { once: true });
                        mediaContainer.appendChild(iframeEl);
                        activeMediaElement = iframeEl;
                    } else {
                        const imgEl = new Image();
                        imgEl.src = src;
                        imgEl.alt = title ?? '';
                        imgEl.className = 'h-full w-full object-contain';
                        imgEl.addEventListener('load', hideLoading, { once: true });
                        imgEl.addEventListener('error', hideLoading, { once: true });
                        mediaContainer.appendChild(imgEl);
                        activeMediaElement = imgEl;
                    }

                    modal.classList.remove('hidden');
                    modal.classList.remove('pointer-events-none');
                    void modal.offsetWidth;
                    modal.classList.add('opacity-100');
                    overlay?.classList.add('opacity-100');
                    content?.classList.remove('translate-y-4', 'opacity-0', 'scale-95');
                    content?.classList.add('translate-y-0', 'opacity-100', 'scale-100');
                    document.body.classList.add('overflow-hidden');
                    (closeBtn ?? secondaryCloseBtn)?.focus({ preventScroll: true });
                };
                
                // Expose openModal globally for AJAX-loaded content
                window.openGalleryModal = openModal;

                const handleOpenOriginal = () => {
                    if (activeSource) {
                        window.open(activeSource, '_blank', 'noopener');
                    }
                };

                overlay?.addEventListener('click', closeModal);
                closeBtn?.addEventListener('click', closeModal);
                secondaryCloseBtn?.addEventListener('click', closeModal);
                openOriginalBtn?.addEventListener('click', handleOpenOriginal);

                modal.addEventListener('transitionend', (event) => {
                    if (isClosing && event.target === content && !modal.classList.contains('opacity-100')) {
                        finalizeClose();
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && modal.classList.contains('opacity-100')) {
                        closeModal();
                    }
                });

                document.querySelectorAll('[data-modal-trigger]').forEach((trigger) => {
                    trigger.addEventListener('click', () => {
                        openModal({
                            kind: trigger.dataset.modalKind ?? 'image',
                            src: trigger.dataset.modalSrc ?? '',
                            title: trigger.dataset.modalTitle ?? '',
                            description: trigger.dataset.modalDescription ?? '',
                        });
                    });
                });
            }
        });
    </script>
@endsection
