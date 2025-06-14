<?php

namespace Database\Seeders;

use App\Models\KabarDesaModel;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\KategoriBeritaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriBeritaModel::insert([
            [
                'nama_kategori' => 'Smart People',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Smart Economic',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Smart Environment',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Smart Government',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Smart Living',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kategori' => 'Smart Mobility',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        KabarDesaModel::insert([
            [
                'judul' => 'Waspada Gadget Bisa Berbahaya Jika Menggunakannya sambil di Charger',
                'ringkasan' => 'Penggunaan gadget sambil di charger ternyata bisa membahayakan kesehatan. Simak informasi lebih lanjut.',
                'isi' => 'Artikel ini membahas mengenai bahaya penggunaan gadget yang masih dicolokkan ke charger, yang bisa menyebabkan masalah kesehatan pada tubuh, terutama kulit dan mata.',
                'gambar' => 'gambar-berita-1.jpg',
                'status' => 'published',
                'tgl_publish' => now(),
                'kategori_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Cara Menjaga Kesehatan Mental di Tengah Pandemi',
                'ringkasan' => 'Kesehatan mental menjadi isu penting selama pandemi. Artikel ini memberikan tips untuk menjaga kesehatan mental.',
                'isi' => 'Pandemi COVID-19 telah memberikan dampak besar pada kesehatan mental. Artikel ini memberikan beberapa cara untuk menjaga kesehatan mental seperti meditasi, olahraga, dan menjaga hubungan sosial.',
                'gambar' => 'gambar-berita-2.jpg',
                'status' => 'published',
                'tgl_publish' => now(),
                'kategori_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Inovasi Teknologi dalam Dunia Pendidikan',
                'ringkasan' => 'Teknologi semakin memainkan peran penting dalam pendidikan. Artikel ini mengulas inovasi teknologi terbaru.',
                'isi' => 'Inovasi teknologi telah banyak diterapkan dalam dunia pendidikan, seperti penggunaan aplikasi pembelajaran online, alat bantu interaktif, dan teknologi virtual reality untuk memperkaya pengalaman belajar.',
                'gambar' => 'gambar-berita-3.jpg',
                'status' => 'published',
                'tgl_publish' => now(),
                'kategori_id' => 3,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Makanan Sehat untuk Menjaga Kesehatan Jantung',
                'ringkasan' => 'Pola makan sangat memengaruhi kesehatan jantung. Artikel ini memberikan rekomendasi makanan yang baik untuk jantung.',
                'isi' => 'Makanan yang kaya akan serat, omega-3, dan antioksidan sangat baik untuk kesehatan jantung. Artikel ini memberikan panduan tentang makanan yang harus dikonsumsi untuk menjaga jantung tetap sehat.',
                'gambar' => 'gambar-berita-4.jpg',
                'status' => 'published',
                'tgl_publish' => now(),
                'kategori_id' => 2,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Perubahan Iklim dan Dampaknya Terhadap Kehidupan',
                'ringkasan' => 'Artikel ini membahas dampak perubahan iklim terhadap kehidupan manusia dan ekosistem.',
                'isi' => 'Perubahan iklim memberikan dampak besar terhadap cuaca ekstrem, naiknya permukaan air laut, dan kehidupan manusia secara keseluruhan. Artikel ini mengulas bagaimana perubahan iklim mempengaruhi berbagai aspek kehidupan.',
                'gambar' => 'gambar-berita-5.jpg',
                'status' => 'published',
                'tgl_publish' => now(),
                'kategori_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
