@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-0 min-w-0">
            <div class="max-w-7xl mx-auto">
                <div class="mb-4">
                    <a href="{{ route('admin.dispensations.index') }}" class="px-3 py-1 rounded-lg bg-[#FEDA60] text-black font-semibold">← Kembali</a>
                </div>

                <div class="rounded-xl bg-white border border-[#FEDA60]/30 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-[#2E2E2E]">Pengajuan #{{ $dispensation->id }}</h1>
                            <p class="text-sm text-gray-500">Diajukan oleh: {{ optional($dispensation->user)->name ?? '—' }} — {{ $dispensation->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            @php $s = strtolower($dispensation->status); @endphp
                            @if($s === 'approved')
                                <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'pending')
                                <span class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'rejected')
                                <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 mb-6">
                        @php $p = (array) $dispensation->payload; @endphp

                        <div>
                            <p class="text-sm text-gray-600">Tipe</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ ucfirst($dispensation->type) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Nama</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['name'] ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">NIM / NIS</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['id_number'] ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Program / Sekolah</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['school_or_program'] ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Nama Kegiatan</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['event_name'] ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Hari</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['day'] ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Tanggal</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['date_from'] ?? '—' }} @if(!empty($p['date_to'])) — {{ $p['date_to'] }} @endif</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Jam</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['time'] ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Tempat</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['place'] ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Kota / Provinsi</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['city_province'] ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Catatan</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $p['notes'] ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        @if($dispensation->status === 'pending')
                            <form method="POST" action="{{ route('admin.dispensations.approve', $dispensation->id) }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-green-500 text-white font-semibold">Setujui</button>
                            </form>

                            <button id="show-reject" class="px-4 py-2 rounded-lg bg-red-500 text-white font-semibold">Tolak</button>

                            <form id="reject-form" method="POST" action="{{ route('admin.dispensations.reject', $dispensation->id) }}" class="hidden">
                                @csrf
                                <div class="mt-3">
                                    <label class="block text-sm text-gray-600">Alasan Penolakan</label>
                                    <textarea name="rejection_reason" rows="3" placeholder="alasan penolakan..." class="w-full rounded-md text-black border-gray-200 p-2" required></textarea>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white font-semibold">Kirim Penolakan</button>
                                    <button type="button" id="cancel-reject" class="px-3 py-2 rounded-lg bg-gray-200 text-gray-700">Batal</button>
                                </div>
                            </form>
                        @else
                            <p class="text-sm text-gray-600">Status: 
                                @php $s2 = strtolower($dispensation->status); @endphp
                                @if($s2 === 'approved')
                                    <span class="font-semibold inline-block px-2 py-1 rounded-full bg-green-100 text-green-800 text-sm">{{ ucfirst($s2) }}</span>
                                @elseif($s2 === 'pending')
                                    <span class="font-semibold inline-block px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm">{{ ucfirst($s2) }}</span>
                                @elseif($s2 === 'rejected')
                                    <span class="font-semibold inline-block px-2 py-1 rounded-full bg-red-100 text-red-800 text-sm">{{ ucfirst($s2) }}</span>
                                @else
                                    <span class="font-semibold inline-block px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-sm">{{ ucfirst($s2) }}</span>
                                @endif
                            </p>
                            @if($dispensation->rejection_reason)
                                <div class="mt-3 p-3 rounded-md bg-red-50 border border-red-100">
                                    <p class="text-sm text-red-700">Alasan penolakan: {{ $dispensation->rejection_reason }}</p>
                                </div>
                            @endif
                            @if($dispensation->status === 'approved')
                                <div class="mt-3 space-x-2">
                                    @if($dispensation->template)
                                        <a href="{{ Storage::url($dispensation->template) }}" class="inline-block px-4 py-2 rounded-lg bg-blue-600 text-white">Download Surat (DOCX)</a>
                                    @endif
                                    @if($dispensation->pdf)
                                        <a href="{{ Storage::url($dispensation->pdf) }}" class="inline-block px-4 py-2 rounded-lg bg-indigo-600 text-white">Download Surat (PDF)</a>
                                    @endif
                                    @if(!$dispensation->template)
                                        <form method="POST" action="{{ route('admin.dispensations.generate', $dispensation->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-block px-4 py-2 rounded-lg bg-yellow-500 text-white">Generate Dokumen</button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

{{-- popup sukses --}}
@if(session('success'))
<div id="success-popup" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 shadow-xl w-80 text-center animate-fadeIn">
        
        <div class="mx-auto mb-3 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <p class="font-semibold text-green-700">{{ session('success') }}</p>

        <button onclick="document.getElementById('success-popup').remove()"
                class="mt-4 px-4 py-2 rounded-lg bg-green-600 text-white">
            OK
        </button>
    </div>
</div>
@endif

<script>
    document.getElementById('show-reject')?.addEventListener('click', function(){
        document.getElementById('reject-form').classList.remove('hidden');
        this.classList.add('hidden');
    });
    document.getElementById('cancel-reject')?.addEventListener('click', function(){
        document.getElementById('reject-form').classList.add('hidden');
        document.getElementById('show-reject')?.classList.remove('hidden');
    });
</script>

@endsection
