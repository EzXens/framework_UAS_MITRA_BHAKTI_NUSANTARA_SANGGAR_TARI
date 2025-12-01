@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        <!-- sidebar -->
        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 h-screen w-64 bg-[#2E2E2E] text-white transition-transform duration-300 z-40 lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <!-- logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        <span class="text-lg font-semibold text-[#FEDA60]">Admin Dashboard</span>
                    </div>
                </div>

                <!-- nav -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="#dashboard" onclick="showSection('dashboard')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm active">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="#activity" onclick="showSection('activity')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                        Aktivitas Terbaru
                    </a>
                    <a href="{{ route('classes.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        Kelola Kelas
                    </a>
                    <a href="{{ route('products.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        Kelola Produk
                    </a>
                </nav>

                <div class="p-4 border-t border-white/10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 transition-all text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </aside>

        <!-- sidebar toggle (mobile) -->
        <button id="sidebar-toggle" class="fixed top-4 left-4 z-50 lg:hidden p-2 rounded-xl bg-[#2E2E2E] text-white shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

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

    // Sidebar toggle for mobile
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebar-toggle');
        
        if (window.innerWidth < 1024 && 
            !sidebar.contains(event.target) && 
            !toggle.contains(event.target) &&
            !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
@endsection
