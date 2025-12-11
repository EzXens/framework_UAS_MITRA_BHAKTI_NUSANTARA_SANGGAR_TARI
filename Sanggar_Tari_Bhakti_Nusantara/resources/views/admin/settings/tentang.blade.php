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
                    <h1 class="text-3xl font-bold text-[#2E2E2E] mb-2">Pengaturan Tentang</h1>
                    <p class="text-[#4F4F4F]">Kelola visi, misi, dan informasi tentang sanggar</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Visi & Misi Settings -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-8 mb-6">
                    <h2 class="text-xl font-semibold text-[#2E2E2E] mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#F5B347]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                        Visi & Misi
                    </h2>

                    <form action="{{ route('admin.settings.tentang.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Visi -->
                            <div>
                                <label for="about_vision" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Visi <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    id="about_vision" 
                                    name="about_vision" 
                                    rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                    placeholder="Tuliskan visi sanggar..."
                                    required
                                >{{ old('about_vision', $visi) }}</textarea>
                                @error('about_vision')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Misi -->
                            <div>
                                <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Misi <span class="text-red-500">*</span>
                                </label>
                                <div id="misi-container" class="space-y-3">
                                    @foreach($misi as $index => $item)
                                        <div class="flex gap-2 misi-item">
                                            <div class="flex-1">
                                                <input 
                                                    type="text" 
                                                    name="about_mission[]" 
                                                    value="{{ old('about_mission.' . $index, $item) }}"
                                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                                                    placeholder="Poin misi ke-{{ $index + 1 }}"
                                                    required
                                                >
                                            </div>
                                            @if($index > 0)
                                                <button type="button" onclick="removeMisi(this)" class="px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" onclick="addMisi()" class="mt-3 px-4 py-2 bg-[#2E2E2E] text-white rounded-xl hover:bg-[#3E3E3E] transition-all text-sm flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tambah Poin Misi
                                </button>
                                @error('about_mission.*')
                                    <p class="text-red-500 text-sm mt-1">Semua poin misi wajib diisi</p>
                                @enderror
                            </div>

                            <!-- About Image -->
                            <div>
                                <label for="about_image" class="block text-sm font-semibold text-[#2E2E2E] mb-2">
                                    Gambar Tentang
                                </label>
                                @if($aboutImage)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $aboutImage) }}" alt="About Image" class="w-48 h-48 object-cover rounded-xl border-2 border-gray-200">
                                    </div>
                                @endif
                                <input 
                                    type="file" 
                                    id="about_image" 
                                    name="about_image" 
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all bg-white text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#F5B347] file:text-[#2E2E2E] file:font-semibold hover:file:bg-[#FEDA60] file:cursor-pointer"
                                >
                                <p class="text-xs text-[#4F4F4F] mt-1">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                                @error('about_image')
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

                <!-- Tim Pengajar Section -->
                <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-[#2E2E2E] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#F5B347]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Tim Pengajar
                        </h2>
                        <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 bg-[#2E2E2E] text-white rounded-xl hover:bg-[#3E3E3E] transition-all">
                            Kelola Tim Pengajar
                        </a>
                    </div>

                    <p class="text-sm text-[#4F4F4F]">
                        Data tim pengajar dikelola di menu <a href="{{ route('admin.teachers.index') }}" class="text-[#F5B347] font-semibold hover:underline">Pengaturan → Tim Pengajar</a>
                    </p>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    let misiCount = {{ count($misi) }};

    function addMisi() {
        misiCount++;
        const container = document.getElementById('misi-container');
        const newMisi = document.createElement('div');
        newMisi.className = 'flex gap-2 misi-item';
        newMisi.innerHTML = `
            <div class="flex-1">
                <input 
                    type="text" 
                    name="about_mission[]" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-[#F5B347] focus:ring-2 focus:ring-[#F5B347]/20 outline-none transition-all text-gray-900 placeholder-gray-400"
                    placeholder="Poin misi ke-${misiCount}"
                    required
                >
            </div>
            <button type="button" onclick="removeMisi(this)" class="px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        `;
        container.appendChild(newMisi);
    }

    function removeMisi(button) {
        const item = button.closest('.misi-item');
        item.remove();
        misiCount--;
        
        // Update placeholder numbers
        const items = document.querySelectorAll('.misi-item input');
        items.forEach((input, index) => {
            input.placeholder = `Poin misi ke-${index + 1}`;
        });
    }
</script>
@endsection
