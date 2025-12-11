<div id="media-content" class="mt-12 space-y-12">
    <!-- Images Tab -->
    <div class="{{ $activeTab === 'images' ? '' : 'hidden' }}" data-tab-panel="images">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($imageGallery as $image)
            <button type="button" class="group relative block overflow-hidden border border-[#FEDA60]/40 bg-white shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-[#FEDA60]/25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-trigger data-modal-kind="image" data-modal-src="{{ asset($image->image) }}" data-modal-title="{{ $image->title }}" data-modal-description="{{ $image->description }}">
                <div class="relative aspect-square w-full overflow-hidden bg-[#FFF0C2] md:aspect-[4/3]">
                    <img src="{{ asset($image->image) }}" alt="{{ $image->title }}" class="h-full w-full object-cover transition duration-[1600ms] ease-out group-hover:scale-110" loading="lazy">
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-50 transition duration-500 group-hover:opacity-80"></div>
                    <div class="pointer-events-none absolute inset-0 flex translate-y-6 flex-col justify-end gap-3 bg-gradient-to-t from-[#FEDA60]/90 via-[#FEDA60]/65 to-transparent px-6 pb-7 pt-16 text-left text-white opacity-0 shadow-[0_22px_50px_-30px_rgba(254,218,96,0.85)] transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                        <h4 class="text-lg font-semibold drop-shadow">{{ $image->title }}</h4>
                        <p class="text-sm text-white/85">{{ $image->description }}</p>
                        <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.35em] text-white">Lihat Detail
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75v5.25a.75.75 0 0 1-.75.75H11.25m0 0 3 3m-3-3 3-3M6.75 17.25v-5.25a.75.75 0 0 1 .75-.75H12.75" />
                            </svg>
                        </span>
                    </div>
                </div>
            </button>
        @empty
            <div class="col-span-full rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Gambar</h3>
                <p class="text-[#4F4F4F]">Belum ada gambar yang tersedia saat ini.</p>
            </div>
        @endforelse
        </div>
        
        <!-- Pagination for Images -->
        @if($imageGallery instanceof \Illuminate\Pagination\LengthAwarePaginator && $imageGallery->hasPages())
            <div class="mt-8">
                {{ $imageGallery->links() }}
            </div>
        @endif
    </div>

    <!-- Videos Tab -->
    <div class="{{ $activeTab === 'video' ? '' : 'hidden' }}" data-tab-panel="video">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($videoGallery as $video)
                <button type="button" class="group relative block overflow-hidden border border-[#FEDA60]/40 bg-[#FFF8DC] shadow-lg shadow-[#FEDA60]/20 transition duration-500 hover:-translate-y-1.5 hover:shadow-2xl hover:shadow-[#FEDA60]/35 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60]" data-modal-trigger data-modal-kind="video" data-modal-src="{{ $video->video_url }}" data-modal-title="{{ $video->title }}" data-modal-description="{{ $video->description }}">
                    <div class="relative aspect-video w-full overflow-hidden">
                        <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" class="h-full w-full object-cover transition duration-[1600ms] ease-out group-hover:scale-110" loading="lazy">
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-60 transition duration-500 group-hover:opacity-85"></div>
                        <div class="pointer-events-none absolute inset-0 flex translate-y-8 flex-col items-center justify-end gap-4 bg-gradient-to-t from-[#FEDA60]/90 via-[#FEDA60]/60 to-transparent px-6 pb-8 pt-20 text-center text-white opacity-0 shadow-[0_22px_50px_-30px_rgba(254,218,96,0.85)] transition-all duration-500 ease-out group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-[#8C6A08] shadow-lg shadow-black/20 transition duration-500 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-7 w-7">
                                    <path d="M8.25 5.5a1 1 0 0 1 1.54-.84l7.5 5.02a1 1 0 0 1 0 1.64l-7.5 5.02A1 1 0 0 1 8.25 15.5V5.5Z" />
                                </svg>
                            </span>
                            <div class="flex w-full flex-col gap-2">
                                <h4 class="text-lg font-semibold drop-shadow">{{ $video->title }}</h4>
                                <p class="text-sm text-white/85">{{ $video->description }}</p>
                                <span class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.35em] text-white">Putar Video
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </button>
            @empty
                <div class="col-span-full rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Video</h3>
                    <p class="text-[#4F4F4F]">Belum ada video yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination for Videos -->
        @if($videoGallery instanceof \Illuminate\Pagination\LengthAwarePaginator && $videoGallery->hasPages())
            <div class="mt-8">
                {{ $videoGallery->links() }}
            </div>
        @endif
    </div>

    <!-- Music Tab -->
    <div class="{{ $activeTab === 'music' ? '' : 'hidden' }}" data-tab-panel="music">
        <div class="space-y-5">
            @forelse ($musicTracks as $track)
                <div class="group relative flex flex-col gap-6 rounded-2xl border border-[#FEDA60]/40 bg-white shadow-lg shadow-[#FEDA60]/15 transition duration-500 hover:-translate-y-1 hover:shadow-2xl hover:shadow-[#FEDA60]/25 p-6 sm:flex-row sm:items-center sm:gap-8" data-music-item>
                    <!-- Left Content Area -->
                    <div class="flex flex-col gap-3 flex-grow">
                        <!-- Category Badge -->
                        <span class="inline-flex w-max items-center gap-1.5 rounded-full bg-gradient-to-r from-[#FEDA60]/20 to-[#FEDA60]/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.3em] text-[#C29C24] border border-[#FEDA60]/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-3 w-3">
                                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zM9 14.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6-4a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm6 4a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                            </svg>
                            Musik
                        </span>
                        
                        <!-- Title -->
                        <p class="text-lg font-bold text-[#2E2E2E] line-clamp-2">{{ $track->title }}</p>
                        
                        <!-- Description -->
                        <p class="text-sm text-[#4F4F4F] line-clamp-2">{{ $track->description }}</p>
                        
                        <!-- Progress Bar -->
                        <div class="space-y-2 pt-2">
                            <div class="h-1.5 w-full rounded-full bg-[#FEDA60]/20 overflow-hidden cursor-pointer hover:h-2 transition-all" data-music-progress-container>
                                <div class="h-full w-0 rounded-full bg-gradient-to-r from-[#FEDA60] to-[#FED84D] transition-all duration-300" data-music-progress></div>
                            </div>
                            <div class="flex justify-between text-xs font-medium text-[#4F4F4F]">
                                <span data-music-current>0:00</span>
                                <span data-music-duration>--:--</span>
                            </div>
                        </div>
                        
                        <!-- Audio Player -->
                        <audio src="{{ asset($track->audio_file) }}" preload="metadata" data-music-audio></audio>
                    </div>
                    
                    <!-- Right Action Area -->
                    <div class="flex w-full items-center gap-3 sm:w-auto sm:flex-col sm:gap-4">
                        <!-- Play Button -->
                        <button type="button" class="music-toggle flex-1 inline-flex items-center justify-center gap-2 rounded-lg border border-[#FEDA60]/50 bg-white px-5 py-3 text-sm font-semibold uppercase tracking-wide text-[#8C6A08] transition duration-300 hover:bg-[#FEDA60]/30 hover:border-[#FEDA60] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FEDA60] sm:w-auto sm:flex-none" data-music-toggle>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" data-music-icon-play>
                                <path d="M5.25 4.5a.75.75 0 0 1 1.14-.64l12 7.5a.75.75 0 0 1 0 1.28l-12 7.5A.75.75 0 0 1 5.25 19.5V4.5Z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden h-5 w-5" data-music-icon-pause>
                                <path d="M6.75 5.25A.75.75 0 0 1 7.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25ZM13.5 4.5h2.25a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H13.5a.75.75 0 0 1-.75-.75V5.25a.75.75 0 0 1 .75-.75Z" />
                            </svg>
                            <span data-music-label>Play</span>
                        </button>
                    </div>

                    <!-- Decorative Left Bar -->
                    <div class="pointer-events-none absolute inset-y-0 left-0 hidden w-1 rounded-l-2xl bg-gradient-to-b from-[#FEDA60] via-[#FEDA60]/60 to-[#FFF6D5] sm:block" aria-hidden="true"></div>
                </div>
            @empty
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Musik</h3>
                    <p class="text-[#4F4F4F]">Belum ada musik yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination for Music -->
        @if($musicTracks instanceof \Illuminate\Pagination\LengthAwarePaginator && $musicTracks->hasPages())
            <div class="mt-8">
                {{ $musicTracks->links() }}
            </div>
        @endif
    </div>
</div>
