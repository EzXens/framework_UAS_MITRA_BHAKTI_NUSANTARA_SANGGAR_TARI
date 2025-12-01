@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen relative" style="background-image: url('{{ asset('images/bg2.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <!-- Black overlay -->
    <div class="absolute inset-0 bg-black/50"></div>
    
    <div class="relative flex">
        <!-- sidebar -->
        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 h-screen w-64 bg-[#2E2E2E] text-white transition-transform duration-300 z-40 lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full">
                <!-- logo -->
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        <span class="text-lg font-semibold text-[#FEDA60]">Dashboard</span>
                    </div>
                </div>

                <!-- nav -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="#overview" onclick="showSection('overview')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm active">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Beranda
                    </a>
                    <a href="#schedule" onclick="showSection('schedule')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        Jadwal Saya
                    </a>
                    <a href="#classes" onclick="showSection('classes')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        Kelas Saya
                    </a>
                    <a href="#profile" onclick="showSection('profile')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        Profil Saya
                    </a>
                    <a href="#dispensation" onclick="showSection('dispensation')" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#FEDA60]/10 hover:text-[#FEDA60] transition-all text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        Dispensasi
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
            <!-- overview (tanpa background foto) -->
            <section id="overview-section" class="dashboard-section min-h-screen -m-6 lg:-m-10 p-6 lg:p-10 bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5] relative z-10">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Selamat Datang, {{ $user->name }}!</h1>
                    <p class="text-[#4F4F4F] mt-2">Kelola kelas dan jadwal latihan tari Anda di sini.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-3 mb-8">
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-[#FEDA60]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-[#8C6A08]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ $enrolledClasses->count() }}</p>
                                <p class="text-sm text-[#4F4F4F]">Kelas Terdaftar</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ count($schedules) }}</p>
                                <p class="text-sm text-[#4F4F4F]">Jadwal Mingguan</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <div class="p-3 rounded-xl bg-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-purple-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-[#2E2E2E]">{{ $enrolledClasses->unique('class.instructor')->count() }}</p>
                                <p class="text-sm text-[#4F4F4F]">Instruktur</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-[#2E2E2E] mb-4">Jadwal Terdekat</h2>
                    @if(count($schedules) > 0)
                        <div class="space-y-3">
                            @foreach(array_slice($schedules, 0, 3) as $schedule)
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5] border border-[#FEDA60]/20">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-[#2E2E2E]">{{ $schedule['class_name'] }}</p>
                                        <p class="text-sm text-[#4F4F4F] flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $schedule['schedule'] }}
                                        </p>
                                        <p class="text-xs text-[#8C6A08] mt-1 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            Instruktur: {{ $schedule['instructor'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-[#4F4F4F] text-center py-8">Belum ada jadwal kelas.</p>
                    @endif
                </div>
            </section>

            <!-- jadwal section -->
            <section id="schedule-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Jadwal Latihan</h1>
                    <p class="text-[#4F4F4F] mt-2">Timeline jadwal kelas tari yang Anda ikuti.</p>
                </div>

                @if(count($schedules) > 0)
                    <div class="space-y-6">
                        @php
                            $daysOfWeek = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            $daySchedules = array_fill_keys($daysOfWeek, []);
                            
                            foreach($schedules as $schedule) {
                                // Parse "Senin & Rabu, 16:00-18:00"
                                $parts = explode(',', $schedule['schedule']);
                                if (count($parts) >= 2) {
                                    $days = explode('&', $parts[0]);
                                    $time = trim($parts[1]);
                                    
                                    foreach ($days as $day) {
                                        $day = trim($day);
                                        if (in_array($day, $daysOfWeek)) {
                                            $daySchedules[$day][] = [
                                                'class_name' => $schedule['class_name'],
                                                'time' => $time,
                                                'instructor' => $schedule['instructor']
                                            ];
                                        }
                                    }
                                }
                            }
                        @endphp

                        @foreach($daysOfWeek as $day)
                            <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-6 shadow-lg">
                                <h3 class="text-lg font-bold text-[#2E2E2E] mb-4 flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-[#FEDA60]"></div>
                                    {{ $day }}
                                </h3>
                                @if(count($daySchedules[$day]) > 0)
                                    <div class="space-y-3 ml-5 border-l-2 border-[#FEDA60]/30 pl-6">
                                        @foreach($daySchedules[$day] as $item)
                                            <div class="relative">
                                                <div class="absolute -left-[29px] top-3 w-4 h-4 rounded-full bg-[#FEDA60] border-4 border-white"></div>
                                                <div class="p-4 rounded-xl bg-[#FFF9E5] border border-[#FEDA60]/20">
                                                    <p class="font-semibold text-[#2E2E2E]">{{ $item['class_name'] }}</p>
                                                    <p class="text-sm text-[#4F4F4F] mt-1 flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $item['time'] }}
                                                    </p>
                                                    <p class="text-sm text-[#8C6A08] mt-1 flex items-center gap-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                        </svg>
                                                        {{ $item['instructor'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-[#4F4F4F] text-sm ml-5 pl-6">Tidak ada jadwal</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 shadow-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <p class="text-[#4F4F4F] text-lg">Belum ada jadwal kelas.</p>
                        <a href="{{ route('classes.public') }}" class="inline-block mt-4 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold">Daftar Kelas</a>
                    </div>
                @endif
            </section>

            <!-- class section -->
            <section id="classes-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelas Saya</h1>
                    <p class="text-[#4F4F4F] mt-2">Daftar kelas tari yang sedang Anda ikuti.</p>
                </div>

                @if($enrolledClasses->count() > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($enrolledClasses as $enrollment)
                            @if($enrollment->class)
                                <div class="rounded-2xl bg-white border border-[#FEDA60]/30 overflow-hidden shadow-lg hover:shadow-xl transition-all">
                                    @if($enrollment->class->image)
                                        <div class="h-48 overflow-hidden">
                                            <img src="{{ asset('storage/' . $enrollment->class->image) }}" alt="{{ $enrollment->class->name }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="h-48 bg-gradient-to-br from-[#FFE184] via-[#FEDA60] to-[#F5B347] flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-white/50">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="p-6">
                                        <h3 class="text-lg font-bold text-[#2E2E2E] mb-3">{{ $enrollment->class->name }}</h3>
                                        <p class="text-sm text-[#4F4F4F] mb-4 line-clamp-2">{{ $enrollment->class->description }}</p>
                                        <div class="space-y-2 text-sm">
                                            <p class="text-[#4F4F4F] flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                </svg>
                                                {{ $enrollment->class->instructor }}
                                            </p>
                                            <p class="text-[#4F4F4F] flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                                </svg>
                                                {{ $enrollment->class->schedule }}
                                            </p>
                                            <p class="text-[#8C6A08] font-semibold flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                </svg>
                                                Rp {{ number_format($enrollment->class->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-[#FEDA60]/20">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Terdaftar
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-12 shadow-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-300 mx-auto mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        <p class="text-[#4F4F4F] text-lg">Anda belum mendaftar kelas apapun.</p>
                        <a href="{{ route('classes.public') }}" class="inline-block mt-4 px-6 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold">Jelajahi Kelas</a>
                    </div>
                @endif
            </section>

            <!-- profile -->
            <section id="profile-section" class="dashboard-section hidden">
                <div class="mb-8 bg-white p-6 rounded-2xl">
                    <h1 class="text-3xl font-bold text-[#2E2E2E]">Profil Saya</h1>
                    <p class="text-[#4F4F4F] mt-2">Informasi lengkap akun Anda.</p>
                </div>

                <div class="grid gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-1">
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg text-center">
                            @if($user->profile_picture)
                                <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-gradient-to-br from-[#FEDA60] to-[#F5B347] flex items-center justify-center text-white text-4xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                            @endif
                            <h2 class="text-xl font-bold text-[#2E2E2E]">{{ $user->name }}</h2>
                            <p class="text-sm text-[#4F4F4F] mt-1">{{ ucfirst($user->role) }}</p>
                            <p class="text-sm text-[#8C6A08] mt-2">{{ $user->email }}</p>
                            
                            <!-- upload pp -->
                            <form action="{{ route('user.updateProfilePicture') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                                @csrf
                                <label for="profile_picture" class="block w-full cursor-pointer px-4 py-3 rounded-xl bg-gradient-to-r from-[#FEDA60] to-[#F5B347] text-[#2E2E2E] font-semibold text-sm hover:shadow-lg transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                    Ganti Foto Profil
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="this.form.submit()">
                            </form>
                            
                            @if(session('success'))
                                <p class="mt-3 text-sm text-green-600">{{ session('success') }}</p>
                            @endif
                            @error('profile_picture')
                                <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="rounded-2xl bg-white border border-[#FEDA60]/30 p-8 shadow-lg">
                            <h3 class="text-xl font-bold text-[#2E2E2E] mb-6">Informasi Akun</h3>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Nama Lengkap</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Email</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Status Akun</p>
                                        <p class="font-semibold text-green-600">Aktif</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF9E5]">
                                    <div class="p-3 rounded-xl bg-[#FEDA60]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[#4F4F4F]">Bergabung Sejak</p>
                                        <p class="font-semibold text-[#2E2E2E]">{{ $user->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<script>
    // sidebar toggle mobile
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    
    sidebarToggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // section nav
    function showSection(sectionName) {
        // hide sections
        document.querySelectorAll('.dashboard-section').forEach(section => {
            section.classList.add('hidden');
        });
        
        // show selected section
        document.getElementById(sectionName + '-section').classList.remove('hidden');
        
        // update nav link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        });
        event.target.closest('.nav-link').classList.add('active', 'bg-[#FEDA60]/10', 'text-[#FEDA60]');
        
        // close sidebar mobile
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    }

    // innit navlink
    document.querySelector('.nav-link').classList.add('bg-[#FEDA60]/10', 'text-[#FEDA60]');
</script>
@endsection
