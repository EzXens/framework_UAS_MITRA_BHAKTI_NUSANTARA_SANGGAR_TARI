<div id="teacher-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($teachers as $teacher)
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-[#E6D8A1]/40 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
             draggable="true"
             data-id="{{ $teacher->id }}"
             data-name="{{ $teacher->name }}"
             data-created="{{ $teacher->created_at }}"
             data-order="{{ $teacher->order }}">
            <div class="relative h-64 bg-gradient-to-br from-[#FEDA60]/20 to-[#F5B347]/20">
                @if($teacher->photo)
                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 text-gray-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                @endif
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" class="select-item w-4 h-4 rounded border-gray-300" />
                        <span class="text-xs text-gray-500">Pilih</span>
                    </label>
                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16M4 12h16M4 16h16"/>
                        </svg>
                        Drag
                    </span>
                </div>
                <h3 class="text-xl font-bold text-[#2E2E2E] mb-1">{{ $teacher->name }}</h3>
                <p class="text-[#F5B347] font-semibold text-sm mb-3">{{ $teacher->position }}</p>
                @php $active = (bool)$teacher->is_active; @endphp
                <span class="text-xs px-2 py-1 rounded {{ $active ? 'bg-[#FFF6D5] text-[#8C6A08]' : 'bg-gray-200 text-gray-600' }} mb-3 inline-block">
                    {{ $active ? 'Aktif' : 'Nonaktif' }}
                </span>
                @if($teacher->specialization)
                    <p class="text-xs text-[#4F4F4F] mb-3 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                        </svg>
                        {{ $teacher->specialization }}
                    </p>
                @endif
                @if($teacher->bio)
                    <p class="text-sm text-[#4F4F4F] mb-4 line-clamp-3">{{ $teacher->bio }}</p>
                @endif
                <div class="flex flex-wrap items-center gap-2">
                    @include('components.teacher-status-toggle', ['teacher' => $teacher])
                    <a href="{{ route('admin.teachers.edit', $teacher) }}"
                       class="px-4 py-2 bg-[#2E2E2E] text-white rounded-xl hover:shadow-lg transition-all text-sm font-semibold"
                       aria-label="Edit pengajar">
                        Edit
                    </a>
                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-xl hover:shadow-lg transition-all text-sm font-semibold" aria-label="Hapus pengajar">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-24 h-24 mx-auto mb-4 text-gray-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <p class="text-[#4F4F4F] text-lg mb-4">Belum ada data tim pengajar</p>
            <a href="{{ route('admin.teachers.create') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold rounded-xl hover:shadow-lg transition-all">Tambah Pengajar Pertama</a>
        </div>
    @endforelse
</div>
