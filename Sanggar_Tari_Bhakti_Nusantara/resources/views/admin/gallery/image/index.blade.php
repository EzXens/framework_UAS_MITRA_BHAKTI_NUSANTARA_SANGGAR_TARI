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
                        <h1 class="text-2xl md:text-3xl font-bold text-[#2E2E2E]">Kelola Gambar Galeri</h1>
                        <p class="text-[#4F4F4F] mt-2">Kelola gambar yang ditampilkan di galeri</p>
                    </div>
                    <a href="{{ route('admin.gallery.image.create') }}" class="inline-flex items-center gap-2 px-4 md:px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all text-sm md:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Gambar
                    </a>
                </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($images as $image)
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-4 shadow-lg hover:shadow-xl transition-all">
                    <div class="aspect-square w-full rounded-xl overflow-hidden bg-gray-100 mb-4">
                        <img src="{{ asset($image->image) }}" alt="{{ $image->title }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-[#2E2E2E] mb-1">{{ $image->title }}</h3>
                            <p class="text-sm text-[#4F4F4F] line-clamp-2">{{ $image->description }}</p>
                        </div>
                        <span class="ml-2 px-3 py-1 rounded-full text-xs font-semibold {{ $image->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $image->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.gallery.image.edit', $image) }}" class="flex-1 p-2 text-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-all text-sm font-semibold">
                            Edit
                        </a>
                        <form action="{{ route('admin.gallery.image.destroy', $image) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')" class="flex-1">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Gambar</h3>
                    <p class="text-[#4F4F4F] mb-6">Mulai tambahkan gambar untuk ditampilkan di galeri</p>
                    <a href="{{ route('admin.gallery.image.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Gambar Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($images->hasPages())
            <div class="mt-8">
                {{ $images->links() }}
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
