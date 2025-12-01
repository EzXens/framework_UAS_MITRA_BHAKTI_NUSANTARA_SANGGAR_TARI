@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5] p-6 lg:p-10">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.gallery.video.index') }}" class="inline-flex items-center gap-2 text-[#8C6A08] hover:text-[#FEDA60] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Tambah Video Baru</h1>
        </div>

        <form action="{{ route('admin.gallery.video.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20">
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">URL Video (YouTube Embed) <span class="text-red-500">*</span></label>
                <input type="url" name="video_url" placeholder="https://www.youtube.com/embed/VIDEO_ID?autoplay=1&rel=0" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20">
                <p class="text-xs text-gray-500 mt-1">Gunakan URL embed YouTube (bukan URL biasa). Contoh: https://www.youtube.com/embed/dQw4w9WgXcQ</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Thumbnail <span class="text-red-500">*</span></label>
                <input type="file" name="thumbnail" accept="image/*" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60]">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 rounded border-gray-300 text-[#FEDA60]">
                <label class="text-sm font-semibold text-[#2E2E2E]">Aktifkan video ini</label>
            </div>

            <div class="flex gap-4 pt-6 border-t">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl">
                    Simpan Video
                </button>
                <a href="{{ route('admin.gallery.video.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
