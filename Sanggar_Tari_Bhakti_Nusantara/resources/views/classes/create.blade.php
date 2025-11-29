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
                    <a href="{{ route('admin.dashboard') }}#activity" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                        Aktivitas Terbaru
                    </a>
                    <a href="{{ route('classes.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl bg-[#FEDA60]/10 text-[#FEDA60] transition-all text-sm active">
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
            <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Tambah Kelas Baru</h1>
            <a href="{{ route('classes.index') }}" class="text-[#8C6A08] hover:text-[#FEDA60] mt-2 inline-flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white border border-[#FEDA60]/30 shadow-lg rounded-2xl p-6">
            <form action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="instructor" class="block text-sm font-medium text-gray-700 mb-2">Instruktur</label>
                    <input type="text" name="instructor" id="instructor" value="{{ old('instructor') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jadwal Kelas</label>
                    <div class="mb-4">
                        <label class="block text-xs text-gray-600 mb-2">Hari</label>
                        <div class="grid grid-cols-4 gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Senin" {{ in_array('Senin', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Senin</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Selasa" {{ in_array('Selasa', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Selasa</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Rabu" {{ in_array('Rabu', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Rabu</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Kamis" {{ in_array('Kamis', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Kamis</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Jumat" {{ in_array('Jumat', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Jumat</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Sabtu" {{ in_array('Sabtu', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Sabtu</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Minggu" {{ in_array('Minggu', old('days', [])) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Minggu</span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Pilih satu atau beberapa hari</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-xs text-gray-600 mb-1">Waktu Mulai (24 Jam)</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 14:00)</p>
                        </div>
                        <div>
                            <label for="end_time" class="block text-xs text-gray-600 mb-1">Waktu Selesai (24 Jam)</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 16:00)</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" min="1" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Kelas</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-white rounded-xl hover:shadow-xl transition-all">
                        Simpan Kelas
                    </button>
                    <a href="{{ route('classes.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-xl hover:bg-gray-400 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Sidebar toggle for mobile
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        
        if (window.innerWidth < 1024 && 
            !sidebar.contains(event.target) && 
            !toggle.contains(event.target) &&
            !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
@endsection
