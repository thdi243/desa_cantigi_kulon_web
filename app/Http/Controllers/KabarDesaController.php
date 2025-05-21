<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\KabarDesaModel;
use App\Models\KategoriBeritaModel;
use Illuminate\Support\Facades\Log;

class KabarDesaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = KategoriBeritaModel::all();

        // Siapkan query dasar
        $query = KabarDesaModel::query()->where('status', 'published');

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('ringkasan', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && !empty($request->kategori) && $request->kategori != 'all') {
            $query->where('kategori_id', $request->kategori);
        }

        // Ambil berita dengan pagination
        $berita = $query->latest('tgl_publish')->paginate(9);

        // Modifikasi tanggal publish untuk format tampilan
        $berita->getCollection()->transform(function ($item) {
            $item->tanggal = \Carbon\Carbon::parse($item->tgl_publish);
            return $item;
        });

        // Kembalikan ke view dengan data
        return view('pages.kabar_desa.index', [
            'berita' => $berita,
            'kategori' => $kategori
        ]);
    }

    // public function getKabarDesa(Request $request)
    // {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'search' => 'nullable|string|max:255',
    //             'kategori' => 'nullable|integer|exists:kategori,id',
    //         ]);

    //         // Ambil semua berita
    //         $query = KabarDesaModel::query();

    //         // Filter berdasarkan pencarian
    //         if ($request->has('search')) {
    //             $query->where('judul', 'like', '%' . $request->search . '%')
    //                 ->orWhere('ringkasan', 'like', '%' . $request->search . '%');
    //         }

    //         // Filter berdasarkan kategori (opsional)
    //         if ($request->has('kategori')) {
    //             $query->where('kategori', $request->kategori);
    //         }

    //         // Ambil berita dengan pagination
    //         $berita = $query->latest()->paginate(9);



    //         return $berita;
    //         // return response()->json([
    //         //     'status' => 'success',
    //         //     'data' => $berita,
    //         // ]);
    //     } catch (\Exception $e) {
    //         Log::error('Error storing pengaduan: ' . $e->getMessage());
    //         // return response()->json([
    //         //     'status' => 'error',
    //         //     'message' => $e->getMessage(),
    //         // ], 422);
    //     }
    // }

    public function detail($id)
    {
        try {
            // Cari berita berdasarkan ID
            $artikel = KabarDesaModel::findOrFail($id);

            // Buat properti tanggal untuk tampilan
            $artikel->tanggal = \Carbon\Carbon::parse($artikel->tgl_publish);

            // Ambil berita terkait dengan kategori yang sama
            $beritaTerkait = KabarDesaModel::where('kategori_id', $artikel->kategori_id)
                ->where('id', '!=', $artikel->id)
                ->where('status', 'published')
                ->latest('tgl_publish')
                ->limit(3)
                ->get();

            return view('pages.kabar_desa.detail', [
                'artikel' => $artikel,
                'beritaTerkait' => $beritaTerkait,
            ]);
        } catch (\Exception $e) {
            Log::error('Error menampilkan detail berita: ' . $e->getMessage());
            return redirect()->route('kabar-desa.index')
                ->with('error', 'Berita tidak ditemukan');
        }
    }
}
