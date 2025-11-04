@extends('layouts.app')

@section('content')
    <section class="bg-gradient-to-b from-white to-[#FFF6D5]">

            @php
                $carouselSlides = [
                    [
                        'image' => asset('images/contoh/gallery.png'),
                        'title' => 'Parade Tari Nusantara',
                        'description' => 'Sorotan kolaborasi tari tradisional yang mempertemukan ragam budaya Nusantara di satu panggung.',
                    ],
                    [
                        'image' => asset('images/contoh/home.png'),
                        'title' => 'Latihan Rutinitas Bhakti Nusantara',
                        'description' => 'Energi dan disiplin penari muda saat mempersiapkan repertoar baru untuk pentas komunitas.',
                    ],
                    [
                        'image' => asset('images/contoh/about me.png'),
                        'title' => 'Workshop Tari Kontemporer',
                        'description' => 'Suasana kelas intensif bersama koreografer tamu dalam sesi eksplorasi gerak.',
                    ],
                    [
                        'image' => asset('images/contoh/product.png'),
                        'title' => 'Koleksi Busana Pertunjukan',
                        'description' => 'Rangkaian kostum khas yang dirancang khusus untuk membawa cerita ke atas panggung.',
                    ],
                ];
            @endphp

            <div class="relative w-full h-[420px] md:h-[520px] overflow-hidden shadow-lg shadow-[#FEDA60]/20" data-carousel>
                <div class="flex h-full transition-transform duration-700 ease-in-out" data-carousel-track>
                    @foreach ($carouselSlides as $slide)
                        <div class="relative w-full h-full flex-shrink-0" data-title="{{ $slide['title'] }}" data-description="{{ $slide['description'] }}">
                            <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        </div>
                    @endforeach
                </div>

                <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-6">
                    <div class="bg-white/15 backdrop-blur-md px-6 py-5 rounded-2xl max-w-3xl space-y-3">
                        <p class="text-sm uppercase tracking-[0.4em] text-[#FEDA60]">Galeri Sanggar</p>
                        <h2 class="text-3xl md:text-5xl font-semibold text-white drop-shadow" data-carousel-title>{{ $carouselSlides[0]['title'] }}</h2>
                        <p class="text-base md:text-lg text-white/90" data-carousel-description>{{ $carouselSlides[0]['description'] }}</p>
                    </div>
                </div>

                <div class="absolute inset-y-0 left-0 right-0 z-20 flex items-center justify-between px-4">
                    <button type="button" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/80 text-[#2E2E2E] hover:bg-[#FEDA60] focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" data-carousel-prev aria-label="Slide sebelumnya">
                        <span class="sr-only">Sebelumnya</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/80 text-[#2E2E2E] hover:bg-[#FEDA60] focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" data-carousel-next aria-label="Slide selanjutnya">
                        <span class="sr-only">Berikutnya</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>

                <div class="absolute bottom-6 z-20 w-full flex justify-center gap-2">
                    @foreach ($carouselSlides as $index => $slide)
                        <button type="button" class="h-2.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-8 bg-[#FEDA60]' : 'w-2.5 bg-white/50' }}" data-carousel-indicator="{{ $index }}" aria-label="Tampilkan {{ $slide['title'] }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
            </div>
        </>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16 lg:py-24 space-y-10">
        @include('components.ui.section-heading', [
            'subtitle' => 'Album',
            'title' => 'Highlight Momen Terbaik',
            'description' => 'Setiap album memuat cerita unik dari persiapan hingga pertunjukan.'
        ])
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['title' => 'Pentas Akhir Tahun', 'desc' => 'Perpaduan tari tradisi Jawa Barat dan musik kontemporer.'],
                ['title' => 'Panggung Kolaborasi Bali', 'desc' => 'Kolaborasi dengan komunitas lokal menampilkan tari Legong.'],
                ['title' => 'Festival Pemuda Nusantara', 'desc' => 'Kolase tari dari berbagai provinsi dengan busana penuh warna.'],
                ['title' => 'Workshop Tari Anak', 'desc' => 'Latihan fun filled untuk anak usia 6-10 tahun.'],
                ['title' => 'Tour Komunitas Budaya', 'desc' => 'Pertunjukan di ruang publik dan taman kota.'],
                ['title' => 'Sesi Rehearsal', 'desc' => 'Persiapan intensif menjelang kompetisi nasional.'],
            ] as $album)
                <article class="rounded-3xl bg-white border border-[#FEDA60]/30 p-6 space-y-3 shadow-lg shadow-[#FEDA60]/10">
                    <div class="aspect-video rounded-2xl bg-[#FFF0C2] border border-[#E2B136]/30"></div>
                    <h3 class="text-lg font-semibold text-[#2E2E2E]">{{ $album['title'] }}</h3>
                    <p class="text-sm text-[#4F4F4F] leading-relaxed">{{ $album['desc'] }}</p>
                    <a href="#" class="inline-flex items-center gap-2 text-sm font-semibold text-[#8C6A08]">Lihat Album
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0-6.75 6.75M19.5 12l-6.75-6.75" />
                        </svg>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-[#2E2E2E] text-white">
        <div class="max-w-6xl mx-auto px-6 py-16 lg:py-24 space-y-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-semibold">Ingin Berkolaborasi?</h2>
                    <p class="text-sm lg:text-base text-white/70 leading-relaxed">Kami terbuka untuk permintaan dokumentasi, liputan media, dan kolaborasi seni lintas komunitas.</p>
                </div>
                <a href="mailto:media@bhaktinusantara.id" class="px-6 py-3 rounded-full bg-[#FEDA60] text-[#2E2E2E] text-sm font-semibold">Hubungi Tim Media</a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-carousel]').forEach((carousel) => {
                if (carousel.dataset.carouselInit === 'true') {
                    return;
                }
                carousel.dataset.carouselInit = 'true';

                const track = carousel.querySelector('[data-carousel-track]');
                const prevBtn = carousel.querySelector('[data-carousel-prev]');
                const nextBtn = carousel.querySelector('[data-carousel-next]');
                const indicators = Array.from(carousel.querySelectorAll('[data-carousel-indicator]'));
                const titleEl = carousel.querySelector('[data-carousel-title]');
                const descEl = carousel.querySelector('[data-carousel-description]');

                if (!track) {
                    return;
                }

                const originalSlides = Array.from(track.children);
                if (originalSlides.length <= 1) {
                    titleEl && (titleEl.textContent = originalSlides[0]?.dataset.title ?? '');
                    descEl && (descEl.textContent = originalSlides[0]?.dataset.description ?? '');
                    return;
                }

                const firstClone = originalSlides[0].cloneNode(true);
                const lastClone = originalSlides[originalSlides.length - 1].cloneNode(true);
                firstClone.dataset.clone = 'true';
                lastClone.dataset.clone = 'true';
                track.appendChild(firstClone);
                track.insertBefore(lastClone, originalSlides[0]);

                const slides = Array.from(track.children);
                let currentIndex = 1;
                let autoPlayTimer = null;
                let isTransitioning = false;

                const enableTransition = () => {
                    track.style.transitionProperty = 'transform';
                    track.style.transitionDuration = '700ms';
                    track.style.transitionTimingFunction = 'cubic-bezier(0.4, 0, 0.2, 1)';
                };

                const disableTransition = () => {
                    track.style.transitionDuration = '0ms';
                };

                const getNormalizedIndex = () => {
                    return (currentIndex - 1 + originalSlides.length) % originalSlides.length;
                };

                const updateMeta = () => {
                    const normalizedIndex = getNormalizedIndex();
                    const activeSlide = originalSlides[normalizedIndex];
                    if (titleEl && activeSlide?.dataset.title) {
                        titleEl.textContent = activeSlide.dataset.title;
                    }
                    if (descEl && activeSlide?.dataset.description) {
                        descEl.textContent = activeSlide.dataset.description;
                    }
                    indicators.forEach((indicator, idx) => {
                        const isActive = idx === normalizedIndex;
                        indicator.classList.toggle('w-8', isActive);
                        indicator.classList.toggle('bg-[#FEDA60]', isActive);
                        indicator.classList.toggle('w-2.5', !isActive);
                        indicator.classList.toggle('bg-white/50', !isActive);
                        indicator.setAttribute('aria-current', isActive ? 'true' : 'false');
                    });
                };

                const setTranslate = () => {
                    track.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateMeta();
                };

                const moveTo = (index, { viaAutoplay = false } = {}) => {
                    if (isTransitioning) {
                        return;
                    }

                    const targetIndex = Math.max(0, Math.min(index, slides.length - 1));
                    const previousIndex = currentIndex;

                    if (targetIndex === previousIndex) {
                        if (!viaAutoplay) {
                            restartAutoPlay();
                        }
                        return;
                    }

                    currentIndex = targetIndex;
                    isTransitioning = true;
                    enableTransition();
                    setTranslate();
                    if (!viaAutoplay) {
                        restartAutoPlay();
                    }
                };

                const moveNext = (viaAutoplay = false) => moveTo(currentIndex + 1, { viaAutoplay });
                const movePrev = () => moveTo(currentIndex - 1);

                const snapTo = (index) => {
                    disableTransition();
                    currentIndex = index;
                    setTranslate();
                    void track.offsetWidth;
                    enableTransition();
                };

                const stopAutoPlay = () => {
                    if (autoPlayTimer) {
                        clearInterval(autoPlayTimer);
                        autoPlayTimer = null;
                    }
                };

                const restartAutoPlay = () => {
                    stopAutoPlay();
                    autoPlayTimer = setInterval(() => moveNext(true), 6000);
                };

                prevBtn?.addEventListener('click', () => movePrev());
                nextBtn?.addEventListener('click', () => moveNext());
                indicators.forEach((indicator, idx) => {
                    indicator.addEventListener('click', () => moveTo(idx + 1));
                });

                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', restartAutoPlay);

                track.addEventListener('transitionend', (event) => {
                    if (event.target !== track || event.propertyName !== 'transform') {
                        return;
                    }

                    isTransitioning = false;

                    if (currentIndex === slides.length - 1) {
                        snapTo(1);
                    } else if (currentIndex === 0) {
                        snapTo(originalSlides.length);
                    }
                });

                disableTransition();
                setTranslate();
                void track.offsetWidth;
                enableTransition();
                restartAutoPlay();
            });
        });
    </script>
@endsection
