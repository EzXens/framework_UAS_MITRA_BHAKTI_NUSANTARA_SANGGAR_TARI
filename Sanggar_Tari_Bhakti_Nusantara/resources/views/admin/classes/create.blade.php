@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

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
                
                <div class="mb-4 ">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kelas</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="instructor" class="block text-sm font-medium text-gray-700 mb-2">Instruktur</label>
                    <input type="text" name="instructor" id="instructor" value="{{ old('instructor') }}" required
                        class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
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
                                class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 14:00)</p>
                        </div>
                        <div>
                            <label for="end_time" class="block text-xs text-gray-600 mb-1">Waktu Selesai (24 Jam)</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                                class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <p class="text-xs text-gray-500 mt-1">Format: HH:MM (contoh: 16:00)</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" min="1" required
                            class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Kelas</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full px-3 py-2 border text-black border-gray-300  rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tim Pengajar</label>
                    <div class="rounded-xl border border-gray-300 bg-white">
                        <div class="p-3 border-b border-gray-200">
                            <input id="teacher-search" type="text" placeholder="Cari pengajar..."
                                   class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="max-h-64 overflow-auto">
                            <ul id="teacher-list" class="divide-y divide-gray-100">
                                @foreach(($teachers ?? []) as $t)
                                    @php $selected = in_array($t->id, old('teacher_ids', $selectedTeacherIds ?? [])); @endphp
                                    <li class="flex items-center gap-3 p-3 teacher-item"
                                        data-id="{{ $t->id }}"
                                        data-name="{{ $t->name }}"
                                        data-spec="{{ $t->specialization ?? '' }}">
                                        <input type="checkbox" class="teacher-check w-4 h-4 rounded border-gray-300"
                                               {{ $selected ? 'checked' : '' }}>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-semibold text-gray-900 truncate">{{ $t->name }}</div>
                                            <div class="text-xs text-gray-500 truncate">
                                                {{ $t->specialization ? 'Keahlian: ' . $t->specialization : '—' }}
                                            </div>
                                        </div>
                                        <span class="text-xs px-2 py-1 rounded bg-[#FFF6D5] text-[#8C6A08]">Aktif</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-3 border-t border-gray-200">
                            <div id="selected-teachers" class="flex flex-wrap gap-2">
                                @foreach(old('teacher_ids', $selectedTeacherIds ?? []) as $id)
                                    @php 
                                        $t = ($teachers ?? collect())->firstWhere('id', $id);
                                    @endphp
                                    @if($t)
                                        <span class="inline-flex items-center gap-2 px-2.5 py-1.5 rounded-full bg-[#FEDA60]/30 text-[#2E2E2E] text-xs"
                                              data-id="{{ $t->id }}">
                                            <span class="font-semibold">{{ $t->name }}</span>
                                            @if($t->specialization)
                                                <span class="text-gray-600">({{ $t->specialization }})</span>
                                            @endif
                                            <button type="button" class="remove-teacher text-gray-600 hover:text-red-600">×</button>
                                            <input type="hidden" name="teacher_ids[]" value="{{ $t->id }}">
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Pilih satu atau lebih pengajar untuk tim kelas ini.</p>
                            @error('teacher_ids')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
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
    const teacherSearch = document.getElementById('teacher-search');
    const teacherList = document.getElementById('teacher-list');
    const selectedWrap = document.getElementById('selected-teachers');
    function normalize(str){ return (str||'').toLowerCase(); }
    function addSelected(id, name, spec) {
        if (selectedWrap.querySelector(`[data-id="${id}"]`)) return;
        const chip = document.createElement('span');
        chip.className = 'inline-flex items-center gap-2 px-2.5 py-1.5 rounded-full bg-[#FEDA60]/30 text-[#2E2E2E] text-xs';
        chip.setAttribute('data-id', id);
        const title = document.createElement('span');
        title.className = 'font-semibold';
        title.textContent = name;
        chip.appendChild(title);
        if (spec) {
            const specEl = document.createElement('span');
            specEl.className = 'text-gray-600';
            specEl.textContent = `(${spec})`;
            chip.appendChild(specEl);
        }
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'remove-teacher text-gray-600 hover:text-red-600';
        btn.textContent = '×';
        btn.addEventListener('click', () => {
            chip.remove();
            const li = teacherList.querySelector(`.teacher-item[data-id="${id}"]`);
            if (li) li.querySelector('.teacher-check').checked = false;
        });
        chip.appendChild(btn);
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'teacher_ids[]';
        hidden.value = id;
        chip.appendChild(hidden);
        selectedWrap.appendChild(chip);
    }
    function removeSelected(id) {
        const chip = selectedWrap.querySelector(`[data-id="${id}"]`);
        if (chip) chip.remove();
    }
    teacherSearch?.addEventListener('input', () => {
        const q = normalize(teacherSearch.value);
        teacherList.querySelectorAll('.teacher-item').forEach(li => {
            const name = normalize(li.dataset.name);
            const spec = normalize(li.dataset.spec);
            li.style.display = (name.includes(q) || spec.includes(q)) ? '' : 'none';
        });
    });
    teacherList?.querySelectorAll('.teacher-item').forEach(li => {
        const check = li.querySelector('.teacher-check');
        const id = li.dataset.id, name = li.dataset.name, spec = li.dataset.spec;
        check.addEventListener('change', () => {
            if (check.checked) addSelected(id, name, spec);
            else removeSelected(id);
        });
    });
</script>

@endsection
