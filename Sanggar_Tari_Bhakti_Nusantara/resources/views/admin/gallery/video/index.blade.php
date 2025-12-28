@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-[#2E2E2E]">Kelola Video Galeri</h1>
                        <p class="text-[#4F4F4F] mt-2">Kelola video yang ditampilkan di galeri</p>
                    </div>
                    <a href="{{ route('admin.gallery.video.create') }}" class="inline-flex items-center gap-2 px-4 md:px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all text-sm md:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Video
                    </a>
                </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($videos as $video)
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-4 shadow-lg hover:shadow-xl transition-all">
                    <div class="aspect-video w-full rounded-xl overflow-hidden bg-gray-100 mb-4 relative">
                        <img src="{{ asset($video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                            <div class="w-12 h-12 rounded-full bg-white/90 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-[#8C6A08]">
                                    <path d="M8.25 5.5a1 1 0 0 1 1.54-.84l7.5 5.02a1 1 0 0 1 0 1.64l-7.5 5.02A1 1 0 0 1 8.25 15.5V5.5Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-[#2E2E2E] mb-1">{{ $video->title }}</h3>
                            <p class="text-sm text-[#4F4F4F] line-clamp-2">{{ $video->description }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ Str::limit($video->video_url, 40) }}</p>
                        </div>
                        <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold {{ $video->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $video->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.gallery.video.edit', $video) }}" class="flex-1 p-2 text-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-all text-sm font-semibold">
                            Edit
                        </a>
                        <form action="{{ route('admin.gallery.video.destroy', $video) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus video ini?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-all text-sm font-semibold">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Video</h3>
                    <p class="text-[#4F4F4F] mb-6">Mulai tambahkan video untuk ditampilkan di galeri</p>
                    <a href="{{ route('admin.gallery.video.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Video Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($videos->hasPages())
            <div class="mt-8">
                {{ $videos->links() }}
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
</script>
@endsection
