<footer class="bg-[#2a3034] text-white">
    <div class="container mx-auto px-4 pt-10">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Kolom Profil Desa -->
            <div>
                <h3 class="text-xl font-bold mb-6">Desa Cantigi Kulon</h3>
                <p class="text-gray-300 mb-4">
                    Membangun masa depan desa dengan semangat gotong royong, inovasi, dan keberlanjutan.
                </p>
                <div class="flex space-x-4">
                    <a href="" class="text-white hover:text-sky-400 transition duration-300">
                        <i class="uil uil-facebook-f text-2xl"></i>
                    </a>
                    <a href="" class="text-white hover:text-sky-400 transition duration-300">
                        <i class="uil uil-instagram text-2xl"></i>
                    </a>
                    <a href="" class="text-white hover:text-sky-400 transition duration-300">
                        <i class="uil uil-twitter-alt text-2xl"></i>
                    </a>
                    {{-- <a href="" class="text-white hover:text-sky-400 transition duration-300">
                        <i class="uil uil-youtube text-2xl"></i>
                    </a> --}}
                </div>
            </div>

            <!-- Kolom Tautan Cepat -->
            <div class="mx-0 md:mx-auto">
                <h3 class="text-xl font-bold mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Beranda</a>
                    </li>
                    <li><a href="profile-desa" class="text-gray-300 hover:text-white transition duration-300">Profil
                            Desa</a>
                    </li>
                    <li><a href="kabar-desa.index" class="text-gray-300 hover:text-white transition duration-300">Kabar
                            Desa</a></li>
                    <li><a href="galeri" class="text-gray-300 hover:text-white transition duration-300">Galeri Desa</a>
                    </li>
                    <li><a href="{{ route('pengaduan.create') }}"
                            class="text-gray-300 hover:text-white transition duration-300">Pengaduan</a>
                    </li>
                </ul>
            </div>

            <!-- Kolom Layanan -->
            {{-- <div>
                <h3 class="text-xl font-bold mb-6">Layanan</h3>
                <ul class="space-y-3">
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Surat
                            Menyurat</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Kartu
                            Keluarga</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Akta
                            Kelahiran</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Pengaduan
                            Masyarakat</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition duration-300">Informasi
                            Publik</a></li>
                </ul>
            </div> --}}

            <!-- Kolom Kontak -->
            <div>
                <h3 class="text-xl font-bold mb-6">Hubungi Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <i class="uil uil-map-marker mr-3 text-sky-400"></i>
                        <span class="text-gray-300">Cantigi Kulon, Kec. Cantigi, Kabupaten Indramayu, Jawa Barat
                            45258</span>
                    </li>
                    <li class="flex items-center">
                        <i class="uil uil-phone mr-3 text-sky-400"></i>
                        <span class="text-gray-300">+62 896-1963-1700</span>
                    </li>
                    <li class="flex items-center">
                        <i class="uil uil-envelope mr-3 text-sky-400"></i>
                        <span class="text-gray-300">pemerintah@desacantigikulon.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Garis Pemisah -->
        <div class="border-t border-gray-700 mt-10">
            <div class="flex justify-center items-center py-4">
                <p class="text-gray-400 text-center">
                    &copy; 2025 Desa Cantigi Kulon. Hak Cipta Dilindungi.
                </p>
            </div>
        </div>
    </div>
</footer>
