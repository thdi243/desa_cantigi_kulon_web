@extends('template.layout')
@section('title', 'Beranda | ' . config('app.name'))
@section('content')
    <!-- Hero Section -->
    <section id="home">
        <div class="relative">
            <div class="h-[50vh] md:h-[70vh] lg:h-[100vh] overflow-hidden">
                <img class="w-full h-full object-cover" src="{{ asset('images/background_home.jpg') }}" alt="Background Hero">
            </div>
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-4">
                <h1 class="text-2xl md:text-4xl lg:text-5xl text-white font-bold mb-2 md:mb-4">
                    Selamat Datang!
                </h1>
                <h1 class="text-2xl md:text-4xl lg:text-5xl text-white font-bold mb-4 md:mb-7 text-center">
                    Di Website Desa Cantigi Kulon
                </h1>

                <!-- Garis horizontal 2 potong -->
                <div class="flex items-center justify-center w-full max-w-md px-8">
                    <div class="h-1 md:h-1.5 w-1/2 bg-white rounded"></div>
                    <div class="h-1 md:h-1.5 w-1/6 bg-white rounded mx-4"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pelayanan Section -->
    <section id="pelayanan" class="py-10 md:py-16 mt-10">
        <div class="bg-[#FFFDF7] px-4 md:px-7 lg:px-9">
            <h1 class="text-[#676767] font-bold text-center text-2xl md:text-4xl mb-2">Pelayanan Kami</h1>
            <h5 class="text-[#676767] font-medium text-center text-xs md:text-sm">Layanan Terbaik untuk Kebutuhan
                Masyarakat Desa</h5>

            <!-- Cards Container -->
            <div class="mx-auto gap-6 mt-6 md:mt-10 py-6 md:py-12 flex flex-col items-center">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 md:gap-15 md:justify-center">
                    @foreach ($suratTypes->take(3) as $suratType)
                        <!-- Card -->
                        <div
                            class="bg-white rounded-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden text-center md:text-start">
                            <div class="p-4 md:p-6">
                                <!-- Icon -->
                                <div style="background-color: {{ $suratType->bg_color }};"
                                    class="w-12 h-12 md:w-16 md:h-16 rounded-xl flex items-center justify-center mb-3 md:mb-4 mx-auto md:mx-0">
                                    <span style="color: {{ $suratType->text_color }};"><i
                                            class="uil {{ $suratType->icon }} text-3xl md:text-5xl"></i></span>
                                </div>

                                <h3 class="text-lg md:text-xl font-bold text-[#676767] mb-2">{{ $suratType->nama_surat }}
                                </h3>
                                <p class="text-[#676767] text-sm md:text-base mb-4 md:mb-6">{{ $suratType->description }}
                                </p>

                                <!-- Button -->
                                <div>
                                    <a href="{{ $suratType->route }}"
                                        class="inline-block px-4 py-2 md:px-6 md:py-2 bg-orange-300 text-white text-sm md:text-base rounded-md hover:bg-orange-500 transition-colors duration-300">
                                        Ajukan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Profil Desa Section -->
    <section id="profil-desa" class="bg-[#FDC921] py-10 md:py-16 mt-10">
        <div class="container mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center">
            <div class="flex flex-col md:flex-row items-center justify-between gap-20 md:gap-25">
                <!-- Left column - Text content -->
                <div class="w-full md:w-1/2 space-y-4 text-center md:text-left">
                    <h1 class="text-2xl md:text-4xl font-bold text-white">Profil Desa</h1>

                    <h5 class="text-white font-medium text-xs md:text-sm mb-4 md:mb-6">
                        Mengenal Desa Cantigi Kulon Lebih Dekat Sejarah, Visi Misi, Struktur, dan Potensi
                    </h5>

                    <div>
                        <a href="{{ route('profile-desa') }}" target="_blank"
                            class="inline-flex outline-2 text-white hover:bg-white hover:outline-white hover:text-black py-2 px-4 md:px-6 rounded-lg font-medium text-sm md:text-base transition duration-300 items-center">
                            Lihat Selengkapnya <i class="uil uil-angle-right-b text-xl md:text-2xl ms-2 md:ms-3"></i>
                        </a>
                    </div>
                </div>

                <!-- Right column - Image -->
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="rounded-lg overflow-hidden w-full max-w-xs md:max-w-md">
                        <img src="{{ asset('images/profil-desa.png') }}" alt="icon profil desa"
                            class="w-full h-auto object-contain" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengaduan Section -->
    <section id="pengaduan" class="bg-[#FFFDF7] py-10 md:py-16 mt-15">
        <div class="mx-auto px-4 md:px-6 lg:px-8 flex flex-col items-center">
            <div class="flex flex-col md:flex-row items-center justify-between gap-15 md:gap-20">
                <div class="w-full md:w-1/2 flex justify-center order-2 md:order-1">
                    <div class="rounded-lg overflow-hidden w-full max-w-xs md:max-w-md">
                        <img src="{{ asset('images/pengaduan.png') }}" alt="icon pengaduan"
                            class="w-full h-auto object-cover" />
                    </div>
                </div>

                <div class="w-full md:w-1/2 space-y-4 text-center md:text-left order-1 md:order-2">
                    <h1 class="text-2xl md:text-4xl font-bold text-[#676767]">Ayo Mengadu</h1>

                    <h5 class="text-[#676767] font-medium text-xs md:text-sm mb-4 md:mb-6">
                        Bantu kami menciptakan desa yang lebih baik dengan melaporkan setiap permasalahan.
                    </h5>

                    <div>
                        <a href="{{ route('pengaduan.create') }}"
                            class="inline-flex text-white bg-sky-700 hover:bg-sky-900 py-2 px-4 md:px-6 rounded-lg font-medium text-sm md:text-base transition duration-300 items-center">
                            Ayo Lapor <i class="uil uil-angle-right-b text-xl md:text-2xl ms-2 md:ms-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Desa Section -->
    <section id="kabar-desa" class="bg-[#FFFDF7] py-16 mt-15">
        <div class="container mx-auto px-10">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-[#676767] mb-4">Kabar Desa</h2>
                <p class="text-[#676767] max-w-2xl mx-auto">
                    Tetap terhubung dengan perkembangan terkini di Desa Cantigi Kulon. Simak berbagai berita dan
                    informasi
                    terbaru dari desa kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($kabarDesa as $berita)
                    <div class="bg-white rounded-lg overflow-hidden transition duration-300 hover:shadow-lg">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->title }}"
                            class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <i class="uil uil-calendar-alt mr-2"></i>
                                <span>{{ \Carbon\Carbon::parse($berita->tgl_publish)->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-[#676767] mb-3">
                                {{ $berita->judul }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($berita->ringkasan) }}
                            </p>
                            <a href="{{ route('detail', $berita->id) }}" target="-blank"
                                class="text-sky-700 hover:underline inline-flex items-center">
                                Baca Selengkapnya
                                <i class="uil uil-angle-right-b ml-2"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('kabar-desa.index') }}" target="_blank"
                    class="bg-sky-700 text-white py-3 px-8 rounded-lg hover:bg-sky-800 transition duration-300 inline-flex items-center">
                    Lihat Berita Lainnya
                    <i class="uil uil-newspaper ml-3 text-xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Galeri Desa Section -->
    <section class="galeri-desa bg-[#FFFDF7] py-16 mt-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-[#676767] mb-4">Galeri Desa</h2>
                <p class="text-[#676767] max-w-2xl mx-auto">
                    Jelajahi momen-momen indah dan kegiatan bermakna di Desa Cantigi Kulon melalui koleksi foto kami.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($galeri as $item)
                    <div class="gallery-item group relative overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                            class="w-full h-48 md:h-64 object-cover transition duration-300 group-hover:scale-110" />
                        <div
                            class="absolute inset-0 flex items-end p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-t from-black/70 to-transparent">
                            <div class="text-white">
                                <h4 class="font-bold text-lg">{{ $item->judul }}</h4>
                                <p class="text-sm">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('galeri') }}" target="_blank"
                    class="bg-sky-700 text-white py-3 px-8 rounded-lg hover:bg-sky-800 transition duration-300 inline-flex items-center">
                    Lihat Galeri Lainnya
                    <i class="uil uil-images ml-3 text-xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    {{-- <section id="kontak" class="bg-[#FFFDF7] py-16 mt-10">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-[#676767] mb-12">Kontak Kami</h2>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Kontak Informasi -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-[#676767] mb-6">Informasi Kontak</h3>

                    <div class="space-y-6">
                        <div class="flex items-center">
                            <i class="uil uil-map-marker text-sky-700 text-2xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-[#676767]">Alamat</h4>
                                <p class="text-gray-600">Jl. Raya Cantigi Kulon No. 207
                                    Desa Cantigi Kulon Kecamatan Cantigi
                                    Kabupaten Indramayu Kode pos 45251</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <i class="uil uil-phone text-sky-700 text-2xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-[#676767]">Telepon</h4>
                                <p class="text-gray-600">+62 812-3456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <i class="uil uil-envelope text-sky-700 text-2xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-[#676767]">Email</h4>
                                <p class="text-gray-600">pemerintah@desacantigikulon.id</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <i class="uil uil-clock text-sky-700 text-2xl mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-[#676767]">Jam Operasional</h4>
                                <p class="text-gray-600">Senin - Jumat: 08.00 - 16.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-2xl font-bold text-[#676767] mb-6">Kirim Pesan</h3>

                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#676767] mb-2">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-[#676767] mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" />
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-[#676767] mb-2">Nomor
                                Telepon</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" />
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-[#676767] mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-sky-700 text-white py-3 rounded-lg hover:bg-sky-800 transition duration-300 cursor-pointer">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
