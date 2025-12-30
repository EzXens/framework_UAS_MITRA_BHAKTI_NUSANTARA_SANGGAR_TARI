@extends('layouts.app')

@section('content')
    <section class="flex min-h-[85vh] items-center justify-center bg-[#F5F5F4] py-24">
        <div class="mx-auto max-w-xl text-center">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-3xl border border-black/40 bg-black-500-500/10 text-amber-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-10 w-10">
                    <path d="M12 2a9 9 0 1 0 9 9 9.01 9.01 0 0 0-9-9Zm0 13a1.25 1.25 0 1 1 1.25-1.25A1.25 1.25 0 0 1 12 15Zm1.5-5.25a1.5 1.5 0 0 1-3 0V7a1.5 1.5 0 0 1 3 0Z" />
                </svg>
            </div>
            <h1 class="text-4xl font-semibold text-black">401 · Unauthorized</h1>
            <p class="mt-3 text-sm text-black-400">Halaman ini membutuhkan autentikasi. Silakan login untuk melanjutkan.</p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url()->previous(route('home')) }}" class="rounded-xl border border-black/40 px-5 py-2.5 text-sm font-semibold text-black-200 hover:bg-white/5">Kembali</a>
                <a href="{{ route('home') }}" class="rounded-xl bg-gradient-to-r from-yellow-300/80 to-yellow-500/70 px-5 py-2.5 text-sm font-semibold text-slate-950 shadow hover:scale-[1.02]">Beranda</a>
            </div>
        </div>
    </section>
@endsection