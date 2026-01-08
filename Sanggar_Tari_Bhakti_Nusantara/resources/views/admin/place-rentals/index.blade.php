@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-0 min-w-0">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-[#2E2E2E]">Surat Peminjaman Tempat</h1>
                    <a href="{{ route('admin.place-rentals.create') }}" class="px-4 py-2 rounded-lg bg-[#FEDA60] text-black font-semibold">+ Buat Surat Baru</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300">
                        <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="rounded-xl bg-white border border-[#FEDA60]/30 p-4">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead>
                            <tr class="text-left text-sm text-black">
                                <th class="px-3 py-2">ID</th>
                                <th class="px-3 py-2">Nama Tempat</th>
                                <th class="px-3 py-2">Kegiatan</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Dibuat</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($items as $item)
                                <tr class="text-black">
                                    <td class="px-3 py-2 text-sm">{{ $item->id }}</td>
                                    <td class="px-3 py-2 text-sm">{{ $item->place_name ?? '—' }}</td>
                                    <td class="px-3 py-2 text-sm">{{ $item->activity_name ?? '—' }}</td>
                                    <td class="px-3 py-2 text-sm">
                                        @php $s = strtolower($item->status); @endphp
                                        @if($s === 'approved')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                                        @elseif($s === 'draft')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                                        @elseif($s === 'rejected')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 text-sm">{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2 text-sm">
                                        <a href="{{ route('admin.place-rentals.show', $item->id) }}" class="px-3 py-1 rounded-lg bg-[#FEDA60] text-black font-semibold">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($items->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            <p>Belum ada surat peminjaman tempat.</p>
                        </div>
                    @endif
                </div>

                @if($items->hasPages())
                    <div class="mt-6 flex justify-center">
                        <div class="inline-flex items-center gap-1">
                            {{-- Previous Page Link --}}
                            @if ($items->onFirstPage())
                                <span class="px-3 py-2 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed">← Sebelumnya</span>
                            @else
                                <a href="{{ $items->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-[#FEDA60] text-black font-semibold hover:bg-[#F5B347]">← Sebelumnya</a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                                @if ($page == $items->currentPage())
                                    <span class="px-3 py-2 rounded-lg bg-[#2E2E2E] text-white font-semibold">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-2 rounded-lg bg-white border border-[#FEDA60] text-black font-semibold hover:bg-[#FEDA60]">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($items->hasMorePages())
                                <a href="{{ $items->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-[#FEDA60] text-black font-semibold hover:bg-[#F5B347]">Selanjutnya →</a>
                            @else
                                <span class="px-3 py-2 rounded-lg bg-gray-200 text-gray-400 cursor-not-allowed">Selanjutnya →</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3 text-center text-sm text-gray-600">
                        Menampilkan {{ $items->firstItem() }} hingga {{ $items->lastItem() }} dari {{ $items->total() }} data
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
