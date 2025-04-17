<?php

namespace Database\Seeders;

use App\Models\SubSuratTypeModel;
use App\Models\SuratTypeModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratTypeModel::insert([
            [
                'nama_surat' => 'Surat Keterangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_surat' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_surat' => 'Surat Pengantar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_surat' => 'Surat Izin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        SubSuratTypeModel::insert([
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Domisili Masyarakat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Wali Murid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Penghasilan Orang Tua',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Beda Nama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Domisili Lembaga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Tidak Dalam Sengketa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan Taksir Tanah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 1,
                'nama_sub_surat' => 'Surat Keterangan KKS Perbaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 2,
                'nama_sub_surat' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 2,
                'nama_sub_surat' => 'Surat Keterangan Tidak Mampu Sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 2,
                'nama_sub_surat' => 'Surat Keterangan Tidak Mampu BPJS/PBI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 3,
                'nama_sub_surat' => 'Surat Pengantar RT/RW',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 3,
                'nama_sub_surat' => 'Surat Pengantar KTP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'surat_type_id' => 4,
                'nama_sub_surat' => 'Surat Izin Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
