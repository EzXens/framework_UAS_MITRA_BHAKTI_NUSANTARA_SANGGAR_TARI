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

                $imageGallery = [
                    [
                        'src' => asset('images/contoh/gallery.png'),
                        'title' => 'Pentas Akhir Tahun',
                        'description' => 'Perpaduan tari tradisi Jawa Barat dan musik kontemporer.',
                    ],
                    [
                        'src' => asset('images/contoh/home.png'),
                        'title' => 'Panggung Kolaborasi Bali',
                        'description' => 'Kolaborasi dengan komunitas lokal menampilkan tari Legong.',
                    ],
                    [
                        'src' => asset('images/contoh/about me.png'),
                        'title' => 'Festival Pemuda Nusantara',
                        'description' => 'Kolase tari dari berbagai provinsi dengan busana penuh warna.',
                    ],
                    [
                        'src' => asset('images/contoh/product.png'),
                        'title' => 'Workshop Tari Anak',
                        'description' => 'Latihan fun filled untuk anak usia 6-10 tahun.',
                    ],
                    [
                        'src' => asset('images/contoh/gallery.png'),
                        'title' => 'Tour Komunitas Budaya',
                        'description' => 'Pertunjukan di ruang publik dan taman kota.',
                    ],
                    [
                        'src' => asset('images/contoh/home.png'),
                        'title' => 'Sesi Rehearsal',
                        'description' => 'Persiapan intensif menjelang kompetisi nasional.',
                    ],
                ];

                $videoGallery = [
                    [
                        'thumbnail' => asset('images/contoh/home.png'),
                        'title' => 'Latihan Tari Kontemporer',
                        'description' => 'Cuplikan sesi latihan intensif di studio Bhakti Nusantara.',
                        'source' => 'https://www.youtube.com/embed/5z5Lft3T2m8?autoplay=1&rel=0',
                    ],
                    [
                        'thumbnail' => asset('images/contoh/product.png'),
                        'title' => 'Pentas Kolaborasi',
                        'description' => 'Sorotan penampilan kolaborasi lintas komunitas budaya.',
                        'source' => 'https://www.youtube.com/embed/0VkrUG3OrPc?autoplay=1&rel=0',
                    ],
                    [
                        'thumbnail' => asset('images/contoh/gallery.png'),
                        'title' => 'Workshop Tari Tradisi',
                        'description' => 'Highlight workshop tari tradisi bersama pelatih tamu.',
                        'source' => 'https://www.youtube.com/embed/6xDi2w_Jj5M?autoplay=1&rel=0',
                    ],
                ];

                $musicTracks = [
                    [
                        'title' => 'Gending Pembuka Nusantara',
                        'description' => 'Aransemen gamelan modern yang mengiringi pembuka pentas.',
                        'source' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                    ],
                    [
                        'title' => 'Laras Kolaborasi',
                        'description' => 'Perpaduan ritme tradisional dan elektronik ringan.',
                        'source' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
                    ],
                    [
                        'title' => 'Harmoni Panggung',
                        'description' => 'Komposisi orkestra mini untuk penutup pertunjukan.',
                        'source' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
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
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16 lg:py-24">
        <div class="rounded-3xl border border-[#FEDA60]/40 bg-white/90 p-6 md:p-10 shadow-xl shadow-[#FEDA60]/10">
            <div class="flex flex-wrap gap-3">
                <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/60 bg-white px-5 py-2 text-sm font-semibold tracking-wide text-[#8C6A08] transition hover:bg-[#FEDA60]/90" data-tab-target="images" aria-selected="true">
                    Gambar
                </button>
                <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/60 bg-white px-5 py-2 text-sm font-semibold tracking-wide text-[#8C6A08] transition hover:bg-[#FEDA60]/30" data-tab-target="video" aria-selected="false">
                    Video
                </button>
                <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/60 bg-white px-5 py-2 text-sm font-semibold tracking-wide text-[#8C6A08] transition hover:bg-[#FEDA60]/30" data-tab-target="music" aria-selected="false">
                    Music
                </button>
            </div>

            <div class="mt-10 space-y-12">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-tab-panel="images">
                    @foreach ($imageGallery as $image)
                        <button type="button" class="group relative block overflow-hidden rounded-3xl border border-[#FEDA60]/40 bg-white shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1" data-modal-trigger data-modal-kind="image" data-modal-src="{{ $image['src'] }}" data-modal-title="{{ $image['title'] }}" data-modal-description="{{ $image['description'] }}">
                            <div class="aspect-square md:aspect-[4/3] w-full overflow-hidden bg-[#FFF0C2]">
                                <img src="{{ $image['src'] }}" alt="{{ $image['title'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" loading="lazy">
                            </div>
                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-black/10 to-transparent opacity-0 transition duration-500 group-hover:opacity-100"></div>
                        </button>
                    @endforeach
                </div>

                <div class="hidden" data-tab-panel="video">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($videoGallery as $video)
                            <button type="button" class="group relative block overflow-hidden rounded-3xl border border-[#FEDA60]/40 bg-[#FFF6D5]/60 shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1" data-modal-trigger data-modal-kind="video" data-modal-src="{{ $video['source'] }}" data-modal-title="{{ $video['title'] }}" data-modal-description="{{ $video['description'] }}">
                                <div class="aspect-video w-full overflow-hidden">
                                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" loading="lazy">
                                </div>
                                <div class="pointer-events-none absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition duration-500 group-hover:opacity-100">
                                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white/90 text-[#8C6A08] shadow-lg shadow-black/30">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                            <path d="M8.25 5.5a1 1 0 0 1 1.54-.84l7.5 5.02a1 1 0 0 1 0 1.64l-7.5 5.02A1 1 0 0 1 8.25 15.5V5.5Z" />
                                        </svg>
                                    </span>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="hidden" data-tab-panel="music">
                    <div class="space-y-4">
                        @foreach ($musicTracks as $track)
                            <div class="flex flex-col gap-4 rounded-3xl border border-[#FEDA60]/40 bg-[#FFF9E5] p-6 shadow-lg shadow-[#FEDA60]/15 sm:flex-row sm:items-center sm:justify-between" data-music-item>
                                <div>
                                    <p class="text-base font-semibold text-[#2E2E2E]">{{ $track['title'] }}</p>
                                    <p class="text-sm text-[#4F4F4F]">{{ $track['description'] }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button type="button" class="music-toggle inline-flex items-center gap-2 rounded-full border border-[#FEDA60]/50 bg-white px-5 py-2 text-sm font-semibold text-[#8C6A08] transition hover:bg-[#FEDA60]/30" data-music-toggle>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" data-music-icon-play>
                                            <path d="M5.25 4.5a.75.75 0 0 1 1.14-.64l12 7.5a.75.75 0 0 1 0 1.28l-12 7.5A.75.75 0 0 1 5.25 19.5V4.5Z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden h-5 w-5" data-music-icon-pause>
                                            <path d="M6.75 5.25A.75.75 0 0 1 7.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25ZM13.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H13.5a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75Z" />
                                        </svg>
                                        <span data-music-label>Play</span>
                                    </button>
                                    <audio src="{{ $track['source'] }}" preload="none"></audio>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="gallery-modal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-10">
        <div class="absolute inset-0 bg-black/70" data-modal-overlay></div>
        <div class="relative z-10 w-full max-w-5xl overflow-hidden rounded-3xl border border-white/10 bg-white shadow-2xl shadow-black/30">
            <button type="button" class="absolute right-5 top-5 inline-flex h-10 w-10 items-center justify-center rounded-full bg-black/10 text-black transition hover:bg-black/20" data-modal-close aria-label="Tutup popup">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 6.75 10.5 10.5m0-10.5-10.5 10.5" />
                </svg>
            </button>
            <div class="grid gap-6 p-6 md:grid-cols-[3fr,2fr] md:p-10">
                <div class="flex items-center justify-center">
                    <div class="relative flex w-full max-h-[75vh] min-h-[260px] items-center justify-center overflow-hidden rounded-2xl bg-[#F2F2F2]" data-modal-media></div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-2xl font-semibold text-[#2E2E2E]" data-modal-title></h3>
                    <p class="text-sm text-[#4F4F4F] leading-relaxed" data-modal-description></p>
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

            const tabButtons = Array.from(document.querySelectorAll('[data-tab-target]'));
            const tabPanels = Array.from(document.querySelectorAll('[data-tab-panel]'));

            if (tabButtons.length && tabPanels.length) {
                const deactivateButton = (button) => {
                    button.classList.remove('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-md', 'hover:bg-[#FEDA60]/90');
                    button.classList.add('bg-white', 'text-[#8C6A08]', 'hover:bg-[#FEDA60]/30');
                    button.setAttribute('aria-selected', 'false');
                };

                const activateButton = (button) => {
                    button.classList.add('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-md', 'hover:bg-[#FEDA60]/90');
                    button.classList.remove('bg-white', 'bg-[#FFF6D5]', 'text-[#8C6A08]', 'hover:bg-[#FEDA60]/30');
                    button.setAttribute('aria-selected', 'true');
                };

                const setPanelVisibility = (targetId) => {
                    tabPanels.forEach((panel) => {
                        const isActive = panel.dataset.tabPanel === targetId;
                        panel.classList.toggle('hidden', !isActive);
                        panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
                    });
                };

                const activateTab = (targetId) => {
                    tabButtons.forEach((button) => {
                        if (button.dataset.tabTarget === targetId) {
                            activateButton(button);
                        } else {
                            deactivateButton(button);
                        }
                    });
                    setPanelVisibility(targetId);
                };

                tabButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        activateTab(button.dataset.tabTarget);
                    });
                });

                const initialTab = tabButtons.find((button) => button.getAttribute('aria-selected') === 'true') ?? tabButtons[0];
                if (initialTab) {
                    activateTab(initialTab.dataset.tabTarget);
                }
            }

            const modal = document.getElementById('gallery-modal');
            if (modal) {
                const overlay = modal.querySelector('[data-modal-overlay]');
                const closeBtn = modal.querySelector('[data-modal-close]');
                const titleEl = modal.querySelector('[data-modal-title]');
                const descEl = modal.querySelector('[data-modal-description]');
                const mediaContainer = modal.querySelector('[data-modal-media]');
                let activeMediaElement = null;
                let lastFocusedElement = null;

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

                const cleanupMedia = () => {
                    if (activeMediaElement) {
                        if (['VIDEO', 'AUDIO'].includes(activeMediaElement.tagName)) {
                            activeMediaElement.pause();
                            activeMediaElement.removeAttribute('src');
                            activeMediaElement.load?.();
                        }
                        activeMediaElement.remove();
                        activeMediaElement = null;
                    }
                    if (mediaContainer) {
                        mediaContainer.innerHTML = '';
                    }
                };

                const closeModal = () => {
                    if (modal.classList.contains('hidden')) {
                        return;
                    }
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    cleanupMedia();
                    if (lastFocusedElement) {
                        lastFocusedElement.focus({ preventScroll: true });
                        lastFocusedElement = null;
                    }
                };

                const openModal = ({ kind, src, title, description }) => {
                    if (!src) {
                        return;
                    }
                    cleanupMedia();
                    lastFocusedElement = document.activeElement instanceof HTMLElement ? document.activeElement : null;

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

                    const normalizedKind = kind === 'video' ? 'video' : 'image';
                    setMediaMode(normalizedKind);

                    if (normalizedKind === 'video' && /\.(mp4|webm|ogg)(\?.*)?$/i.test(src)) {
                        const videoEl = document.createElement('video');
                        videoEl.src = src;
                        videoEl.controls = true;
                        videoEl.autoplay = true;
                        videoEl.playsInline = true;
                        videoEl.className = 'h-full w-full object-cover';
                        mediaContainer.appendChild(videoEl);
                        activeMediaElement = videoEl;
                    } else if (normalizedKind === 'video') {
                        const iframeEl = document.createElement('iframe');
                        iframeEl.src = src;
                        iframeEl.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
                        iframeEl.allowFullscreen = true;
                        iframeEl.className = 'h-full w-full';
                        mediaContainer.appendChild(iframeEl);
                        activeMediaElement = iframeEl;
                    } else {
                        const imgEl = new Image();
                        imgEl.src = src;
                        imgEl.alt = title ?? '';
                        imgEl.className = 'h-full w-full object-contain';
                        mediaContainer.appendChild(imgEl);
                        activeMediaElement = imgEl;
                    }

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                    closeBtn?.focus({ preventScroll: true });
                };

                overlay?.addEventListener('click', closeModal);
                closeBtn?.addEventListener('click', closeModal);

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
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

            const musicItems = Array.from(document.querySelectorAll('[data-music-item]'));
            if (musicItems.length) {
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

                musicItems.forEach((item) => {
                    const audioEl = item.querySelector('audio');
                    const toggleBtn = item.querySelector('[data-music-toggle]');

                    if (!audioEl || !toggleBtn) {
                        return;
                    }

                    setButtonState(toggleBtn, false);

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
            }
        });
    </script>
@endsection
