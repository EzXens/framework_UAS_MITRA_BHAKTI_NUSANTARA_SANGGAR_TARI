@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- Main Content -->
        <main class="flex-1 lg:ml-0 p-6 lg:p-10">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <a href="{{ route('admin.teachers.index') }}" class="text-[#F5B347] hover:text-[#2E2E2E] font-semibold mb-4 inline-flex items-center gap-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <h1 class="text-3xl font-bold text-[#2E2E2E] mb-2">Edit Pengajar</h1>
                    <p class="text-[#4F4F4F]">Perbarui informasi pengajar</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
                        <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-8">
                    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $teacher->name) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Posisi/Jabatan <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="position" 
                                    name="position" 
                                    value="{{ old('position', $teacher->position) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                    required
                                >
                                @error('position')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Specialization -->
                            <div>
                                <label for="specialization" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Spesialisasi
                                </label>
                                <input 
                                    type="text" 
                                    id="specialization" 
                                    name="specialization" 
                                    value="{{ old('specialization', $teacher->specialization) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                >
                                @error('specialization')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div>
                                <label for="bio" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Biografi/Deskripsi
                                </label>
                                <textarea 
                                    id="bio" 
                                    name="bio" 
                                    rows="4"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                >{{ old('bio', $teacher->bio) }}</textarea>
                                @error('bio')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Current Photo -->
                            @if($teacher->photo)
                                <div>
                                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                        Foto Saat Ini
                                    </label>
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-48 h-48 object-cover rounded-xl border-2 border-gray-200">
                                </div>
                            @endif

                            <!-- Photo Upload -->
                            <div>
                                <label for="photo" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    {{ $teacher->photo ? 'Ganti Foto' : 'Upload Foto' }}
                                </label>
                                <input 
                                    type="file" 
                                    id="photo" 
                                    name="photo" 
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all bg-white text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#F5B347] file:text-[#2E2E2E] file:font-semibold hover:file:bg-[#FEDA60] file:cursor-pointer"
                                >
                                <p class="text-xs text-[#4F4F4F] mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
                                @error('photo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Order -->
                            <div>
                                <label for="order" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Urutan Tampilan
                                </label>
                                <input 
                                    type="number" 
                                    id="order" 
                                    name="order" 
                                    value="{{ old('order', $teacher->order) }}"
                                    min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                >
                                <p class="text-xs text-[#4F4F4F] mt-1">Angka lebih kecil akan ditampilkan lebih dulu</p>
                                @error('order')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-4 pt-4">
                                <a href="{{ route('admin.teachers.index') }}" class="flex-1 px-6 py-3 bg-gray-200 text-[#2E2E2E] font-semibold rounded-xl hover:bg-gray-300 transition-all text-center">
                                    Batal
                                </a>
                                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg transition-all duration-300">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
