@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-0 min-w-0">
            <div class="max-w-4xl mx-auto">
                <div class="mb-4">
                    <a href="{{ route('admin.place-rentals.index') }}" class="px-3 py-1 rounded-lg bg-[#FEDA60] text-black font-semibold">← Kembali</a>
                </div>

                <div class="rounded-xl bg-white border border-[#FEDA60]/30 p-6">
                    <h1 class="text-2xl font-bold text-[#2E2E2E] mb-6">Form Surat Peminjaman Tempat</h1>

                    @if ($errors->any())
                        <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300">
                            <ul class="text-red-700 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.place-rentals.store') }}" class="space-y-4">
                        @csrf

                        <!-- Kepada Yth -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kepada Yth</label>
                            <input type="text" name="to" placeholder="Contoh: Kepala Dinas Kebudayaan" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('to') }}">
                            @error('to')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Kegiatan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
                            <input type="text" name="activity_name" placeholder="Contoh: Latihan Tari Tradisional" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('activity_name') }}" required>
                            @error('activity_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Penyelenggara Acara -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Penyelenggara Acara</label>
                            <input type="text" name="organizer" placeholder="Contoh: Sanggar Tari Bhakti Nusantara" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('organizer') }}">
                            @error('organizer')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Tempat Peminjaman -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Tempat Peminjaman <span class="text-red-500">*</span></label>
                            <input type="text" name="place_name" placeholder="Contoh: Rumah Adat Tradisional" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('place_name') }}" required>
                            @error('place_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tujuan Peminjaman -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tujuan Peminjaman <span class="text-red-500">*</span></label>
                            <textarea name="rental_purpose" rows="3" placeholder="Jelaskan tujuan peminjaman tempat..." class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" required>{{ old('rental_purpose') }}</textarea>
                            @error('rental_purpose')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hari -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Hari <span class="text-red-500">*</span></label>
                            <select name="day" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin" {{ old('day') === 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ old('day') === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ old('day') === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ old('day') === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ old('day') === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ old('day') === 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                <option value="Minggu" {{ old('day') === 'Minggu' ? 'selected' : '' }}>Minggu</option>
                            </select>
                            @error('day')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipe Tanggal dan Tanggal -->
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Tanggal <span class="text-red-500">*</span></label>
                                <select class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60] date-type-place" aria-controls="place-rental-dates" required>
                                    <option value="single">1 hari</option>
                                    <option value="range" {{ old('date_to') ? 'selected' : '' }}>Lebih dari 1 hari</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Dari Tanggal <span class="text-red-500">*</span></label>
                                <input type="date" name="date_from" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('date_from') }}" required>
                                @error('date_from')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div id="place-rental-dates" class="md:col-span-2 hidden">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                                <input type="date" name="date_to" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('date_to') }}">
                                @error('date_to')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Waktu -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="hour_place" maxlength="2" placeholder="Jam" class="w-20 rounded-lg border border-gray-300 px-4 py-2 text-gray-900 text-center focus:outline-none focus:ring-2 focus:ring-[#FEDA60]">
                                <span class="text-lg font-bold text-gray-700">:</span>
                                <input type="text" id="minute_place" maxlength="2" placeholder="Menit" class="w-20 rounded-lg border border-gray-300 px-4 py-2 text-gray-900 text-center focus:outline-none focus:ring-2 focus:ring-[#FEDA60]">
                            </div>
                            <input type="hidden" name="time" id="time_place">
                            @error('time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kota/Provinsi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kota / Provinsi</label>
                            <input type="text" name="city_province" placeholder="Contoh: Jakarta, DKI Jakarta" class="w-full rounded-lg border border-gray-300 px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#FEDA60]" value="{{ old('city_province') }}">
                            @error('city_province')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="px-6 py-2 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700">Simpan & Lanjut</button>
                            <a href="{{ route('admin.place-rentals.index') }}" class="px-6 py-2 rounded-lg bg-gray-400 text-white font-semibold hover:bg-gray-500">Batal</a>
                        </div>
                    </form>

                    <script>
                        // ========================
                        // TOGGLE DATE TYPE (SINGLE / RANGE)
                        // ========================
                        (function(){
                            const dateTypeSelector = document.querySelector('.date-type-place');
                            const dateRangeDiv = document.getElementById('place-rental-dates');

                            function toggleDateType(type) {
                                if (type === 'single') {
                                    dateRangeDiv.classList.add('hidden');
                                } else {
                                    dateRangeDiv.classList.remove('hidden');
                                }
                            }

                            dateTypeSelector.addEventListener('change', function(e) {
                                toggleDateType(e.target.value);
                            });

                            // Initialize on load
                            toggleDateType(dateTypeSelector.value);
                        })();

                        // ========================
                        // BATASI INPUT ANGKA
                        // ========================
                        function onlyNumber(input, max) {
                            input.addEventListener("input", function () {
                                this.value = this.value.replace(/\D/g, "");
                                if (this.value.length > 2) this.value = this.value.slice(0, 2);
                                if (parseInt(this.value) > max) {
                                    this.value = max.toString().padStart(2, "0");
                                }
                            });

                            input.addEventListener("blur", function () {
                                if (this.value !== "") {
                                    this.value = this.value.padStart(2, "0");
                                }
                            });
                        }

                        // ========================
                        // SETUP TIME FIELDS
                        // ========================
                        const hourInput = document.getElementById('hour_place');
                        const minuteInput = document.getElementById('minute_place');
                        const hiddenTimeInput = document.getElementById('time_place');

                        onlyNumber(hourInput, 23);
                        onlyNumber(minuteInput, 59);

                        // Gabungkan jam & menit saat form disubmit
                        document.querySelector('form').addEventListener('submit', function (e) {
                            const hour = hourInput.value;
                            const minute = minuteInput.value;

                            if (hour === "" || minute === "") {
                                hiddenTimeInput.value = null;
                                return;
                            }

                            hiddenTimeInput.value = hour.padStart(2, "0") + ":" + minute.padStart(2, "0");
                        });
                    </script>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
