@extends('layouts.app')

@section('content')
    <section class="bg-gradient-to-b from-white via-[#FFF9E5] to-[#FFF6D5] py-6">
        <div class="relative mx-auto max-w-7xl px-6 pb-12 pt-16 text-center">
            <span class="inline-flex items-center gap-2 rounded-full border border-[#FEDA60]/60 bg-white/80 px-4 py-1 text-sm font-semibold uppercase tracking-[0.35em] text-[#8C6A08] shadow-sm shadow-[#FEDA60]/30">
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
                $carouselSlides = [
                    [
                        'image' => asset('images/bgtari.jpg'),
                        'title' => 'Parade Tari Nusantara',
                        'description' => 'Sorotan kolaborasi tari tradisional yang mempertemukan ragam budaya Nusantara di satu panggung.',
                    ],
                    [
                        'image' => asset('images/bg1.jpg'),
                        'title' => 'Latihan Rutinitas Bhakti Nusantara',
                        'description' => 'Energi dan disiplin penari muda saat mempersiapkan repertoar baru untuk pentas komunitas.',
                    ],
                    [
                        'image' => asset('images/bg2.jpg'),
                        'title' => 'Workshop Tari Kontemporer',
                        'description' => 'Suasana kelas intensif bersama koreografer tamu dalam sesi eksplorasi gerak.',
                    ],
                    [
                        'image' => asset('images/bg3.jpg'),
                        'title' => 'Koleksi Busana Pertunjukan',
                        'description' => 'Rangkaian kostum khas yang dirancang khusus untuk membawa cerita ke atas panggung.',
                    ],
                ];

                $imageGallery = [
                    [
                        'src' => asset('images/galeri/FOTO/1.jpg'),
                        'title' => 'Pentas Akhir Tahun',
                        'description' => 'Perpaduan tari tradisi Jawa Barat dan musik kontemporer.',
                    ],
                    [
                        'src' => asset('images/galeri/FOTO/2.jpg'),
                        'title' => 'Panggung Kolaborasi Bali',
                        'description' => 'Kolaborasi dengan komunitas lokal menampilkan tari Legong.',
                    ],
                    [
                        'src' => asset('images/galeri/FOTO/3.jpg'),
                        'title' => 'Festival Pemuda Nusantara',
                        'description' => 'Kolase tari dari berbagai provinsi dengan busana penuh warna.',
                    ],
                    [
                        'src' => asset('images/galeri/FOTO/4.jpg'),
                        'title' => 'Workshop Tari Anak',
                        'description' => 'Latihan fun filled untuk anak usia 6-10 tahun.',
                    ],
                    [
                        'src' => asset('images/galeri/FOTO/5.jpg'),
                        'title' => 'Tour Komunitas Budaya',
                        'description' => 'Pertunjukan di ruang publik dan taman kota.',
                    ],
                    [
                        'src' => asset('images/galeri/FOTO/6.jpg'),
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
            <div class="mx-auto max-w-7xl px-6 pb-6">
                <div class="relative mx-auto max-w-7xl w-full px-6 h-[420px] overflow-hidden rounded-[32px] border border-white/40 bg-white/30 shadow-[0_22px_55px_-20px_rgba(254,218,96,0.55)] backdrop-blur-md md:h-[520px]" data-carousel>
                    <div class="flex h-full  transition-transform duration-700 ease-in-out" data-carousel-track>
                        @foreach ($carouselSlides as $slide)
                            <div class="relative flex h-full w-full flex-shrink-0" data-title="{{ $slide['title'] }}" data-description="{{ $slide['description'] }}">
                                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="h-full w-full object-cover transition duration-[2500ms] ease-out will-change-transform" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/35 to-transparent"></div>
                                <div class="absolute bottom-10 left-6 right-6 hidden rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur-sm lg:block">
                                    <p class="text-xs uppercase tracking-[0.4em] text-[#FEDA60]/90">Sorotan</p>
                                    <p class="mt-1 text-lg font-semibold text-white">{{ $slide['title'] }}</p>
                                    <p class="mt-1 text-sm text-white/75">{{ $slide['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="sr-only" data-carousel-title>{{ $carouselSlides[0]['title'] }}</div>
                    <div class="sr-only" data-carousel-description>{{ $carouselSlides[0]['description'] }}</div>

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
                            <button type="button" class="h-2.5 rounded-full border border-white/50 transition-all duration-300 {{ $index === 0 ? 'w-8 bg-[#FEDA60]' : 'w-3 bg-white/40' }}" data-carousel-indicator="{{ $index }}" aria-label="Tampilkan {{ $slide['title'] }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>
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
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 bg-white px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 hover:bg-[#FEDA60]/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-tab-target="images" aria-selected="true">
                        Gambar
                    </button>
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 bg-white px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 hover:bg-[#FEDA60]/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-tab-target="video" aria-selected="false">
                        Video
                    </button>
                    <button type="button" class="tab-button inline-flex items-center justify-center rounded-full border border-[#FEDA60]/70 bg-white px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:-translate-y-0.5 hover:bg-[#FEDA60]/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-tab-target="music" aria-selected="false">
                        Music
                    </button>
                </div>
            </div>

            <div class="mt-12 space-y-12">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-tab-panel="images">
                    @foreach ($imageGallery as $image)
                        <button type="button" class="group relative block overflow-hidden  border border-[#FEDA60]/40 bg-white shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-[#FEDA60]/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-trigger data-modal-kind="image" data-modal-src="{{ $image['src'] }}" data-modal-title="{{ $image['title'] }}" data-modal-description="{{ $image['description'] }}">
                                <div class="relative aspect-square w-full overflow-hidden  bg-[#FFF0C2] md:aspect-[4/3]">
                                <img src="{{ $image['src'] }}" alt="{{ $image['title'] }}" class="h-full w-full object-cover transition duration-[1600ms] ease-out group-hover:scale-110" loading="lazy">
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-50 transition duration-500 group-hover:opacity-80"></div>
                                <div class="pointer-events-none absolute inset-0 flex translate-y-6 flex-col justify-end gap-3 bg-gradient-to-t from-[#FEDA60]/90 via-[#FEDA60]/65 to-transparent px-6 pb-7 pt-16 text-left text-white opacity-0 shadow-[0_22px_50px_-30px_rgba(254,218,96,0.85)] transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                                    <h4 class="text-lg font-semibold drop-shadow">{{ $image['title'] }}</h4>
                                    <p class="text-sm text-white/85">{{ $image['description'] }}</p>
                                    <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.35em] text-white">Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75v5.25a.75.75 0 0 1-.75.75H11.25m0 0 3 3m-3-3 3-3M6.75 17.25v-5.25a.75.75 0 0 1 .75-.75H12.75" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                <div class="hidden" data-tab-panel="video">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($videoGallery as $video)
                            <button type="button" class="group relative block overflow-hidden  border border-[#FEDA60]/40 bg-[#FFF8DC] shadow-lg shadow-[#FEDA60]/20 transition duration-500 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-[#FEDA60]/35 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-trigger data-modal-kind="video" data-modal-src="{{ $video['source'] }}" data-modal-title="{{ $video['title'] }}" data-modal-description="{{ $video['description'] }}">
                                <div class="relative aspect-video w-full overflow-hidden ">
                                    <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="h-full w-full object-cover transition duration-[1600ms] ease-out group-hover:scale-110" loading="lazy">
                                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-60 transition duration-500 group-hover:opacity-85"></div>
                                    <div class="pointer-events-none absolute inset-0 flex translate-y-8 flex-col items-center justify-end gap-4 bg-gradient-to-t from-[#FEDA60]/90 via-[#FEDA60]/60 to-transparent px-6 pb-8 pt-20 text-center text-white opacity-0 shadow-[0_22px_50px_-30px_rgba(254,218,96,0.85)] transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                                        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-[#8C6A08] shadow-lg shadow-black/20 transition duration-500 group-hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                                                <path d="M8.25 5.5a1 1 0 0 1 1.54-.84l7.5 5.02a1 1 0 0 1 0 1.64l-7.5 5.02A1 1 0 0 1 8.25 15.5V5.5Z" />
                                            </svg>
                                        </span>
                                        <div class="flex w-full flex-col gap-2">
                                            <h4 class="text-lg font-semibold drop-shadow">{{ $video['title'] }}</h4>
                                            <p class="text-sm text-white/85">{{ $video['description'] }}</p>
                                            <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.35em] text-white">Putar Video
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="hidden" data-tab-panel="music">
                    <div class="space-y-4">
                        @foreach ($musicTracks as $track)
                            <div class="relative flex flex-col gap-6 rounded-[28px] border border-[#FEDA60]/45 bg-[#FFF9E5] p-6 shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#FEDA60]/25 sm:flex-row sm:items-center sm:justify-between" data-music-item>
                                <div class="flex flex-col gap-2">
                                    <span class="inline-flex w-max items-center gap-2 rounded-full bg-white/70 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#C29C24]">
                                        Musik
                                    </span>
                                    <p class="text-lg font-semibold text-[#2E2E2E]">{{ $track['title'] }}</p>
                                    <p class="text-sm text-[#4F4F4F]">{{ $track['description'] }}</p>
                                </div>
                                <div class="flex w-full flex-col gap-4 sm:w-auto sm:flex-row sm:items-center">
                                    <div class="h-1 w-full rounded-full bg-[#FEDA60]/30 sm:w-32">
                                        <div class="h-full w-full rounded-full bg-[#FEDA60]"></div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button type="button" class="music-toggle inline-flex items-center gap-2 rounded-full border border-[#FEDA60]/50 bg-white px-5 py-2 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition hover:bg-[#FEDA60]/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-music-toggle>
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
                                <div class="pointer-events-none absolute inset-y-0 left-0 hidden w-[6px] rounded-l-[28px] bg-gradient-to-b from-[#FEDA60] via-[#FEDA60]/60 to-[#FFF6D5] sm:block" aria-hidden="true"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="gallery-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center px-4 py-10 opacity-0 transition-opacity duration-200 ease-out pointer-events-none">
        <div class="absolute inset-0 opacity-0 transition-opacity duration-200" data-modal-overlay>
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 opacity-65 mix-blend-soft-light bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 160 160%22 fill=%22none%22%3E%3Cpath d=%22M80 0L160 80L80 160L0 80Z%22 stroke=%23FEDA60 stroke-width=%221.1%22 opacity=%220.32%22/%3E%3Cpath d=%22M0 0L80 80L0 160%22 stroke=%23F4C453 stroke-width=%220.8%22 opacity=%220.24%22/%3E%3Cpath d=%22M160 0L80 80L160 160%22 stroke=%23F4C453 stroke-width=%220.8%22 opacity=%220.24%22/%3E%3Ccircle cx=%2280%22 cy=%2280%22 r=%226%22 fill=%23FEDA60 opacity=%220.18%22/%3E%3C/svg%3E')] bg-[length:180px_180px]"></div>
        </div>
        <div class="relative z-10 w-full max-w-3xl transform overflow-hidden rounded-xl border border-white/35 bg-white/95 shadow-xl shadow-black/30 transition-all duration-200 ease-out translate-y-4 scale-95 opacity-0" data-modal-content>
            <div class="pointer-events-none absolute inset-0 opacity-85 mix-blend-soft-light bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 120 120%22 fill=%22none%22%3E%3Cpath d=%22M60 0L120 60L60 120L0 60Z%22 stroke=%23FEDA60 stroke-width=%221%22 opacity=%220.35%22/%3E%3Cpath d=%22M0 0L60 60L0 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Cpath d=%22M120 0L60 60L120 120%22 stroke=%23F4C453 stroke-width=%220.7%22 opacity=%220.25%22/%3E%3Ccircle cx=%2260%22 cy=%2260%22 r=%225%22 fill=%23FEDA60 opacity=%220.2%22/%3E%3C/svg%3E')] bg-[length:140px_140px]" aria-hidden="true"></div>
            <div class="grid gap-5 p-5 md:grid-cols-[5fr,4fr] md:p-8">
                <div class="flex items-center justify-center">
                    <div class="relative flex w-full max-h-[65vh] min-h-[200px] items-center justify-center overflow-hidden rounded-lg border border-[#FEDA60]/25 bg-[#FFF9E5]" data-modal-media>
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
                    <div class="mt-auto flex flex-wrap items-center gap-2" data-modal-actions>
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
                const AUTOPLAY_INTERVAL = 4000;
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
                        indicator.classList.toggle('w-3', !isActive);
                        indicator.classList.toggle('bg-white/40', !isActive);
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
                    autoPlayTimer = setInterval(() => moveNext(true), AUTOPLAY_INTERVAL);
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
                    button.classList.remove('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-lg', 'shadow-[#FEDA60]/40', 'border-transparent');
                    button.classList.add('bg-white', 'text-[#8C6A08]', 'border-[#FEDA60]/70');
                    button.setAttribute('aria-selected', 'false');
                };

                const activateButton = (button) => {
                    button.classList.add('bg-[#FEDA60]', 'text-[#2E2E2E]', 'shadow-lg', 'shadow-[#FEDA60]/40', 'border-transparent');
                    button.classList.remove('bg-white', 'text-[#8C6A08]', 'border-[#FEDA60]/70');
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
