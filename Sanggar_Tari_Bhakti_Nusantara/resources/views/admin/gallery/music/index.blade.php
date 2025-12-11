@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        <!-- sidebar -->
        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 h-screen w-64 bg-[#2E2E2E] text-white transition-transform duration-300 z-40 lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <!-- logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        <span class="text-lg font-semibold text-[#FEDA60]">Admin Dashboard</span>
                    </div>
                </div>

                <!-- nav -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('classes.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        Kelola Kelas
                    </a>
                    <a href="{{ route('products.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        Kelola Produk
                    </a>
                    
                    <!-- Gallery Management -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Galeri Media</p>
                    </div>
                    <a href="{{ route('admin.gallery.carousel.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        Carousel/Sorotan
                    </a>
                    <a href="{{ route('admin.gallery.image.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        Gambar Galeri
                    </a>
                    <a href="{{ route('admin.gallery.video.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                        </svg>
                        Video Galeri
                    </a>
                    <a href="{{ route('admin.gallery.music.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl bg-[#FEDA60]/10 text-[#FEDA60] transition-all text-sm active">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                        </svg>
                        Musik Galeri
                    </a>
                </nav>

                <div class="p-4 border-t border-white/10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </aside>

        <!-- sidebar toggle (mobile) -->
        <button id="sidebar-toggle" class="fixed top-4 left-4 z-50 lg:hidden p-2 rounded-xl bg-[#2E2E2E] text-white shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelola Musik Galeri</h1>
                        <p class="text-[#4F4F4F] mt-2">Kelola musik yang ditampilkan di galeri</p>
                    </div>
                    <a href="{{ route('admin.gallery.music.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Musik
                    </a>
                </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6">
            @forelse($music as $track)
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all flex gap-6 items-start">
                    <div class="flex-shrink-0 w-28 h-28 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                        </svg>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <h3 class="text-lg lg:text-xl font-semibold text-[#2E2E2E] truncate">{{ $track->title }}</h3>
                                <p class="text-sm text-[#4F4F4F] mt-1 line-clamp-2">{{ $track->description }}</p>
                                <p class="text-xs text-gray-600 mt-3 inline-block px-3 py-1 rounded-lg bg-yellow-100">
                                    <span class="font-mono text-yellow-700">{{ basename($track->audio_file) }}</span>
                                </p>
                            </div>

                            <div class="flex flex-col items-end gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $track->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $track->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>

                                <div class="flex gap-2">
                                    <a href="{{ route('admin.gallery.music.edit', $track) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-all text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487l3.651 3.65m0 0L8.5 19.198l-4 1 1-4L20.513 3.487z"/></svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.gallery.music.toggle', $track) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg {{ $track->is_active ? 'bg-yellow-50 text-yellow-700 border border-yellow-200 hover:bg-yellow-100' : 'bg-gray-50 text-gray-700 border border-gray-200 hover:bg-gray-100' }} transition-all text-sm">
                                            @if($track->is_active)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                            Nonaktifkan
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                            Aktifkan
                                            @endif
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.gallery.music.destroy', $track) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus musik ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-all text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="group relative flex flex-col gap-3 rounded-lg border border-[#FEDA60]/40 bg-white p-4 shadow-sm hover:shadow-md transition-all">
                                <!-- Progress Bar -->
                                <div class="space-y-1.5">
                                    <div class="h-1.5 w-full rounded-full bg-[#FEDA60]/20 overflow-hidden cursor-pointer hover:h-2 transition-all" data-music-progress-container>
                                        <div class="h-full w-0 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#FED84D] transition-all duration-300" data-music-progress></div>
                                    </div>
                                    <div class="flex justify-between text-xs font-medium text-[#4F4F4F]">
                                        <span data-music-current>0:00</span>
                                        <span data-music-duration>--:--</span>
                                    </div>
                                </div>

                                <!-- Play Button -->
                                <div class="flex items-center gap-3">
                                    <button type="button" class="music-toggle inline-flex items-center justify-center gap-2 rounded-lg border border-[#FEDA60]/50 bg-white px-4 py-2.5 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition duration-300 hover:bg-[#FEDA60]/30 hover:border-[#FEDA60]" data-music-toggle>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" data-music-icon-play>
                                            <path d="M5.25 4.5a.75.75 0 0 1 1.14-.64l12 7.5a.75.75 0 0 1 0 1.28l-12 7.5A.75.75 0 0 1 5.25 19.5V4.5Z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden h-5 w-5" data-music-icon-pause>
                                            <path d="M6.75 5.25A.75.75 0 0 1 7.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25ZM13.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H13.5a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75Z" />
                                        </svg>
                                        <span data-music-label>Play</span>
                                    </button>
                                </div>

                                <!-- Hidden Audio Element -->
                                <audio class="hidden" preload="metadata" data-music-audio crossorigin="anonymous">
                                    <source src="{{ asset($track->audio_file) }}" type="audio/mpeg">
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Musik</h3>
                    <p class="text-[#4F4F4F] mb-6">Mulai tambahkan musik untuk ditampilkan di galeri</p>
                    <a href="{{ route('admin.gallery.music.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Musik Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($music->hasPages())
            <div class="mt-8">
                {{ $music->links() }}
            </div>
        @endif
            </div>
        </main>
    </div>
</div>

<script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    // Music player initialization
    const initializeMusicPlayers = () => {
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
            if (isNaN(seconds) || !isFinite(seconds)) return '--:--';
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        };

        document.querySelectorAll('[data-music-audio]').forEach(audio => {
            // Find the closest .group container (the player wrapper)
            const container = audio.closest('.group');
            if (!container) {
                console.error('No container found for audio element');
                return;
            }

            const toggleBtn = container.querySelector('[data-music-toggle]');
            const progressBar = container.querySelector('[data-music-progress]');
            const progressContainer = container.querySelector('[data-music-progress-container]');
            const currentTimeEl = container.querySelector('[data-music-current]');
            const durationEl = container.querySelector('[data-music-duration]');

            if (!audio || !toggleBtn) {
                console.error('Missing required elements:', { audio, toggleBtn });
                return;
            }

            setButtonState(toggleBtn, false);
            let isSeeking = false;

            // Function to update duration display
            const updateDurationDisplay = () => {
                if (durationEl && audio.duration && isFinite(audio.duration)) {
                    durationEl.textContent = formatTime(audio.duration);
                    console.log('Duration loaded:', audio.src, formatTime(audio.duration));
                }
            };

            // Load metadata to get duration
            audio.addEventListener('loadedmetadata', updateDurationDisplay);
            audio.addEventListener('durationchange', updateDurationDisplay);
            
            // Timeout fallback to force metadata load
            setTimeout(() => {
                if (audio.duration && isFinite(audio.duration)) {
                    updateDurationDisplay();
                } else {
                    // Try to trigger load
                    audio.load();
                }
            }, 500);

            // Update progress bar and current time
            audio.addEventListener('timeupdate', () => {
                if (progressBar && !isSeeking && audio.duration) {
                    const percent = (audio.currentTime / audio.duration) * 100;
                    progressBar.style.width = percent + '%';
                }
                if (currentTimeEl && !isSeeking) {
                    currentTimeEl.textContent = formatTime(audio.currentTime);
                }
            });

            // Seek function
            const updateProgress = (clientX) => {
                if (!progressContainer || !audio.duration || isNaN(audio.duration)) return;
                
                const rect = progressContainer.getBoundingClientRect();
                const x = clientX - rect.left;
                const clampedX = Math.max(0, Math.min(x, rect.width));
                const percent = clampedX / rect.width;
                const newTime = percent * audio.duration;
                
                audio.currentTime = newTime;
                
                if (progressBar) {
                    progressBar.style.width = (percent * 100) + '%';
                }
                
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
                if (audio.paused || audio.ended) {
                    if (activeAudio && activeAudio !== audio) {
                        activeAudio.pause();
                        activeAudio.currentTime = 0;
                    }
                    if (activeButton && activeButton !== toggleBtn) {
                        setButtonState(activeButton, false);
                    }
                    audio.play().then(() => {
                        activeAudio = audio;
                        activeButton = toggleBtn;
                        setButtonState(toggleBtn, true);
                    }).catch((err) => {
                        console.error('Play error:', err);
                        setButtonState(toggleBtn, false);
                    });
                } else {
                    audio.pause();
                    audio.currentTime = 0;
                    if (activeAudio === audio) {
                        activeAudio = null;
                        activeButton = null;
                    }
                    setButtonState(toggleBtn, false);
                }
            });

            audio.addEventListener('ended', () => {
                if (activeAudio === audio) {
                    activeAudio = null;
                    activeButton = null;
                }
                setButtonState(toggleBtn, false);
            });

            audio.addEventListener('pause', () => {
                if (activeAudio === audio && !audio.ended) {
                    activeAudio = null;
                    activeButton = null;
                    setButtonState(toggleBtn, false);
                }
            });
        });
    };

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeMusicPlayers);
    } else {
        initializeMusicPlayers();
    }
</script>
@endsection
