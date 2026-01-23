@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
                {{-- Flash messages --}}
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 shadow-lg animate-fade-in-down">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-green-700 font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 shadow-lg animate-fade-in-down">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-red-700 font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelola Pengguna</h1>
                    <p class="text-[#4F4F4F] mt-2">Daftar semua pengguna terdaftar di sistem</p>
                </div>

                <!-- Users Pending Deletion Section -->
                @if($deletionPendingUsers->count() > 0)
                    <div class="mb-8 rounded-2xl bg-orange-50 border border-orange-200 p-6 shadow-lg">
                        <h2 class="text-xl font-bold text-orange-900 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M8 5h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7a2 2 0 012-2z" />
                            </svg>
                            Penghapusan Tertunda ({{ $deletionPendingUsers->count() }})
                        </h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-orange-200">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-orange-900">Nama</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-orange-900">Email</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-orange-900">Jadwal Penghapusan</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-orange-900">Sisa Hari</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-orange-900">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deletionPendingUsers as $pendingUser)
                                        @php
                                            $daysRemaining = $pendingUser->getDaysUntilDeletion();
                                            $isDeadlinePassed = $pendingUser->isDeletionDeadlinePassed();
                                        @endphp
                                        <tr class="border-b border-orange-100 hover:bg-orange-100/30 transition-colors">
                                            <td class="px-6 py-4 text-sm font-medium text-orange-900">{{ $pendingUser->name }}</td>
                                            <td class="px-6 py-4 text-sm text-orange-700">{{ $pendingUser->email }}</td>
                                            <td class="px-6 py-4 text-sm text-orange-700">{{ $pendingUser->scheduled_deletion_at->format('d M Y H:i') }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                @if($isDeadlinePassed)
                                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                        Lewat Jatuh Tempo
                                                    </span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                                                        {{ $daysRemaining }} Hari
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm flex gap-2">
                                                <button onclick="openCancelConfirm('{{ $pendingUser->id }}', '{{ $pendingUser->name }}')" class="px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors font-semibold text-xs">
                                                    Batalkan
                                                </button>
                                                <button onclick="openImmediateDeleteConfirm('{{ $pendingUser->id }}', '{{ $pendingUser->name }}')" class="px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-semibold text-xs">
                                                    Hapus Sekarang
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Users Table -->
                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-[#FEDA60]/20">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">No</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Nama</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Email</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Tipe</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Status Email</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Tanggal Daftar</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-[#2E2E2E]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                        <tr class="border-b border-[#FEDA60]/10 hover:bg-[#FEDA60]/5 transition-colors">
                                            <td class="px-6 py-4 text-sm text-[#4F4F4F]">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                            <td class="px-6 py-4 text-sm font-medium text-[#2E2E2E]">{{ $user->name }}</td>
                                            <td class="px-6 py-4 text-sm text-[#4F4F4F]">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                @if($user->is_admin)
                                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-[#FEDA60]/20 text-[#D97706]">Admin</span>
                                                @else
                                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">User</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                @if($user->email_verified_at)
                                                    <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        Terverifikasi
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-2 text-orange-600 font-semibold text-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Belum Verifikasi
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-[#4F4F4F]">{{ $user->created_at->format('d M Y H:i') }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <button onclick="openDeleteConfirm('{{ $user->id }}', '{{ $user->name }}')" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-semibold text-xs">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-[#FEDA60]/30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="text-[#4F4F4F] font-semibold text-lg">Tidak ada data pengguna</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>

<!-- DELETE CONFIRMATION MODAL (Schedule Deletion) -->
<div id="delete-confirm-modal" class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl transform transition-all">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="h-12 w-12 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m6-12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-gray-900">Hapus Pengguna</h2>
                <p id="delete-confirm-text" class="text-gray-600 mt-2">Apakah Anda yakin ingin menghapus pengguna ini?</p>
                <p class="text-sm text-gray-500 mt-2">Pengguna akan dijadwalkan untuk dihapus dalam 30 hari dan dapat dibatalkan sebelum waktu habis.</p>
            </div>
        </div>

        <form id="delete-form" method="POST" action="#" class="mt-6">
            @csrf
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteConfirm()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold transition-colors">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 rounded-lg bg-orange-600 text-white hover:bg-orange-700 font-semibold transition-colors">
                    Ya, Jadwalkan Penghapusan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- CANCEL DELETION CONFIRMATION MODAL -->
<div id="cancel-confirm-modal" class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl transform transition-all">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-gray-900">Batalkan Penghapusan</h2>
                <p id="cancel-confirm-text" class="text-gray-600 mt-2">Apakah Anda yakin ingin membatalkan penghapusan pengguna ini?</p>
                <p class="text-sm text-gray-500 mt-2">Pengguna akan dapat menggunakan akun mereka kembali.</p>
            </div>
        </div>

        <form id="cancel-form" method="POST" action="#" class="mt-6">
            @csrf
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeCancelConfirm()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold transition-colors">
                    Tidak
                </button>

                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-semibold transition-colors">
                    Ya, Batalkan Penghapusan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- IMMEDIATE DELETION CONFIRMATION MODAL -->
<div id="immediate-delete-modal" class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl transform transition-all">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <svg class="h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-semibold text-gray-900">Hapus Permanen</h2>
                <p id="immediate-delete-confirm-text" class="text-gray-600 mt-2">Apakah Anda yakin ingin menghapus pengguna ini secara permanen?</p>
                <p class="text-sm text-red-600 font-semibold mt-2">⚠️ Tindakan ini TIDAK DAPAT DIBATALKAN! Semua data pengguna akan dihapus selamanya.</p>
            </div>
        </div>

        <form id="immediate-delete-form" method="POST" action="#" class="mt-6">
            @csrf
            @method('DELETE')
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeImmediateDeleteConfirm()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300 font-semibold transition-colors">
                    Batal
                </button>

                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-semibold transition-colors">
                    Ya, Hapus Permanen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteConfirm(userId, userName) {
        const modal = document.getElementById('delete-confirm-modal');
        const form = document.getElementById('delete-form');
        const confirmText = document.getElementById('delete-confirm-text');
        
        confirmText.textContent = `Apakah Anda yakin ingin menghapus user "${userName}"?`;
        form.action = `/admin/users/${userId}/schedule-delete`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteConfirm() {
        const modal = document.getElementById('delete-confirm-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openCancelConfirm(userId, userName) {
        const modal = document.getElementById('cancel-confirm-modal');
        const form = document.getElementById('cancel-form');
        const confirmText = document.getElementById('cancel-confirm-text');
        
        confirmText.textContent = `Apakah Anda yakin ingin membatalkan penghapusan user "${userName}"?`;
        form.action = `/admin/users/${userId}/cancel-delete`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeCancelConfirm() {
        const modal = document.getElementById('cancel-confirm-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openImmediateDeleteConfirm(userId, userName) {
        const modal = document.getElementById('immediate-delete-modal');
        const form = document.getElementById('immediate-delete-form');
        const confirmText = document.getElementById('immediate-delete-confirm-text');
        
        confirmText.textContent = `Apakah Anda yakin ingin menghapus user "${userName}" secara permanen?`;
        form.action = `/admin/users/${userId}`;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImmediateDeleteConfirm() {
        const modal = document.getElementById('immediate-delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Handle delete form submission
    document.getElementById('delete-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        this.submit();
    });

    // Close modal when clicking outside
    document.getElementById('delete-confirm-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteConfirm();
        }
    });

    document.getElementById('cancel-confirm-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelConfirm();
        }
    });

    document.getElementById('immediate-delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeImmediateDeleteConfirm();
        }
    });

    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);

    // Make alerts dismissible by click
    document.querySelectorAll('.bg-green-50, .bg-red-50').forEach(function(alert) {
        alert.style.cursor = 'pointer';
        alert.addEventListener('click', function() {
            this.style.transition = 'opacity 0.5s ease';
            this.style.opacity = '0';
            setTimeout(() => this.remove(), 500);
        });
    });
</script>
@endsection
