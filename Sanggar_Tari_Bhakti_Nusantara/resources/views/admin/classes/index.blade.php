@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-0 min-w-0">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-[#2E2E2E]">Kelola Kelas</h1>
                        <p class="text-[#4F4F4F] mt-1 text-sm">Manajemen data kelas tari</p>
                    </div>
                    <a href="{{ route('classes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-white rounded-xl hover:shadow-xl transition-all text-sm font-semibold whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Kelas
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Desktop Table View (hidden on mobile) -->
                <div class="hidden lg:block bg-white border border-[#FEDA60]/30 shadow-lg rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-[#FFF6D5]">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Info Kelas</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Instruktur</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jadwal</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kapasitas</th>
                                    {{-- Harga column removed --}}
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($classes as $class)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                @if($class->image)
                                                    <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="h-12 w-12 object-cover rounded-lg flex-shrink-0">
                                                @else
                                                    <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="min-w-0">
                                                    <div class="text-sm font-semibold text-gray-900 truncate">{{ $class->name }}</div>
                                                    <div class="text-xs text-gray-500 truncate">{{ Str::limit($class->description, 40) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            {{ $class->instructor }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-700">
                                            {{ $class->schedule }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-900">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $class->capacity }} orang
                                            </span>
                                        </td>
                                        {{-- price removed --}}
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('classes.edit', $class) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-xs font-semibold">
                                                    Edit
                                                </a>
                                            <button type="button"
                                                    onclick="openDeletePopup({{ $class->id }})"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg 
                                                        hover:bg-red-200 transition-colors text-xs font-semibold">
                                                Hapus
                                            </button>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 mb-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                            </svg>
                                            <p class="text-gray-500 mb-3">Belum ada kelas</p>
                                            <a href="{{ route('classes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#FEDA60] text-[#2E2E2E] rounded-lg hover:bg-[#F5B347] transition-colors text-sm font-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                                Tambah Kelas Pertama
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile Card View (visible on mobile) -->
                <div class="lg:hidden space-y-4">
                    @forelse ($classes as $class)
                        <div class="bg-white border border-[#FEDA60]/30 shadow-lg rounded-xl overflow-hidden">
                            <div class="p-4">
                                <div class="flex gap-3 mb-3">
                                    @if($class->image)
                                        <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="h-20 w-20 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="h-20 w-20 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-base font-bold text-gray-900 mb-1">{{ $class->name }}</h3>
                                        <p class="text-xs text-gray-500 line-clamp-2">{{ $class->description }}</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-2 mb-4 text-sm">
                                    <div class="flex items-center gap-2 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <span class="font-medium">{{ $class->instructor }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>{{ $class->schedule }}</span>
                                    </div>
                                        <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full font-medium">{{ $class->capacity }} orang</span>
                                        </div>
                                        {{-- price removed --}}
                                    </div>
                                </div>

                                <div class="flex gap-2 pt-3 border-t border-gray-100">
                                    <a href="{{ route('classes.edit', $class) }}" class="flex-1 px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-[#FEDA60]/30 shadow-lg rounded-xl p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-400 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                            <p class="text-gray-500 mb-4">Belum ada kelas</p>
                            <a href="{{ route('classes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#FEDA60] text-[#2E2E2E] rounded-lg hover:bg-[#F5B347] transition-colors text-sm font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambah Kelas Pertama
                            </a>
                        </div>
                    @endforelse
                </div>

                @if($classes->hasPages())
                    <div class="mt-6">
                        {{ $classes->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<!-- Popup Konfirmasi hapus -->
<div id="deletePopup"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    
    <div class="bg-white rounded-2xl w-[90%] max-w-sm p-6 shadow-xl text-center">
        <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Penghapusan</h2>
        <p class="mt-2 text-sm text-gray-600">
            Apakah Anda yakin ingin menghapus kelas ini?
        </p>

        <form id="deleteForm" method="POST" class="mt-6">
            @csrf
            @method('DELETE')

            <div class="flex items-center justify-center gap-3">
                <button type="button"
                        onclick="closeDeletePopup()"
                        class="px-4 py-2 rounded-xl bg-[#FEDA60] hover:bg-gray-300 
                               text-gray-800 font-medium transition">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-red-600 hover:bg-red-700 
                               text-white font-semibold transition">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Sukses hapus -->
<div id="successPopup"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-[90%] max-w-sm p-8 shadow-xl text-center relative">
        
        <!-- Icon Centang Animasi -->
        <div class="mx-auto mb-4 w-20 h-20 flex items-center justify-center rounded-full border-4 border-green-500">
            <svg id="successCheck"
                 xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24" stroke-width="2"
                 stroke="green" class="w-12 h-12 opacity-0 scale-50 transition-all duration-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-2">Berhasil</h2>

        <p class="text-gray-600 text-sm mb-6">
            {{ session('success') }}
        </p>

        <button onclick="closeSuccessPopup()"
                class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition">
            OK
        </button>
    </div>
</div>



<script>
    // ========== Popup Delete ==========
    function openDeletePopup(id) {
        const popup = document.getElementById('deletePopup');
        const form = document.getElementById('deleteForm');

        form.action = "/classes/" + id;

        popup.classList.remove("hidden");
        popup.classList.add("flex");
    }

    function closeDeletePopup() {
        const popup = document.getElementById('deletePopup');
        popup.classList.add("hidden");
        popup.classList.remove("flex");
    }

    // ========== Popup Sukses ==========
    function openSuccessPopup() {
        const popup = document.getElementById('successPopup');
        const icon = document.getElementById('successCheck');

        popup.classList.remove("hidden");
        popup.classList.add("flex");

        // Animasi centang
        setTimeout(() => {
            icon.classList.remove("opacity-0", "scale-50");
            icon.classList.add("opacity-100", "scale-100");
        }, 100);
    }

    function closeSuccessPopup() {
        const popup = document.getElementById('successPopup');
        popup.classList.add("hidden");
        popup.classList.remove("flex");
    }
</script>

@if (session('success'))
<script>
    // tampilkan popup sukses setelah muat halaman
    document.addEventListener('DOMContentLoaded', () => {
        openSuccessPopup();
    });
</script>
@endif




@endsection
