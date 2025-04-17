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
        // var_dump($request->all());
        // die();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'numeric', 'digits:16'],
                'category' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1000'],
                'location' => ['required', 'string', 'max:255'],
                'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ],
            [
                'nik.digits' => 'NIK harus tepat 16 digit.',
                'photo.max' => 'Ukuran foto maksimal 2MB.',
                'photo.mimes' => 'Format foto harus jpeg, png, jpg, gif, atau svg.',
            ]
        );

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        try {
            // store pengaduan
            $photoPath = $request->file('photo')->store('photos', 'public');

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
