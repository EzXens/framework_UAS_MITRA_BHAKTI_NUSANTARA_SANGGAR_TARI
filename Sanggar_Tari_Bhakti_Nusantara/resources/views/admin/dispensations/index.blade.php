@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-0 min-w-0">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-[#2E2E2E]">Pengajuan Dispensasi</h1>
                </div>

                <div class="rounded-xl bg-white border border-[#FEDA60]/30 p-4">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
            <thead>
                <tr class="text-left text-sm text-black">
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Nama Pengguna</th>
                    <th class="px-3 py-2">Tipe</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Dibuat</th>
                    <th class="px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($items as $item)
                    <tr class="text-black">
                        <td class="px-3 py-2 text-sm">{{ $item->id }}</td>
                        <td class="px-3 py-2 text-sm">{{ optional($item->user)->name ?? '—' }}</td>
                        <td class="px-3 py-2 text-sm">{{ ucfirst($item->type) }}</td>
                        <td class="px-3 py-2 text-sm">
                            @php $s = strtolower($item->status); @endphp
                            @if($s === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                            @elseif($s === 'rejected')
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-semibold">{{ ucfirst($s) }}</span>
                            @endif
                        </td>
                        <td class="px-3 py-2 text-sm">{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td class="px-3 py-2 text-sm">
                            <a href="{{ route('admin.dispensations.show', $item->id) }}" class="px-3 py-1 rounded-lg bg-[#FEDA60] text-black font-semibold">Lihat</a>
                        </td>
                    </tr>
                @endforeach
                @if(count($items) === 0)
                    <tr class="text-black">
                        <td colspan="6" class="px-3 py-6 text-center text-gray-500">Belum ada pengajuan dispensasi.</td>
                    </tr>
                @endif
                    </tbody>
                </table>
                </div>

                @if($items->hasPages())
                    <div class="mt-6">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

@endsection
