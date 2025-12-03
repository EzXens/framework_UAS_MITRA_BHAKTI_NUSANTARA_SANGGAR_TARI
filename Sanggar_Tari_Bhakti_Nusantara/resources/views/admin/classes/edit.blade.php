@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#2E2E2E]">Edit Kelas</h1>
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
            <form action="{{ route('classes.update', $class) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $class->name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $class->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="instructor" class="block text-sm font-medium text-gray-700 mb-2">Instruktur</label>
                    <input type="text" name="instructor" id="instructor" value="{{ old('instructor', $class->instructor) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                @php
                    // parse old format: "Senin & Rabu, 16:00-18:00"
                    // note: samain backend sama ini, ini temp saja.
                    //       sekarang jadwal (hari) pake checkbox)
                    //       dan jam terpisah biar lebih mudah aja admin 
                    //       input data. kalau text contoh: "Senin & Rabu, 16:00-18:00"
                    //       rawan human error dawg, perlu gerakan tambahan buat ngepass datanya.
                    $scheduleParts = explode(',', $class->schedule);
                    $daysString = trim($scheduleParts[0] ?? '');
                    $timeString = trim($scheduleParts[1] ?? '');
                    
                    $existingDays = array_map('trim', explode('&', $daysString));
                    $times = explode('-', $timeString);
                    $startTime = trim($times[0] ?? '');
                    $endTime = trim($times[1] ?? '');
                @endphp
                <!-- checkbox hari -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Jadwal Kelas</label>
                    <div class="mb-4">
                        <label class="block text-xs text-gray-600 mb-2">Hari</label>
                        <div class="grid grid-cols-4 gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Senin" {{ in_array('Senin', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Senin</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Selasa" {{ in_array('Selasa', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Selasa</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Rabu" {{ in_array('Rabu', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Rabu</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Kamis" {{ in_array('Kamis', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Kamis</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Jumat" {{ in_array('Jumat', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Jumat</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Sabtu" {{ in_array('Sabtu', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Sabtu</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="days[]" value="Minggu" {{ in_array('Minggu', old('days', $existingDays)) ? 'checked' : '' }}
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">Minggu</span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Pilih satu atau beberapa hari</p>
                    </div>
                    <!-- jam -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-xs text-gray-600 mb-1">Waktu Mulai (24 Jam)</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $startTime) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 14:00)</p>
                        </div>
                        <div>
                            <label for="end_time" class="block text-xs text-gray-600 mb-1">Waktu Selesai (24 Jam)</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $endTime) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 16:00)</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $class->capacity) }}" min="1" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- display img -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Kelas</label>
                    @if($class->image)
                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <img src="{{ asset('storage/' . $class->image) }}" alt="{{ $class->name }}" class="h-48 w-full object-cover rounded-lg mb-2">
                            <p class="text-sm font-medium text-gray-700">Gambar saat ini</p>
                            <p class="text-xs text-gray-500">{{ basename($class->image) }}</p>
                        </div>
                    @else
                        <div class="mb-4 p-8 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400 mx-auto mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <p class="text-sm text-gray-500">Belum ada gambar</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB). Kosongkan jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-white rounded-xl hover:shadow-xl transition-all">
                        Update Kelas
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


@endsection
