@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
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
                        <a href="{{ route('products.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-white text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Produk</p>
                        </a>

                        <a href="{{ route('classes.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#FFE184] to-[#FEDA60] text-white text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Kelas</p>
                        </a>

                        <a href="{{ route('products.create') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#F5B347] to-[#E2B136] text-white text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <p class="font-semibold text-lg">Tambah Produk</p>
                        </a>

                        <a href="{{ route('classes.create') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#E2B136] to-[#C89B2E] text-white text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <p class="font-semibold text-lg">Tambah Kelas</p>
                        </a>

                        <a href="{{ route('admin.gallery.carousel.index') }}" class="p-6 rounded-2xl bg-gradient-to-br from-[#C89B2E] to-[#B8841A] text-white text-center hover:shadow-xl hover:scale-[1.05] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 mx-auto mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <p class="font-semibold text-lg">Kelola Galeri</p>
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
                                </div>
                            @empty
                                <p class="text-center text-[#4F4F4F] py-8">Belum ada pendaftaran</p>
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
            </div>
        </main>
    </div>
</div>

<script>
    function showSection(sectionName) {
        // Hide all sections
        document.querySelectorAll('.dashboard-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        // Show selected section
        document.getElementById(sectionName + '-section').classList.remove('hidden');
        
        // Update active nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        });
        event.target.closest('.nav-link').classList.add('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
    }
    
    // Handle hash navigation for activity section
    if (window.location.hash === '#activity') {
        showSection('activity');
    }
</script>
@endsection
