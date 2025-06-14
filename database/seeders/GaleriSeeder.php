<?php

namespace Database\Seeders;

use App\Models\GaleriModel;
use Illuminate\Database\Seeder;
use App\Models\KategoriGaleriModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Smart People',
                'slug' => 'smart-people',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Smart Economic',
                'slug' => 'smart-economic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Smart Environment',
                'slug' => 'smart-environment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Smart Government',
                'slug' => 'smart-government',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Smart Living',
                'slug' => 'smart-living',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Smart Mobility',
                'slug' => 'smart-mobility',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert kategori
        KategoriGaleriModel::insert($kategori);

        // Buat contoh galeri
        $galeri = [
            [
                'judul' => 'Rapat Desa Triwulan',
                'deskripsi' => 'Musyawarah Rencana Pembangunan Desa',
                'gambar' => 'foto1.jpg',
                'status' => 'published',
                'kategori_id' => 1, // Kegiatan Desa
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Gotong Royong Bersihkan Sungai',
                'deskripsi' => 'Kebersamaan warga membersihkan daerah aliran sungai',
                'gambar' => 'foto2.jpg',
                'status' => 'published',
                'kategori_id' => 2, // Gotong Royong
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Festival Budaya Tahunan',
                'deskripsi' => 'Menampilkan kesenian tradisional desa',
                'gambar' => 'foto3.jpg',
                'status' => 'published',
                'kategori_id' => 3, // Budaya
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pembangunan Jalan Desa',
                'deskripsi' => 'Peningkatan infrastruktur jalan utama desa',
                'gambar' => 'foto4.jpg',
                'status' => 'published',
                'kategori_id' => 4, // Pembangunan
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kegiatan Posyandu',
                'deskripsi' => 'Pemeriksaan kesehatan balita rutin bulanan',
                'gambar' => 'foto5.jpg',
                'status' => 'published',
                'kategori_id' => 1, // Kegiatan Desa
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Kerja Bakti Mingguan',
                'deskripsi' => 'Bersama membersihkan lingkungan desa',
                'gambar' => 'foto6.jpg',
                'status' => 'published',
                'kategori_id' => 2, // Gotong Royong
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Upacara Adat Panen',
                'deskripsi' => 'Syukuran panen raya tahunan',
                'gambar' => 'foto7.jpg',
                'status' => 'published',
                'kategori_id' => 3, // Budaya
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Renovasi Balai Desa',
                'deskripsi' => 'Perbaikan dan peningkatan fasilitas balai desa',
                'gambar' => 'foto8.jpg',
                'status' => 'published',
                'kategori_id' => 4, // Pembangunan
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pelatihan Keterampilan',
                'deskripsi' => 'Program pelatihan untuk warga desa',
                'gambar' => 'foto9.jpg',
                'status' => 'published',
                'kategori_id' => 1, // Kegiatan Desa
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert galeri
        GaleriModel::insert($galeri);
    }
}
