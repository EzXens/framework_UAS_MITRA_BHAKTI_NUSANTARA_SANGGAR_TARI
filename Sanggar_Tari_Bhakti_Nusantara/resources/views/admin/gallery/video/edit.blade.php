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
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Edit Video</h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">
                <div class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-800 mb-1">Terjadi Kesalahan</h3>
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.gallery.video.update', $video) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $video->title) }}" required class="w-full px-4 py-3 rounded-xl border @error('title') border-red-500 @else border-gray-300 @enderror focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 text-gray-900 placeholder-gray-400">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full px-4 py-3 rounded-xl border @error('description') border-red-500 @else border-gray-300 @enderror focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 text-gray-900 placeholder-gray-400">{{ old('description', $video->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">URL Video (YouTube Embed) <span class="text-red-500">*</span></label>
                <input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}" required class="w-full px-4 py-3 rounded-xl border @error('video_url') border-red-500 @else border-gray-300 @enderror focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 text-gray-900 placeholder-gray-400">
                <p class="text-xs text-gray-500 mt-1">Gunakan URL embed YouTube (bukan URL biasa). Contoh: https://www.youtube.com/embed/dQw4w9WgXcQ</p>
                @error('video_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Thumbnail Saat Ini</label>
                <img src="{{ asset($video->thumbnail) }}" class="w-full max-w-md aspect-video object-cover rounded-xl mb-4">
                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Ganti Thumbnail (Opsional)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-3 rounded-xl border @error('thumbnail') border-red-500 @else border-gray-300 @enderror focus:border-[#FEDA60] text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#FEDA60] file:text-white hover:file:bg-[#F5B347]">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                @error('thumbnail')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $video->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-[#FEDA60] focus:ring-[#FEDA60]">
                <label class="text-sm font-semibold text-[#2E2E2E]">Aktifkan video ini</label>
            </div>

            <div class="flex gap-4 pt-6 border-t">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold">
                    Update Video
                </button>
                <a href="{{ route('admin.gallery.video.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
