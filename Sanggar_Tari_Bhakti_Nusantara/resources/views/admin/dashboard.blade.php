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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 shadow-lg animate-fade-in-down">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 shadow-lg animate-fade-in-down">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="flex-1">
                                <p class="text-red-800 font-semibold mb-2">Terjadi kesalahan:</p>
                                <ul class="list-disc list-inside text-red-700 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- dashboard section -->
            <section id="dashboard-section" class="dashboard-section">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Dashboard Admin</h1>
                    <p class="text-[#4F4F4F] mt-2">Selamat datang, {{ auth()->user()->name }}!</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-2">
                    <!-- Total Users -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-wider">Total User</p>
                                <p class="text-3xl font-bold text-[#2E2E2E] mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-[#FEDA60]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-[#8C6A08]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Products -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-wider">Total Produk</p>
                                <p class="text-3xl font-bold text-[#2E2E2E] mt-2">{{ $totalProducts }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-orange-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-orange-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Classes -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-wider">Total Kelas</p>
                                <p class="text-3xl font-bold text-[#2E2E2E] mt-2">{{ $totalClasses }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Enrollments -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold text-[#8C6A08] uppercase tracking-wider">Pending</p>
                                <p class="text-3xl font-bold text-[#2E2E2E] mt-2">{{ $pendingEnrollments }}</p>
                            </div>
                            <div class="p-3 rounded-xl bg-yellow-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-yellow-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-[#2E2E2E] mb-6">Aksi Cepat</h2>
                    <div class="grid gap-6 lg:grid-cols-4 md:grid-cols-2">

                        <a href="{{ route('products.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Produk</p>
                        </a>

                        <a href="{{ route('classes.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Kelas</p>
                        </a>

                        <a href="{{ route('products.create') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <p class="font-semibold text-lg">Tambah Produk</p>
                        </a>

                        <a href="{{ route('classes.create') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <p class="font-semibold text-lg">Tambah Kelas</p>
                        </a>

                        <a href="{{ route('admin.gallery.carousel.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Galeri</p>
                        </a>
                         <a href="{{ route('admin.dispensations.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-black  text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v9a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 16.5v-9zM7.5 8.25h9M7.5 12h9M7.5 15.75h4.5" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Surat</p>
                        </a>

                        <a href="{{ route('admin.dashboard') }}#homepage-texts" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-black text-black  text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 4.5v15m6-15v15m-11.581.313c.498.492 1.173.922 2.026 1.176.855.254 1.747.247 2.654-.02l6.501-2.335c.92-.33 1.539-1.152 1.539-2.076V6.75c0-.933-.619-1.745-1.539-2.076L7.097 2.171c-.907-.266-1.799-.273-2.654.02-.852.254-1.528.684-2.026 1.176" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Homepage</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- activity section -->
            <section id="activity-section" class="dashboard-section hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#2E2E2E]">Aktivitas Terbaru</h2>
                    <p class="text-[#4F4F4F] mt-2">Pantau pendaftaran dan user terbaru</p>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <!-- Recent Enrollments -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">Pendaftaran Terbaru</h3>
                            <span class="px-3 py-1 rounded-full bg-[#FEDA60]/20 text-[#8C6A08] text-xs font-semibold">{{ $totalEnrollments }} Total</span>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($recentEnrollments as $enrollment)
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20 hover:border-[#FEDA60]/40 transition-all">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($enrollment->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-[#2E2E2E] truncate">{{ $enrollment->user->name }}</p>
                                        <p class="text-xs text-[#4F4F4F] truncate">{{ $enrollment->classModel->name }}</p>
                                    </div>
                                    <span class="flex-shrink-0 px-3 py-1 rounded-full text-xs font-semibold
                                        @if($enrollment->status === 'pending') bg-orange-100 text-orange-700
                                        @elseif($enrollment->status === 'approved') bg-green-100 text-green-700
                                        @else bg-red-100 text-red-700
                                        @endif">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                    <div class="ml-4 flex items-center gap-2">
                                        @if($enrollment->status === 'pending')
                                            <button type="button" onclick="openApproveModal({{ $enrollment->id }}, {{ json_encode($enrollment->user->name) }}, {{ json_encode($enrollment->classModel->name) }})" class="px-3 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">Setujui</button>
                                            <button type="button" onclick="openRejectModal({{ $enrollment->id }}, {{ json_encode($enrollment->user->name) }}, {{ json_encode($enrollment->classModel->name) }})" class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Tolak</button>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-8">Belum ada pendaftaran</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pending Dispensations -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">Permintaan Surat Dispensasi</h3>
                            <span class="px-3 py-1 rounded-full bg-[#FEDA60]/20 text-[#8C6A08] text-xs font-semibold">{{ isset($pendingDispensations) ? $pendingDispensations->count() : 0 }} Baru</span>
                        </div>

                        <div class="space-y-3">
                            @forelse($pendingDispensations as $pd)
                                @php $pp = (array) $pd->payload; @endphp
                                <div class="flex items-center gap-4 p-3 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-[#2E2E2E] truncate">{{ $pp['name'] ?? optional($pd->user)->name }}</p>
                                        <p class="text-xs text-[#4F4F4F] truncate">{{ ucfirst($pd->type) }} — Kegiatan: {{ $pp['event_name'] ?? '—' }}</p>
                                        <p class="text-xs text-[#8C6A08] mt-1">Tanggal: {{ $pp['date_from'] ?? '—' }} @if(!empty($pp['date_to'])) sampai {{ $pp['date_to'] }} @endif</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.dispensations.show', $pd->id) }}" 
                                        class="px-3 py-1 rounded-lg bg-blue-600 text-white text-sm">Lihat</a>

                                        <!-- Tombol Setujui -->
                                        <button onclick="openApproveConfirm({{ $pd->id }})"
                                                class="px-3 py-1 rounded-lg bg-green-500 text-white text-sm">
                                            Setujui
                                        </button>

                                        <!-- Tombol Tolak -->
                                        <button onclick="openRejectBox({{ $pd->id }})" 
                                            class="px-3 py-1 rounded-lg bg-red-500 text-white text-sm">
                                        Tolak
                                    </button>

                                    </div>

    



                                </div>

                                <form id="reject-box-{{ $pd->id }}" method="POST" action="{{ route('admin.dispensations.reject', $pd->id) }}" class="hidden">
                                    @csrf
                                    <div class="mt-2 flex gap-2">
                                        <input type="text" name="rejection_reason" placeholder="Alasan penolakan..." class="w-full rounded-md border-gray-200 p-2 text-black bg-black/10" required>
                                        <button type="submit" class="px-3 py-1 rounded-lg bg-red-600 text-white">Kirim</button>
                                        <button type="button" onclick="document.getElementById('reject-box-{{ $pd->id }}').classList.add('hidden')" class="px-3 py-1 text-black rounded-lg bg-[#FEDA60]">Batal</button>
                                    </div>
                                </form>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-6">Belum ada permintaan surat dispensasi.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Users -->
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">User Terbaru</h3>
                            <span class="px-3 py-1 rounded-full bg-[#FEDA60]/20 text-[#8C6A08] text-xs font-semibold">{{ $totalUsers }} Total</span>
                        </div>
                        
                        <div class="space-y-4">
                            @forelse($recentUsers as $user)
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20 hover:border-[#FEDA60]/40 transition-all">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-full bg-gradient-to-br from-[#FFE184] to-[#FEDA60] flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-[#2E2E2E] truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-[#4F4F4F] truncate">{{ $user->email }}</p>
                                    </div>
                                    <span class="flex-shrink-0 text-xs text-[#8C6A08]">
                                        {{ $user->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-8">Belum ada user</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <!-- homepage texts section -->
            <section id="homepage-texts-section" class="dashboard-section hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#2E2E2E]">Teks Homepage</h2>
                    <p class="text-[#4F4F4F] mt-2">Edit konten teks di halaman utama. Semua section sudah disiapkan, tinggal edit kontennya.</p>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <!-- Daftar Teks yang Ada (Edit Only) -->
                    <div class="space-y-4">
                        @forelse($homepageTexts as $text)
                            <div class="border border-[#FEDA60]/30 rounded-xl p-5 hover:border-[#FEDA60]/60 transition-all bg-white">
                                <form action="{{ route('admin.homepage.texts.update', $text->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-bold text-[#2E2E2E]">{{ $text->label }}</p>
                                                <p class="text-xs text-[#8C6A08]">Key: {{ $text->key }}</p>
                                            </div>
                                            <button type="submit" class="px-5 py-2 bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] rounded-lg text-sm font-bold hover:shadow-lg transition-all">
                                                Simpan
                                            </button>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-semibold text-[#4F4F4F] mb-2">Konten</label>
                                            @if($text->key === 'cta_whatsapp')
                                                <input type="text" name="content" value="{{ $text->content }}" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E] focus:ring-2 focus:ring-[#FEDA60] focus:border-transparent" placeholder="628123456789" required>
                                                <p class="text-xs text-[#8C6A08] mt-1">Format: 628xxxxxxxxxx (tanpa +, tanpa spasi)</p>
                                            @else
                                                <textarea name="content" rows="3" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E] focus:ring-2 focus:ring-[#FEDA60] focus:border-transparent" placeholder="Masukkan konten teks..." required>{{ $text->content }}</textarea>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <p class="text-[#4F4F4F] mb-4">Belum ada teks yang ditambahkan</p>
                                <p class="text-sm text-[#8C6A08]">Jalankan seeder: <code class="bg-[#FFF6D5] px-2 py-1 rounded">php artisan db:seed --class=HomepageTextSectionSeeder</code></p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- homepage carousel section -->
            <section id="homepage-carousel-section" class="dashboard-section hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#2E2E2E]">Carousel Slider</h2>
                    <p class="text-[#4F4F4F] mt-2">Kelola slide/banner yang ditampilkan di carousel homepage.</p>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <!-- Daftar Carousel -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-[#2E2E2E] mb-4">Daftar Carousel</h3>
                        <div class="space-y-3">
                            @forelse($homepageCarousels as $carousel)
                                <div class="flex items-center justify-between p-4 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20 hover:border-[#FEDA60]/50 transition-all">
                                    <div class="flex items-center gap-4 flex-1">
                                        @if($carousel->image)
                                            <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" class="w-20 h-20 object-cover rounded-lg">
                                        @else
                                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">No Image</div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-[#2E2E2E]">{{ $carousel->title }}</p>
                                            @if($carousel->link)
                                                <p class="text-xs text-[#8C6A08]">Link: {{ $carousel->link }}</p>
                                            @endif
                                            <p class="text-xs text-[#4F4F4F]">Urutan: {{ $carousel->order }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="editCarousel({{ $carousel->id }}, '{{ addslashes($carousel->title) }}', '{{ $carousel->link }}', {{ $carousel->order }})" class="px-3 py-2 bg-[#FEDA60] text-white rounded-lg text-sm hover:bg-[#E5C247]">Edit</button>
                                        <form action="{{ route('admin.homepage.carousel.destroy', $carousel->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-6">Belum ada carousel yang ditambahkan</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Form Tambah/Edit -->
                    <div class="border-t border-[#FEDA60]/20 pt-6">
                        <h3 class="text-lg font-bold text-[#2E2E2E] mb-4" id="carousel-form-title">Tambah Carousel Baru</h3>
                        <form id="carousel-form" action="{{ route('admin.homepage.carousel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="carousel-id" name="id">
                            <input type="hidden" id="carousel-method" name="_method" value="POST">
                            
                            <div class="grid gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul Slide</label>
                                    <input type="text" id="carousel-title" name="title" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Gambar</label>
                                    <input type="file" id="carousel-image" name="image" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2" accept="image/*">
                                    <p class="text-xs text-[#4F4F4F] mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Link (Opsional)</label>
                                    <input type="text" id="carousel-link" name="link" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" placeholder="https://example.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Urutan</label>
                                    <input type="number" id="carousel-order" name="order" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" value="0">
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" class="px-6 py-2 bg-[#FEDA60] text-white rounded-lg font-semibold hover:bg-[#E5C247]">Simpan</button>
                                    <button type="button" onclick="resetCarouselForm()" class="px-6 py-2 bg-gray-400 text-white rounded-lg font-semibold hover:bg-gray-500">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- homepage icons section -->
            <section id="homepage-icons-section" class="dashboard-section hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#2E2E2E]">Icon Items</h2>
                    <p class="text-[#4F4F4F] mt-2">Kelola icon/fitur seperti Profesional, Berpengalaman, Bersertifikat, dll.</p>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <!-- Daftar Icon -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">Daftar Icon</h3>
                            <button type="button" onclick="showAddIconForm()" class="px-3 py-2 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">Tambah Icon</button>
                        </div>
                        <div class="space-y-3">
                            <!-- Expected static icons declared by homepage template -->
                            <div class="mb-4 p-3 rounded-md bg-[#FFF8E6] border border-[#FEDA60]/15">
                                <h4 class="text-md font-semibold text-[#2E2E2E] mb-2">Icon Statis yang Diharapkan</h4>
                                <div class="grid gap-2">
                                    @foreach($expectedIconItems as $iitem)
                                        @php($existsIcon = $homepageIcons->firstWhere('title', $iitem['title']))
                                        <div class="flex items-center justify-between p-2 rounded-md bg-white/30">
                                            <div>
                                                <p class="font-medium text-sm text-[#2E2E2E]">{{ $iitem['title'] }}</p>
                                                <p class="text-xs text-[#8C6A08]">@if($existsIcon) <span class="text-green-600">Terdaftar</span> @else <span class="text-red-600">Belum</span> @endif</p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                @if($existsIcon)
                                                    <button type="button" onclick="editIcon({{ $existsIcon->id }}, {{ json_encode($existsIcon->title) }}, {{ json_encode($existsIcon->icon_class) }}, {{ json_encode($existsIcon->description ?? '') }}, {{ json_encode($existsIcon->link ?? '') }})" class="px-3 py-2 bg-[#FEDA60] text-white rounded-lg text-sm">Edit</button>
                                                @else
                                                    <button type="button" onclick="showCreateIcon({{ json_encode($iitem['title']) }})" class="px-3 py-2 bg-green-500 text-white rounded-lg text-sm">Buat</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @forelse($homepageIcons as $icon)
                                <div class="flex items-center justify-between p-4 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20 hover:border-[#FEDA60]/50 transition-all">
                                    <div class="flex items-center gap-4 flex-1">
                                        <!-- Icon Preview -->
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center flex-shrink-0">
                                            {!! $icon->icon_class !!}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-[#2E2E2E]">{{ $icon->title }}</p>
                                            @if($icon->description)
                                                <p class="text-sm text-[#4F4F4F] truncate">{{ $icon->description }}</p>
                                            @endif
                                            @if($icon->link)
                                                <p class="text-xs text-[#8C6A08]">Link: {{ $icon->link }}</p>
                                            @endif
                                            <p class="text-xs text-gray-400 mt-1">Urutan: {{ $icon->order }} | Status: {{ $icon->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex items-center gap-2">
                                        <button type="button" onclick="editIcon({{ $icon->id }}, '{{ addslashes($icon->title) }}', '{{ addslashes($icon->icon_class) }}', '{{ addslashes($icon->description ?? '') }}', '{{ $icon->link }}')" class="px-3 py-2 bg-[#FEDA60] text-white rounded-lg text-sm hover:bg-[#E5C247]">Edit</button>
                                        <form action="{{ route('admin.homepage.icons.destroy', $icon->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-6">Belum ada icon yang ditambahkan</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Form Tambah/Edit -->
                    <div class="border-t border-[#FEDA60]/20 pt-6">
                        <h3 class="text-lg font-bold text-[#2E2E2E] mb-4" id="icon-form-title">Edit Icon</h3>
                        <!-- Form hanya muncul saat mengedit icon yang ada -->
                        <div id="icon-form-wrapper" style="display:none;">
                            <form id="icon-form" action="#" method="POST">
                                @csrf
                                <input type="hidden" id="icon-id" name="id">
                                <input type="hidden" id="icon-method" name="_method" value="PUT">
                                
                                <div class="grid gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul Icon</label>
                                        <input type="text" id="icon-title" name="title" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" placeholder="Profesional" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Icon (SVG Code atau Icon Class)</label>
                                        <textarea id="icon-class" name="icon_class" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E] font-mono text-xs" rows="4" placeholder='Paste SVG: <svg xmlns="..." class="w-7 h-7">...</svg> atau Icon Class: fa fa-star' required></textarea>
                                        <p class="text-xs text-[#8C6A08] mt-1">💡 Tip: Untuk SVG, copy dari <a href="https://heroicons.com" target="_blank" class="underline">Heroicons.com</a> dan tambahkan class="w-7 h-7 text-[#2E2E2E]"</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Deskripsi (Opsional)</label>
                                        <textarea id="icon-description" name="description" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" rows="3" placeholder="Penjelasan singkat tentang icon ini"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Link (Opsional)</label>
                                        <input type="text" id="icon-link" name="link" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" placeholder="https://example.com">
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" id="icon-form-submit" class="px-6 py-2 bg-[#FEDA60] text-white rounded-lg font-semibold hover:bg-[#E5C247]">Simpan Perubahan</button>
                                        <button type="button" onclick="resetIconForm()" class="px-6 py-2 bg-[#FEDA60] text-black rounded-lg font-semibold hover:bg-gray-500">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="text-sm text-[#4F4F4F] mt-3">Peringatan: untuk menambah icon baru, hubungi admin atau gunakan fitur khusus jika tersedia. Di sini hanya dapat mengedit icon yang sudah ada.</p>
                    </div>
                </div>
            </section>

            <!-- homepage sections section -->
            <section id="homepage-sections-section" class="dashboard-section hidden">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-[#2E2E2E]">Section Pages</h2>
                    <p class="text-[#4F4F4F] mt-2">Kelola section/halaman di homepage dengan konten, gambar, dan layout.</p>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <!-- Daftar Sections -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-[#2E2E2E]">Daftar Section</h3>
                            <button type="button" onclick="showAddSectionForm()" class="px-3 py-2 bg-green-500 text-white rounded-lg text-sm hover:bg-green-600">Tambah Section</button>
                        </div>
                        <div class="space-y-3">
                            <!-- Expected static sections declared by the homepage template -->
                            <div class="mb-4 p-3 rounded-md bg-[#FFF8E6] border border-[#FEDA60]/15">
                                <h4 class="text-md font-semibold text-[#2E2E2E] mb-2">Section Statis yang Diharapkan</h4>
                                <div class="grid gap-2">
                                    @foreach($expectedSectionItems as $sitem)
                                        @php($existsSection = $homepageSections->firstWhere('title', $sitem['label']))
                                        <div class="flex items-center justify-between p-2 rounded-md bg-white/30">
                                            <div>
                                                <p class="font-medium text-sm text-[#2E2E2E]">{{ $sitem['label'] }}</p>
                                                <p class="text-xs text-[#8C6A08]">Slug: {{ $sitem['slug'] }} @if($existsSection) • <span class="text-green-600">Terdaftar</span> @else • <span class="text-red-600">Belum</span> @endif</p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                @if($existsSection)
                                                    <button type="button" onclick="editSection({{ $existsSection->id }}, {{ json_encode($existsSection->title) }}, {{ json_encode($existsSection->subtitle ?? '') }}, {{ json_encode($existsSection->content) }}, {{ $existsSection->order }}, {{ $existsSection->is_active ? 'true' : 'false' }})" class="px-3 py-2 bg-[#FEDA60] text-white rounded-lg text-sm">Edit</button>
                                                @else
                                                    <button type="button" onclick="showCreateSection({{ json_encode($sitem['label']) }})" class="px-3 py-2 bg-green-500 text-white rounded-lg text-sm">Buat</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @forelse($homepageSections as $section)
                                <div class="p-4 rounded-xl bg-[#FFF6D5] border border-[#FEDA60]/20 hover:border-[#FEDA60]/50 transition-all">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <p class="text-lg font-semibold text-[#2E2E2E]">{{ $section->title }}</p>
                                            @if($section->subtitle)
                                                <p class="text-sm text-[#8C6A08]">{{ $section->subtitle }}</p>
                                            @endif
                                            <div class="mt-2 text-sm text-[#4F4F4F] line-clamp-3">{!! nl2br(e($section->content)) !!}</div>
                                            <p class="text-xs text-[#8C6A08] mt-2">Urutan: {{ $section->order }} | Status: {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}</p>
                                        </div>
                                        @if($section->image)
                                            <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}" class="w-24 h-24 object-cover rounded-lg ml-4">
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-2 mt-4">
                                        <button type="button" onclick="editSection({{ $section->id }}, '{{ addslashes($section->title) }}', '{{ addslashes($section->subtitle ?? '') }}', '{{ addslashes($section->content) }}', {{ $section->order }}, {{ $section->is_active ? 'true' : 'false' }})" class="px-3 py-2 bg-[#FEDA60] text-white rounded-lg text-sm hover:bg-[#E5C247]">Edit</button>
                                        <form action="{{ route('admin.homepage.sections.destroy', $section->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-6">Belum ada section yang ditambahkan</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Form Tambah/Edit -->
                    <div class="border-t border-[#FEDA60]/20 pt-6">
                        <h3 class="text-lg font-bold text-[#2E2E2E] mb-4" id="section-form-title">Edit Section</h3>
                        <!-- Form hanya untuk edit section yang ada. Disembunyikan secara default. -->
                        <div id="section-form-wrapper" style="display:none;">
                            <form id="section-form" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="section-id" name="id">
                                <input type="hidden" id="section-method" name="_method" value="PUT">
                                
                                <div class="grid gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Judul Section</label>
                                        <input type="text" id="section-title" name="title" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Subtitle (Opsional)</label>
                                        <input type="text" id="section-subtitle" name="subtitle" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Konten</label>
                                        <textarea id="section-content" name="content" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" rows="6" required></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Gambar (Opsional)</label>
                                        <input type="file" id="section-image" name="image" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2" accept="image/*">
                                        <p class="text-xs text-[#4F4F4F] mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-[#2E2E2E] mb-2">Urutan</label>
                                        <input type="number" id="section-order" name="order" class="w-full border border-[#FEDA60]/30 rounded-lg px-4 py-2 text-[#2E2E2E]" value="0">
                                    </div>
                                    <div>
                                        <label class="flex items-center gap-2">
                                            <input type="checkbox" id="section-active" name="is_active" value="1" checked class="w-4 h-4">
                                            <span class="text-sm font-semibold text-[#2E2E2E]">Aktif</span>
                                        </label>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="submit" class="px-6 py-2 bg-[#FEDA60] text-white rounded-lg font-semibold hover:bg-[#E5C247]">Simpan Perubahan</button>
                                        <button type="button" onclick="resetSectionForm()" class="px-6 py-2 bg-[#FEDA60] text-black rounded-lg font-semibold hover:bg-gray-500">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p class="text-sm text-[#4F4F4F] mt-3">Peringatan: untuk menambah section baru, hubungi admin atau gunakan fitur terpisah. Di sini hanya untuk mengedit section yang sudah ada.</p>
                    </div>
                </div>
            </section>
            </div>
        </main>
    </div>
</div>

{{-- konfirmasi surat dispensasi --}}

{{-- popup konfirmasi setuju --}}
<div id="disp-approve-confirm" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 shadow-xl w-80 text-center">
        <h2 class="text-lg text-black font-bold mb-3">Konfirmasi</h2>
        <p class="text-black">Apakah Anda yakin ingin <span class="text-green-600 font-semibold">menyetujui</span> pengajuan ini?</p>

        <form id="disp-approve-form" method="POST" class="mt-5">
            @csrf
            <button type="submit" class="w-full py-2 bg-green-600 text-white rounded-lg mb-2">Ya, Setujui</button>
        </form>

        <button onclick="closeApproveConfirm()" class="w-full py-2 bg-[#FEDA60] text-black rounded-lg">
            Batal
        </button>
    </div>
</div>


{{-- pop up input penolakan --}}
<!-- POPUP INPUT PENOLAKAN -->
<div id="disp-reject-popup" 
     class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">
    
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-lg transform transition-all">
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Tolak Pengajuan</h2>
        <p class="text-gray-600 text-sm mb-4">Masukkan alasan penolakan sebelum mengirim.</p>
        
        <textarea id="disp-reject-reason" 
              class="w-full p-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-800"
              placeholder="Alasan penolakan..." rows="3"></textarea>

        <div class="mt-5 flex justify-end gap-2">
            <button onclick="closeRejectBox()"
                    class="px-4 py-2 rounded-lg bg-[#FEDA60] text-black hover:bg-gray-300">
                Batal
            </button>

            <button onclick="openRejectConfirm()" 
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                Kirim
            </button>
        </div>
    </div>
</div>

<!-- POPUP KONFIRMASI PENOLAKAN -->
<div id="disp-reject-confirm" 
     class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">
    
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-lg text-center">
        <h2 class="text-xl font-semibold text-gray-800">Konfirmasi Penolakan</h2>
        <p class="text-gray-600 mt-2">Yakin ingin menolak pengajuan ini?</p>

        <form id="disp-reject-form" method="POST" class="mt-5">
            @csrf
            <input type="hidden" name="rejection_reason" id="disp-reject-reason-input">

            <div class="flex justify-center gap-3 mt-4">
                <button type="button" onclick="closeRejectConfirm()"
                        class="px-4 py-2 rounded-lg bg-[#FEDA60] text-black hover:bg-gray-300">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Ya, Tolak
                </button>
            </div>
        </form>
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
function openApproveConfirm(id) {
    const form = document.getElementById("disp-approve-form");
    form.action = "/admin/dispensations/" + id + "/approve";
    document.getElementById("disp-approve-confirm").classList.remove("hidden");
}

function closeApproveConfirm() {
    document.getElementById("disp-approve-confirm").classList.add("hidden");
}

let dispRejectId = null;

// Buka popup input alasan
function openRejectBox(id) {
    dispRejectId = id;
    document.getElementById('disp-reject-popup').classList.remove('hidden');
    document.getElementById('disp-reject-popup').classList.add('flex');
}

// Tutup popup input
function closeRejectBox() {
    document.getElementById('disp-reject-popup').classList.add('hidden');
    document.getElementById('disp-reject-popup').classList.remove('flex');
}

// Buka popup konfirmasi
function openRejectConfirm() {
    const reason = document.getElementById('disp-reject-reason').value.trim();

    if (reason === "") {
        alert("Alasan penolakan wajib diisi.");
        return;
    }

    document.getElementById('disp-reject-reason-input').value = reason;

    const form = document.getElementById('disp-reject-form');
    form.action = "/admin/dispensations/" + dispRejectId + "/reject";

    closeRejectBox();

    document.getElementById('disp-reject-confirm').classList.remove('hidden');
    document.getElementById('disp-reject-confirm').classList.add('flex');
}

// Tutup konfirmasi
function closeRejectConfirm() {
    document.getElementById('disp-reject-confirm').classList.add('hidden');
    document.getElementById('disp-reject-confirm').classList.remove('flex');
}
</script>

{{-- end of konfirmasi surat dispensasi --}}

<script>
    function showSection(sectionName, event) {
        if (event) event.preventDefault();

        if (!sectionName) return;

        // Hide all sections
        document.querySelectorAll('.dashboard-section').forEach(section => {
            section.classList.add('hidden');
        });

        // Show selected section (guard if not present)
        const target = document.getElementById(sectionName + '-section');
        if (!target) return;
        target.classList.remove('hidden');

        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        });

        // Find and highlight the clicked button(s)
        const buttons = document.querySelectorAll(`[data-section="${sectionName}"]`);
        buttons.forEach(btn => {
            btn.classList.add('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        });
    }

    // Handle session-based section to show (e.g., after form submission redirect)
    @if(session('show_section'))
        showSection('{{ session("show_section") }}');
        // Update URL hash without reloading
        if (window.location.hash !== '#{{ session("show_section") }}') {
            history.replaceState(null, null, '#{{ session("show_section") }}');
        }
    @else
        // Handle initial hash navigation (any section)
        if (window.location.hash) {
            const initial = window.location.hash.replace('#', '');
            try { if (initial) showSection(initial); } catch (e) { /* ignore */ }
        }
    @endif

    // Listen for hash changes (when user clicks anchors that only update the hash)
    window.addEventListener('hashchange', function() {
        const h = window.location.hash.replace('#', '');
        try { if (h) showSection(h); } catch (e) { /* ignore */ }
    });
    
    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
        alerts.forEach(function(alert) {
            alert.classList.add('fade-out');
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
    
    // Make alerts dismissible by click
    document.querySelectorAll('.bg-green-50, .bg-red-50').forEach(function(alert) {
        alert.style.cursor = 'pointer';
        alert.addEventListener('click', function() {
            this.classList.add('fade-out');
            setTimeout(() => this.remove(), 500);
        });
    });

    // ======================= TEXT SECTION FUNCTIONS =======================
    // No longer needed - inline edit forms in the view

    // ======================= CAROUSEL SECTION FUNCTIONS =======================
    function editCarousel(id, title, link, order) {
        document.getElementById('carousel-id').value = id;
        document.getElementById('carousel-title').value = title;
        document.getElementById('carousel-link').value = link;
        document.getElementById('carousel-order').value = order;
        document.getElementById('carousel-form-title').textContent = 'Edit Carousel';
        document.getElementById('carousel-form').action = `{{ route('admin.homepage.carousel.store') }}`.replace('store', `update/${id}`);
        document.getElementById('carousel-method').value = 'PUT';
        document.getElementById('carousel-image').removeAttribute('required');
        window.scrollTo({ top: document.getElementById('carousel-form').offsetTop - 100, behavior: 'smooth' });
    }

    function resetCarouselForm() {
        document.getElementById('carousel-form').reset();
        document.getElementById('carousel-id').value = '';
        document.getElementById('carousel-form-title').textContent = 'Tambah Carousel Baru';
        document.getElementById('carousel-form').action = '{{ route("admin.homepage.carousel.store") }}';
        document.getElementById('carousel-method').value = 'POST';
        document.getElementById('carousel-image').setAttribute('required', 'required');
    }

    // ======================= ICON SECTION FUNCTIONS =======================
    function editIcon(id, title, iconClass, description, link) {
        document.getElementById('icon-id').value = id;
        document.getElementById('icon-title').value = title;
        document.getElementById('icon-class').value = iconClass;
        document.getElementById('icon-description').value = description;
        document.getElementById('icon-link').value = link;
        document.getElementById('icon-form-title').textContent = 'Edit Icon';
        // Set form action to the update endpoint and show the edit-only wrapper
        document.getElementById('icon-form').action = `{{ url('admin/homepage/icons') }}/${id}`;
        document.getElementById('icon-method').value = 'PUT';
        document.getElementById('icon-form-wrapper').style.display = 'block';
        window.scrollTo({ top: document.getElementById('icon-form-wrapper').offsetTop - 100, behavior: 'smooth' });
    }

    function resetIconForm() {
        document.getElementById('icon-form').reset();
        document.getElementById('icon-id').value = '';
        document.getElementById('icon-form-title').textContent = 'Edit Icon';
        document.getElementById('icon-form').action = '#';
        document.getElementById('icon-method').value = 'PUT';
        // sembunyikan wrapper edit
        document.getElementById('icon-form-wrapper').style.display = 'none';
    }

    function showAddIconForm() {
        document.getElementById('icon-form').reset();
        document.getElementById('icon-id').value = '';
        document.getElementById('icon-form-title').textContent = 'Tambah Icon Baru';
        document.getElementById('icon-form').action = '{{ route("admin.homepage.icons.store") }}';
        document.getElementById('icon-method').value = 'POST';
        document.getElementById('icon-form-wrapper').style.display = 'block';
        window.scrollTo({ top: document.getElementById('icon-form-wrapper').offsetTop - 100, behavior: 'smooth' });
    }

    // Prefill create form for expected icons (set title to expected label)
    function showCreateIcon(title) {
        showAddIconForm();
        setTimeout(() => {
            document.getElementById('icon-title').value = title;
            document.getElementById('icon-class').value = '';
            document.getElementById('icon-description').value = '';
            document.getElementById('icon-link').value = '';
        }, 80);
    }

    // ======================= SECTION FUNCTIONS =======================
    function editSection(id, title, subtitle, content, order, isActive) {
        document.getElementById('section-id').value = id;
        document.getElementById('section-title').value = title;
        document.getElementById('section-subtitle').value = subtitle;
        document.getElementById('section-content').value = content;
        document.getElementById('section-order').value = order;
        document.getElementById('section-active').checked = isActive;
        document.getElementById('section-form-title').textContent = 'Edit Section';
        // set action ke endpoint update dan tampilkan form edit
        document.getElementById('section-form').action = `{{ url('admin/homepage/sections') }}/${id}`;
        document.getElementById('section-method').value = 'PUT';
        document.getElementById('section-image').removeAttribute('required');
        document.getElementById('section-form-wrapper').style.display = 'block';
        window.scrollTo({ top: document.getElementById('section-form-wrapper').offsetTop - 100, behavior: 'smooth' });
    }

    function resetSectionForm() {
        document.getElementById('section-form').reset();
        document.getElementById('section-id').value = '';
        document.getElementById('section-form-title').textContent = 'Tambah Section Baru';
        document.getElementById('section-form').action = '#';
        document.getElementById('section-method').value = 'PUT';
        document.getElementById('section-active').checked = true;
        document.getElementById('section-image').setAttribute('required', 'required');
        // sembunyikan wrapper edit
        document.getElementById('section-form-wrapper').style.display = 'none';
    }

    function showAddSectionForm() {
        document.getElementById('section-form').reset();
        document.getElementById('section-id').value = '';
        document.getElementById('section-form-title').textContent = 'Tambah Section Baru';
        document.getElementById('section-form').action = '{{ route("admin.homepage.sections.store") }}';
        document.getElementById('section-method').value = 'POST';
        document.getElementById('section-active').checked = true;
        document.getElementById('section-form-wrapper').style.display = 'block';
        window.scrollTo({ top: document.getElementById('section-form-wrapper').offsetTop - 100, behavior: 'smooth' });
    }

    // Text section functions removed - now using inline forms

    // Prefill create form for expected sections (set title to expected label)
    function showCreateSection(label) {
        showAddSectionForm();
        // small timeout to ensure form is visible
        setTimeout(() => {
            document.getElementById('section-title').value = label;
            document.getElementById('section-subtitle').value = '';
            document.getElementById('section-content').value = '';
            document.getElementById('section-order').value = 0;
            document.getElementById('section-active').checked = true;
        }, 100);
    }
</script>
<!-- Approve / Reject Modals and forms -->
<!-- Approve Modal -->
<div id="approve-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
        <h3 class="text-lg font-bold mb-3 text-black">Konfirmasi Persetujuan</h3>
        <p id="approve-modal-text" class="mb-4 text-black"></p>
        <form id="approve-form" method="POST" action="#">
            @csrf
            <input type="hidden" name="notes" id="approve-notes">
            <div class="flex justify-end gap-2 text-black">
                <button type="button" onclick="closeApproveModal()" class="px-4 py-2 bg-gray-300 rounded">Tidak</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Ya, Setujui</button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="reject-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
        <h3 class="text-lg text-black font-bold mb-3">Alasan Penolakan</h3>
        <p id="reject-modal-text" class="mb-2 text-black"></p>
        <form id="reject-form" method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-black font-medium mb-1">Alasan penolakan</label>
                <textarea name="reason" id="reject-reason" class="w-full border rounded px-3 py-2 text-black" rows="4" required></textarea>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-[#FEDA60] text-black rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Ya, Tolak</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openApproveModal(id, userName, className) {
        const modal = document.getElementById('approve-modal');
        document.getElementById('approve-modal-text').textContent = `Apakah anda menyetujui pendaftaran user "${userName}" pada kelas "${className}" ini?`;
        const form = document.getElementById('approve-form');
        form.action = `{{ url('/admin/enrollments') }}/${id}/approve`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeApproveModal() {
        const modal = document.getElementById('approve-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openRejectModal(id, userName, className) {
        const modal = document.getElementById('reject-modal');
        document.getElementById('reject-modal-text').textContent = `Menolak pendaftaran user "${userName}" untuk kelas "${className}". Masukkan alasan penolakan:`;
        const form = document.getElementById('reject-form');
        form.action = `{{ url('/admin/enrollments') }}/${id}/reject`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectModal() {
        const modal = document.getElementById('reject-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
