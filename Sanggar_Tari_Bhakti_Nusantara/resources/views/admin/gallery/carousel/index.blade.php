@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelola Carousel/Sorotan</h1>
                        <p class="text-[#4F4F4F] mt-2">Atur urutan dan konten carousel di halaman galeri</p>
                    </div>
                    <a href="{{ route('admin.gallery.carousel.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Carousel
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-200 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid gap-6">
                    @forelse($carousels as $carousel)
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all">
                            <div class="flex gap-6">
                                <div class="flex-shrink-0 w-48 h-32 rounded-xl overflow-hidden bg-gray-100">
                                    <img src="{{ asset($carousel->image) }}" alt="{{ $carousel->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="text-xl font-bold text-[#2E2E2E]">{{ $carousel->title }}</h3>
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $carousel->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                                    {{ $carousel->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                                <span class="px-3 py-1 rounded-full bg-[#FEDA60]/20 text-[#8C6A08] text-xs font-semibold">
                                                    Urutan: {{ $carousel->order }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-[#4F4F4F] mb-4">{{ $carousel->description }}</p>
                                            <p class="text-xs text-gray-500">Dibuat: {{ $carousel->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.gallery.carousel.edit', $carousel) }}" class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.gallery.carousel.destroy', $carousel) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus carousel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-[#2E2E2E] mb-2">Belum Ada Carousel</h3>
                            <p class="text-[#4F4F4F] mb-6">Mulai tambahkan carousel untuk ditampilkan di halaman galeri</p>
                            <a href="{{ route('admin.gallery.carousel.create') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Carousel Pertama
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
