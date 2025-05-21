<?php

namespace App\Http\Controllers;

use App\Models\GaleriModel;
use Illuminate\Http\Request;
use App\Models\KabarDesaModel;
use App\Models\SuratTypeModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Cek jika user sudah login dan role_id adalah 1, redirect ke login
        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect('/admin');
        }

        $suratTypes = SuratTypeModel::all();

        $kabarDesa = KabarDesaModel::where('status', 'published')
            ->latest('tgl_publish')
            ->take(3)
            ->get();

        $galeri = GaleriModel::where('status', 'published')
            ->latest('created_at')
            ->take(6)
            ->get();

        $suratTypes->transform(function ($item) {
            switch ($item->id) {
                case 1:
                    $item->bg_color = '#FFF48D';
                    $item->text_color = '#C6B72B';
                    $item->icon = 'uil-file-info-alt';
                    $item->description = 'Layanan pembuatan berbagai surat keterangan untuk keperluan administratif masyarakat desa';
                    $item->route = route('surat.create', ['surat_type_id' => $item->id]);
                    break;
                case 2:
                    $item->bg_color = '#FFB2B2';
                    $item->text_color = '#C62B2B';
                    $item->icon = 'uil-file-alt';
                    $item->description = 'Layanan pembuatan surat keterangan tidak mampu untuk keperluan daftar sekolah atau lainnya.';
                    $item->route = route('surat.create', ['surat_type_id' => $item->id]);
                    break;
                case 3:
                    $item->bg_color = '#B2E0FF';
                    $item->text_color = '#2B7CC6';
                    $item->icon = 'uil-document-info';
                    $item->description = 'Layanan pembuatan berbagai surat pengantar untuk keperluan perizinan atau semacamnya bagi masyarakat desa.';
                    $item->route = route('surat.create', ['surat_type_id' => $item->id]);
                    break;
                // case 4:
                //     $item->icon = 'Surat Izin';
                //     $item->description = 'Surat Izin';
                //     break;
                default:
                    $item->icon = 'Surat Masuk';
                    $item->description = 'Surat Keterangan';
                    break;
            }

            return $item;
        });

        return view('home', compact('suratTypes', 'kabarDesa', 'galeri'));
    }

    // private function getKabarDesa()
    // {
    //     $query = KabarDesaModel::query()->where('status', 'published');

    //     $berita = $query->latest('tgl_publish')->paginate(9);

    //     // Modifikasi tanggal publish untuk format tampilan
    //     $berita->getCollection()->transform(function ($item) {
    //         $item->tanggal = \Carbon\Carbon::parse($item->tgl_publish);
    //         return $item;
    //     });

    //     return $berita;
    // }
}
