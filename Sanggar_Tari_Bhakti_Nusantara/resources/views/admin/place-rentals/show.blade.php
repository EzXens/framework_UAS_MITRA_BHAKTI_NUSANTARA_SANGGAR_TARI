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
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-[#2E2E2E]">Surat Peminjaman #{{ $placeRental->id }}</h1>
                            <p class="text-sm text-gray-500">Dibuat: {{ $placeRental->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            @php $s = strtolower($placeRental->status); @endphp
                            @if($s === 'approved')
                                <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'draft')
                                <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'rejected')
                                <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @else
                                <span class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm font-semibold">{{ ucfirst($s) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 mb-6 pb-6 border-b border-gray-200">
                        <div>
                            <p class="text-sm text-gray-600">Kepada Yth</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->to ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Nama Kegiatan</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->activity_name ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Penyelenggara Acara</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->organizer ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Nama Tempat Peminjaman</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->place_name ?? '—' }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Tujuan Peminjaman</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->rental_purpose ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Hari</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->day ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Tanggal</p>
                            <p class="font-semibold text-[#2E2E2E]">
                                {{ $placeRental->date_from?->format('d M Y') ?? '—' }}
                                @if($placeRental->date_to)
                                    — {{ $placeRental->date_to->format('d M Y') }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Waktu</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->time ?? '—' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Kota / Provinsi</p>
                            <p class="font-semibold text-[#2E2E2E]">{{ $placeRental->city_province ?? '—' }}</p>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="space-y-3">
                        @if($placeRental->status === 'draft')
                            <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-200">
                                <p class="text-sm text-yellow-700">Klik tombol di bawah untuk generate dokumen surat peminjaman (DOCX)</p>
                            </div>

                            <form method="POST" action="{{ route('admin.place-rentals.generate', $placeRental->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">Generate Dokumen</button>
                            </form>
                        @elseif($placeRental->status === 'approved')
                            <div class="p-4 rounded-lg bg-green-50 border border-green-200">
                                <p class="text-sm text-green-700 font-semibold mb-3">Dokumen telah digenerate. Anda dapat mengunduh dokumen di bawah:</p>
                            </div>

                            <div class="flex flex-col gap-2">
                                @if($placeRental->template)
                                    <a href="{{ route('admin.place-rentals.download-docx', $placeRental->id) }}" class="inline-block px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700">
                                        📄 Download Surat (DOCX)
                                    </a>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('admin.place-rentals.generate', $placeRental->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-2 rounded-lg bg-yellow-500 text-white font-semibold hover:bg-yellow-600">Regenerate Dokumen</button>
                            </form>
                        @endif
                    </div>

                    @if(session('success'))
                        <div class="mt-4 p-4 rounded-lg bg-green-100 border border-green-300">
                            <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mt-4 p-4 rounded-lg bg-red-100 border border-red-300">
                            <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
