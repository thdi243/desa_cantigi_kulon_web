<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaduanModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    // create pengaduan
    public function create()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('pages.pengaduan.create');
    }

    // store pengaduan
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'numeric', 'digits:16'],
                'category' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1000'],
                'location' => ['required', 'string', 'max:255'],
                'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ],
            [
                'nik.digits' => 'NIK harus tepat 16 digit.',
                'image.max' => 'Ukuran foto maksimal 2MB.',
                'image.mimes' => 'Format foto harus jpeg, png, jpg',
            ]
        );

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        try {
            // store pengaduan
            $photoPath = $request->file('image')->store('photos', 'public');

            PengaduanModel::create([
                'name' => $request['name'],
                'nik' => $request->input('nik'),
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'photo' => $photoPath,
                'status' => 'pending',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('pengaduan.success');
        } catch (\Exception $e) {
            Log::error('Error storing pengaduan: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }

    // render error db transaction

    // public function render(Request $request)
    // {
    //     return response()->json([
    //         'error' => 'Unauthorized',
    //     ], 401);
    // }

    // success pengaduan
    public function success()
    {
        return view('pages.pengaduan.success');
    }
}
