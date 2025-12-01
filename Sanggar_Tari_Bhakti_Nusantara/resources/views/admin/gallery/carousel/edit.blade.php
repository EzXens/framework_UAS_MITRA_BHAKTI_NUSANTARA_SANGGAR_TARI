@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5] p-6 lg:p-10">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.gallery.carousel.index') }}" class="inline-flex items-center gap-2 text-[#8C6A08] hover:text-[#FEDA60] mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Edit Carousel</h1>
            <p class="text-[#4F4F4F] mt-2">Perbarui informasi carousel</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-200 text-red-800">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.gallery.carousel.update', $carousel) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $carousel->title) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-[#2E2E2E] mb-2">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">{{ old('description', $carousel->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Gambar Saat Ini</label>
                    <div class="mb-4">
                        <img src="{{ asset($carousel->image) }}" alt="{{ $carousel->title }}" class="w-full max-w-md h-48 object-cover rounded-xl">
                    </div>
                    <label for="image" class="block text-sm font-semibold text-[#2E2E2E] mb-2">Ganti Gambar (Opsional)</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</p>
                </div>

                <div>
                    <label for="order" class="block text-sm font-semibold text-[#2E2E2E] mb-2">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" id="order" name="order" value="{{ old('order', $carousel->order) }}" min="0" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#FEDA60] focus:ring-2 focus:ring-[#FEDA60]/20 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Semakin kecil angka, semakin awal ditampilkan.</p>
                </div>

                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $carousel->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-[#FEDA60] focus:ring-[#FEDA60]">
                    <label for="is_active" class="text-sm font-semibold text-[#2E2E2E]">Aktifkan carousel ini</label>
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="submit" class="flex-1 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-white font-semibold hover:shadow-xl transition-all">
                    Update Carousel
                </button>
                <a href="{{ route('admin.gallery.carousel.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
