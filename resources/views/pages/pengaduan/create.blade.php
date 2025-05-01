@extends('template.layout')

@section('title', 'Pengaduan | ' . config('app.name'))

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative">
            <!-- Bagian gambar -->
            <div class="h-150 md:h-auto overflow-hidden">
                <img src="{{ asset('images/bg-kop-pengaduan-01.png') }}" alt="Background" class="w-full h-full object-cover">
            </div>

            <!-- Bagian teks judul -->
            <div class="absolute top-30 left-0 right-0 flex flex-col px-4 items-center justify-center pt-4">
                <h1 class="text-center text-3xl md:text-4xl text-white font-medium mb-4">
                    Ayo Sampaikan Pengaduan Anda
                </h1>

                <!-- Garis horizontal -->
                <div class="flex justify-center w-full max-w-md px-8">
                    <div class="h-1 md:h-1.5 w-1/2 bg-white rounded"></div>
                    <div class="h-1 md:h-1.5 w-1/6 bg-white rounded mx-4"></div>
                </div>
            </div>
        </div>

        <!-- Bagian Form -->
        <div class="relative container max-w-4xl mx-auto px-4 py-8 -mt-90 md:-mt-110">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                    <div class="px-6 py-8 sm:p-10">
                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" id="name"
                                            class="block w-full px-4 py-3 border rounded-md shadow-sm 
                                        focus:ring-green-500 focus:border-green-500 
                                        placeholder-gray-400"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>

                                    <div>
                                        <label for="nik"
                                            class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                        <input type="number" name="nik" id="nik"
                                            class="block w-full px-4 py-3 border rounded-md shadow-sm 
                                        focus:ring-green-500 focus:border-green-500 
                                        placeholder-gray-400"
                                            placeholder="Nomor Induk Kependudukan" required>


                                    </div>
                                </div>

                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori
                                        Pengaduan</label>
                                    <select name="category" id="category"
                                        class="block w-full px-4 py-3 border rounded-md shadow-sm 
                                    focus:ring-green-500 focus:border-green-500"
                                        required>
                                        <option value="" disabled selected>Pilih Kategori Pengaduan</option>
                                        <option value="infrastruktur">Infrastruktur</option>
                                        <option value="pelayanan">Pelayanan Publik</option>
                                        <option value="lingkungan">Lingkungan</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                                        Pengaduan</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="block w-full px-4 py-3 border rounded-md shadow-sm 
                                    focus:ring-green-500 focus:border-green-500 
                                    placeholder-gray-400"
                                        placeholder="Jelaskan pengaduan Anda secara detail" required></textarea>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Unggah
                                            Foto Bukti</label>
                                        <input type="file" name="image" id="image" accept="image/*"
                                            class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-full file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-green-50 file:text-green-700
                                        hover:file:bg-green-100">
                                    </div>
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi
                                        Kejadian</label>
                                    <input type="text" name="location" id="location"
                                        class="block w-full px-4 py-3 border rounded-md shadow-sm 
                                    focus:ring-green-500 focus:border-green-500 
                                    placeholder-gray-400"
                                        placeholder="Alamat lengkap lokasi kejadian" required>
                                </div>

                                <div class="mt-6">
                                    <button type="submit"
                                        class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg 
                                    hover:bg-green-700 transition duration-300 
                                    focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50
                                    transform hover:scale-105 active:scale-95">
                                        Kirim Pengaduan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                }
            });
        });
    </script>
@endsection
