@extends('template.layout')

@section('title', 'Kabar Desa | ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative">
            <!-- Bagian background warna -->
            <div class="w-full h-50 md:h-55 bg-linear-to-br from-sky-500 to-sky-800 overflow-hidden">
            </div>

            <!-- Bagian teks judul -->
            <div class="absolute top-20 left-0 right-0 flex flex-col px-4 items-center justify-center pt-4">
                <h1 class="text-center text-3xl md:text-4xl text-white font-medium mb-4">
                    Jelajahi Kabar Tentang Desa Yuk!
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
                {{-- Breadcrumb --}}
                <div class="flex items-center text-sm text-gray-600 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('kabar-desa.index') }}" class="hover:text-blue-600">Kabar Desa</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">{{ $artikel->judul }}</span>
                </div>

                {{-- Article Header --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $artikel->judul }}</h1>
                    <div class="flex items-center text-gray-600 mb-6">
                        <span class="mr-4">
                            <i class="uil uil-calendar-alt mr-1"></i>
                            {{ $artikel->tanggal->format('d M Y') }}
                        </span>
                        <span>
                            <i class="uil uil-tag-alt mr-2"></i>
                            {{ $artikel->kategori->nama_kategori }}
                        </span>
                        <span class="ml-4">
                            <i class="uil uil-user mr-1"></i>
                            {{ $artikel->user->name }}
                        </span>
                    </div>
                </div>

                {{-- Featured Image --}}
                @if ($artikel->gambar)
                    <div class="mb-8">
                        <img src="{{ asset('storage/berita/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                            class="w-full h-auto rounded-lg shadow-md">
                    </div>
                @endif

                {{-- Article Content --}}
                <div class="prose prose-lg max-w-none mb-12">
                    {!! $artikel->isi !!}
                </div>

                {{-- Tags & Share --}}
                <div class="flex flex-wrap justify-between items-center py-6 border-t border-b border-gray-200 mb-12">
                    <div class="flex flex-wrap items-center">
                        <span class="font-medium mr-3">Bagikan:</span>
                        <a href="#" class="text-gray-600 hover:text-blue-600 mr-4">
                            <i class="uil uil-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 mr-4">
                            <i class="uil uil-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">
                            <i class="uil uil-whatsapp"></i>
                        </a>
                    </div>
                </div>

                {{-- Related Articles --}}
                @if (count($beritaTerkait) > 0)
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            @foreach ($beritaTerkait as $terkait)
                                <div
                                    class="bg-white shadow-md rounded-lg overflow-hidden transition duration-300 hover:shadow-lg">
                                    @if ($terkait->gambar)
                                        <img src="{{ asset('storage/berita/' . $terkait->gambar) }}"
                                            alt="{{ $terkait->judul }}" class="w-full h-40 object-cover">
                                    @else
                                        <img src="{{ asset('images/default-berita.jpg') }}" alt="{{ $terkait->judul }}"
                                            class="w-full h-40 object-cover">
                                    @endif
                                    <div class="p-4">
                                        <h2 class="font-bold text-lg mb-2 text-gray-800 line-clamp-2">{{ $terkait->judul }}
                                        </h2>
                                        <div class="flex justify-between items-center mt-4">
                                            <span
                                                class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($terkait->tgl_publish)->format('d M Y') }}</span>
                                            <a href="{{ route('detail', $terkait->id) }}"
                                                class="text-blue-600 hover:text-blue-800 font-semibold">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Back Button --}}
                <div class="text-center">
                    <a href="{{ route('kabar-desa.index') }}"
                        class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="uil uil-arrow-left mr-2"></i> Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
