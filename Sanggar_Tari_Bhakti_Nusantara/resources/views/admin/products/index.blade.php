@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F5F5F5] via-[#FFF9E5] to-[#FFF6D5]">
    <div class="flex">
        @include('components.admin-sidebar')

        <!-- main content -->
        <main class="flex-1 p-6 lg:p-10 lg:ml-0">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#2E2E2E]">Kelola Produk</h1>
                <p class="text-[#4F4F4F] mt-2">Manajemen data produk sanggar</p>
            </div>
            <a href="{{ route('products.create') }}" class="px-6 py-3 bg-gradient-to-br from-[#FEDA60] to-[#F5B347] text-white rounded-xl hover:shadow-xl transition-all">
                Tambah Produk
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-[#FEDA60]/30 shadow-lg rounded-2xl overflow-hidden">
            <div class="px-6 py-4 bg-[#FFF6D5] border-b border-[#FEDA60]/20 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-[#2E2E2E]">Daftar Produk</h2>
                <div class="text-sm text-gray-600">Total: <span class="font-medium text-[#8C6A08]">{{ $products->total() }}</span></div>
            </div>

            {{-- Desktop table --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="text-left text-sm text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-3 border-b border-gray-100">Produk</th>
                            <th class="px-6 py-3 border-b border-gray-100">Deskripsi</th>
                            <th class="px-6 py-3 border-b border-gray-100 text-right">Harga</th>
                            <th class="px-6 py-3 border-b border-gray-100 text-center">Stok</th>
                            <th class="px-6 py-3 border-b border-gray-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($products as $product)
                            <tr class="hover:bg-[#FFFAE6]">
                                <td class="px-6 py-4 flex items-center gap-4">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="h-16 w-16 bg-white/5 rounded-lg flex items-center justify-center border border-white/5">
                                            <span class="text-xs text-gray-400">No Image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-semibold text-[#2E2E2E]">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($product->description, 80) }}</div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 align-top text-right whitespace-nowrap">
                                    <div class="text-sm font-semibold text-[#8C6A08]">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>

                                <td class="px-6 py-4 align-top text-center">
                                    @if($product->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $product->stock }} stok</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Habis</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 px-3 py-1.5 h-9 bg-white border border-[#FEDA60]/30 text-[#8C6A08] rounded-lg hover:bg-[#FFF9E5]">Edit</a>

                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 h-9 bg-red-50 border border-red-200 text-red-700 rounded-lg hover:bg-red-100">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada produk. <a href="{{ route('products.create') }}" class="inline-flex items-center px-3 py-1.5 bg-[#8C6A08] text-white rounded-md hover:bg-white hover:text-black border border-transparent hover:border-gray-200 transition">Tambah produk pertama</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile cards --}}
            <div class="lg:hidden space-y-4 p-4">
                @forelse($products as $product)
                    <div class="bg-white/80 border border-[#FEDA60]/20 rounded-xl p-4 shadow-sm">
                        <div class="flex items-start gap-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 object-cover rounded-lg">
                            @else
                                <div class="h-20 w-20 bg-white/5 rounded-lg flex items-center justify-center border border-white/5">
                                    <span class="text-xs text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="text-sm font-semibold text-[#2E2E2E]">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ Str::limit($product->description, 80) }}</div>
                                    </div>
                                    <div class="text-sm font-semibold text-[#8C6A08]">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                </div>

                                <div class="mt-3 flex items-center gap-2">
                                    @if($product->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $product->stock }} stok</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Habis</span>
                                    @endif
                                    <div class="ml-auto flex items-center gap-2">
                                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 px-3 py-1 h-8 bg-white border border-[#FEDA60]/30 text-[#8C6A08] rounded-lg">Edit</a>

                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1 h-8 bg-red-50 border border-red-200 text-red-700 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500">Belum ada produk. <a href="{{ route('products.create') }}" class="inline-flex items-center px-2 py-1 bg-[#8C6A08] text-white rounded-sm hover:bg-white hover:text-black border border-transparent hover:border-gray-200 transition">Tambah produk pertama</a></div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
            </div>
        </main>
    </div>
</div>


@endsection
