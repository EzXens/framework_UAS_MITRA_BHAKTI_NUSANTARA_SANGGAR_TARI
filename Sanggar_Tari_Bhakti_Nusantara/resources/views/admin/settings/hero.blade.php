@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-0 p-6 lg:p-10">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2E2E2E] mb-2">Pengaturan Hero Section</h1>
                    <p class="text-[#4F4F4F]">Kelola tampilan hero section di halaman utama</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Hero Text Settings -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-8 mb-6">
                    <h2 class="text-xl font-semibold text-[#2E2E2E] mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#F5B347]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        Text Hero
                    </h2>

                    <form action="{{ route('admin.settings.hero.update') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Hero Title -->
                            <div>
                                <label for="hero_title" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Judul Hero <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="hero_title" 
                                    name="hero_title" 
                                    value="{{ old('hero_title', $heroTitle) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                    placeholder="Contoh: Warisan Budaya dalam Setiap Gerakan"
                                    required
                                >
                                @error('hero_title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hero Subtitle -->
                            <div>
                                <label for="hero_subtitle" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Subtitle Hero <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="hero_subtitle" 
                                    name="hero_subtitle" 
                                    rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                    placeholder="Deskripsi singkat untuk hero section"
                                    required
                                >{{ old('hero_subtitle', $heroSubtitle) }}</textarea>
                                @error('hero_subtitle')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Hero Carousel Images -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-[#2E2E2E] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#F5B347]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            Gambar Carousel
                        </h2>
                        <a href="{{ route('admin.gallery.carousel.create') }}" class="px-4 py-2 bg-[#2E2E2E] text-white rounded-xl hover:bg-[#3E3E3E] transition-all">
                            + Tambah Gambar
                        </a>
                    </div>

                    <p class="text-sm text-[#4F4F4F] mb-6">
                        Gambar carousel dikelola di menu <a href="{{ route('admin.gallery.carousel.index') }}" class="text-[#F5B347] font-semibold hover:underline">Galeri Media → Carousel/Sorotan</a>
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($carousels as $carousel)
                            <div class="relative group rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#F5B347] transition-all">
                                <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" class="w-full h-48 object-cover">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.gallery.carousel.edit', $carousel) }}" class="px-3 py-2 bg-[#FEDA60] text-[#2E2E2E] rounded-lg hover:bg-[#F5B347] transition-all text-sm font-semibold">
                                        Edit
                                    </a>
                                </div>
                                <div class="p-3 bg-white">
                                    <p class="font-semibold text-[#2E2E2E] text-sm truncate">{{ $carousel->title }}</p>
                                    <p class="text-xs text-[#4F4F4F] mt-1">Urutan: {{ $carousel->order }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12 text-[#4F4F4F]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto mb-4 text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <p class="mb-4">Belum ada gambar carousel</p>
                                <a href="{{ route('admin.gallery.carousel.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg transition-all">
                                    Tambah Gambar Carousel
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
