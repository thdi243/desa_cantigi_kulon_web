@extends('template.layout')

@section('title', 'Kabar Desa | ' . config('app.name'))

@section('styles')
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative">
            <!-- Bagian background warna -->
            <div class="w-full h-50 md:h-55 bg-linear-to-br from-sky-500 to-sky-800 overflow-hidden">
            </div>

            <!-- Bagian teks judul -->
            <div class="absolute top-20 left-0 right-0 flex flex-col px-4 items-center justify-center pt-4">
                <h1 class="text-center text-3xl md:text-4xl text-white font-medium mb-4">
                    Ayo Cari Tahu Kabar Desa Terbaru!
                </h1>

                <!-- Garis horizontal -->
                <div class="flex justify-center w-full max-w-md px-8">
                    <div class="h-1 md:h-1.5 w-1/2 bg-white rounded"></div>
                    <div class="h-1 md:h-1.5 w-1/6 bg-white rounded mx-4"></div>
                </div>
            </div>
        </div>
        <div class="container mx-auto py-10 px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Search and Filter Section --}}
                <div class="mb-6 flex flex-col md:flex-row justify-between items-center">
                    <form class="flex flex-col md:flex-row w-full" method="GET" action="{{ route('kabar-desa.index') }}">
                        <div class="relative flex-grow md:mr-4 mb-4 md:mb-0">
                            <input type="text" name="search" placeholder="Cari berita..."
                                value="{{ request('search') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                                <i class="uil uil-search" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <select name="kategori" onchange="this.form.submit()"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="all">Semua Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

                {{-- News Articles Grid --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10 mt-10">
                    @forelse($berita as $artikel)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden transition duration-300 hover:shadow-lg">
                            @if ($artikel->gambar)
                                <img src="{{ asset('storage/berita/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <img src="{{ asset('images/default-berita.jpg') }}" alt="{{ $artikel->judul }}"
                                    class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h2 class="font-bold text-xl mb-2 text-gray-800">{{ $artikel->judul }}</h2>
                                <p class="text-gray-600 font-semibold text-sm mb-4">{{ $artikel->user->name }}</p>
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $artikel->ringkasan }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $artikel->tanggal->format('d M Y') }}</span>
                                    <a href="{{ route('detail', $artikel->id) }}"
                                        class="text-blue-600 hover:text-blue-800 font-semibold">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-600 text-xl">Tidak ada berita ditemukan</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $berita->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection
