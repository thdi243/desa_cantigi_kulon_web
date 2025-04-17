<?php

namespace App\Http\Controllers;

use App\Models\GaleriModel;
use Illuminate\Http\Request;
use App\Models\KategoriGaleriModel;
use Illuminate\Support\Facades\Log;

class GaleriController extends Controller
{
    public function index()
    {
        try {
            // Ambil semua kategori untuk filter
            $kategori = KategoriGaleriModel::all();

            // Ambil semua galeri yang aktif
            $galeri = GaleriModel::where('status', 'published')
                ->with('kategori') // Load relasi kategori
                ->latest('created_at')
                ->get();

            // Tampilkan halaman galeri dengan data
            return view('pages.galeri_desa.index', [
                'galeri' => $galeri,
                'kategori' => $kategori
            ]);
        } catch (\Exception $e) {
            Log::error('Error menampilkan galeri: ' . $e->getMessage());

            return view('pages.galeri_desa.index', [
                'galeri' => collect(),
                'kategori' => collect()
            ])->with('error', 'Terjadi kesalahan saat mengambil data galeri');
        }
    }
}
