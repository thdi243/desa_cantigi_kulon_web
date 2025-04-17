<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratTypeModel;
use App\Models\SubSuratTypeModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\SuratModel as Surat;
use App\Models\User;

use function Ramsey\Uuid\v1;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil ID jenis surat dari request, default ke 1 jika tidak ada
        $suratTypeId = $request->input('surat_type_id', 1);

        // Ambil jenis surat berdasarkan ID
        $suratType = SuratTypeModel::find($suratTypeId);

        // Ambil semua jenis surat (untuk dropdown jika diperlukan)
        $suratTypes = SuratTypeModel::all();

        // Ambil sub-jenis surat berdasarkan ID surat yang dipilih
        $suratSubTypes = SubSuratTypeModel::where('surat_type_id', $suratTypeId)->get();

        return view('pages.pengajuan_surat.create', compact('suratSubTypes', 'suratType'));
    }

    public function getFields($id)
    {
        $suratType = SubSuratTypeModel::findOrFail($id);

        // Struktur data yang akan dikirimkan ke frontend
        $responseData = [
            'success' => true,
            'data' => [
                'nama_surat' => $suratType->nama_sub_surat,
                'fields' => $this->getFieldsForSuratType($id)
            ]
        ];

        return response()->json($responseData);
    }

    private function getFieldsForSuratType($suratTypeId)
    {
        // Ini bisa diubah sesuai dengan logika bisnis Anda
        // Misalnya bisa diambil dari database atau didefinisikan statis

        $fields = [];

        // Contoh penentuan field berdasarkan surat type ID
        switch ($suratTypeId) {
            case 1: // Surat Keterangan Domisili Masyarakat
                $fields = [
                    [
                        'name' => 'blok',
                        'label' => 'Blok',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'name' => 'rt',
                        'label' => 'RT',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'name' => 'rw',
                        'label' => 'RW',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'name' => 'desa',
                        'label' => 'Desa',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'name' => 'kecamatan',
                        'label' => 'Kecamatan',
                        'type' => 'text',
                        'required' => true,
                    ],
                    [
                        'name' => 'kabupaten',
                        'label' => 'Kabupaten',
                        'type' => 'text',
                        'required' => true,
                    ],
                ];
                break;

            case 2: // Surat Keterangan Wali Murid
                $fields = [
                    [
                        'name' => 'nik',
                        'label' => 'NIK',
                        'type' => 'number',
                        'required' => true,
                        'placeholder' => 'Masukkan NIK'
                    ],
                    [
                        'name' => 'nama',
                        'label' => 'Nama Lengkap',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan nama lengkap'
                    ],
                    [
                        'name' => 'tempat_lahir',
                        'label' => 'Tempat Lahir',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan tempat lahir'
                    ],
                    [
                        'name' => 'tanggal_lahir',
                        'label' => 'Tanggal Lahir',
                        'type' => 'date',
                        'required' => true
                    ],
                    [
                        'name' => 'jenis_kelamin',
                        'label' => 'Jenis Kelamin',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            ['value' => 'L', 'label' => 'Laki-laki'],
                            ['value' => 'P', 'label' => 'Perempuan']
                        ]
                    ],
                    [
                        'name' => 'pekerjaan',
                        'label' => 'Pekerjaan',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan pekerjaan'
                    ],
                    [
                        'name' => 'alamat',
                        'label' => 'Alamat',
                        'type' => 'textarea',
                        'required' => true,
                        'placeholder' => 'Masukkan alamat lengkap'
                    ],
                    [
                        'name' => 'hubungan_keluarga',
                        'label' => 'Hubungan Keluarga',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan hubungan keluarga'
                    ]
                ];
                break;

            case 3: // Surat Keterangan Penghasilan Orang Tua
                $fields = [
                    [
                        'name' => 'nik',
                        'label' => 'NIK',
                        'type' => 'number',
                        'required' => true,
                        'placeholder' => 'Masukkan NIK'
                    ],
                    [
                        'name' => 'nama',
                        'label' => 'Nama Lengkap',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan nama lengkap'
                    ],
                    [
                        'name' => 'tempat_lahir',
                        'label' => 'Tempat Lahir',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan tempat lahir'
                    ],
                    [
                        'name' => 'tanggal_lahir',
                        'label' => 'Tanggal Lahir',
                        'type' => 'date',
                        'required' => true
                    ],
                    [
                        'name' => 'jenis_kelamin',
                        'label' => 'Jenis Kelamin',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            ['value' => 'L', 'label' => 'Laki-laki'],
                            ['value' => 'P', 'label' => 'Perempuan']
                        ]
                    ],
                    [
                        'name' => 'pekerjaan',
                        'label' => 'Pekerjaan',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan pekerjaan'
                    ],
                    [
                        'name' => 'penghasilan',
                        'label' => 'Penghasilan per Bulan',
                        'type' => 'number',
                        'required' => true,
                        'placeholder' => 'Masukkan penghasilan per bulan (Rp)',
                        'min' => 0
                    ],
                    [
                        'name' => 'alamat',
                        'label' => 'Alamat',
                        'type' => 'textarea',
                        'required' => true,
                        'placeholder' => 'Masukkan alamat lengkap'
                    ],
                ];
                break;

            case 4: // Surat Keterangan Beda Nama
                $fields = [
                    [
                        'name' => 'nik',
                        'label' => 'NIK',
                        'type' => 'number',
                        'required' => true,
                        'placeholder' => 'Masukkan NIK'
                    ],
                    [
                        'name' => 'nama_sebelumnya',
                        'label' => 'Nama Sebelumnya',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan nama sebelumnya'
                    ],
                    [
                        'name' => 'nama_seharusnya',
                        'label' => 'Nama Seharusnya',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan nama seharusnya'
                    ],
                    [
                        'name' => 'tempat_lahir',
                        'label' => 'Tempat Lahir',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan tempat lahir'
                    ],
                    [
                        'name' => 'tanggal_lahir',
                        'label' => 'Tanggal Lahir',
                        'type' => 'date',
                        'required' => true
                    ],
                    [
                        'name' => 'jenis_kelamin',
                        'label' => 'Jenis Kelamin',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            ['value' => 'L', 'label' => 'Laki-laki'],
                            ['value' => 'P', 'label' => 'Perempuan']
                        ]
                    ],
                    [
                        'name' => 'ibu_kandung',
                        'label' => 'Ibu Kandung',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan ibu kandung'
                    ],
                    [
                        'name' => 'keperluan',
                        'label' => 'Keperluan',
                        'type' => 'textarea',
                        'required' => true,
                        'placeholder' => 'Jelaskan keperluan pembuatan surat'
                    ]

                ];
                break;

            case 5: // Surat Keterangan Kematian
                $fields = [
                    [
                        'name' => 'nama_almarhum',
                        'label' => 'Nama Almarhum/Almarhumah',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan nama almarhum/almarhumah'
                    ],
                    [
                        'name' => 'jenis_kelamin_almarhum',
                        'label' => 'Jenis Kelamin Almarhum/Almarhumah',
                        'type' => 'radio',
                        'required' => true,
                        'options' => [
                            ['value' => 'laki-laki', 'label' => 'Laki-laki'],
                            ['value' => 'perempuan', 'label' => 'Perempuan']
                        ]
                    ],
                    [
                        'name' => 'umur_almarhum',
                        'label' => 'Umur Almarhum/Almarhumah',
                        'type' => 'number',
                        'required' => true,
                        'placeholder' => 'Masukkan umur almarhum/almarhumah',
                        'min' => 0
                    ],
                    [
                        'name' => 'tanggal_meninggal',
                        'label' => 'Tanggal Meninggal',
                        'type' => 'date',
                        'required' => true
                    ],
                    [
                        'name' => 'tempat_meninggal',
                        'label' => 'Tempat Meninggal',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => 'Masukkan tempat meninggal'
                    ],
                    [
                        'name' => 'sebab_meninggal',
                        'label' => 'Sebab Meninggal',
                        'type' => 'textarea',
                        'required' => true,
                        'placeholder' => 'Masukkan sebab meninggal'
                    ],
                    [
                        'name' => 'hubungan_pelapor',
                        'label' => 'Hubungan dengan Pelapor',
                        'type' => 'select',
                        'required' => true,
                        'options' => [
                            ['value' => 'anak', 'label' => 'Anak'],
                            ['value' => 'pasangan', 'label' => 'Suami/Istri'],
                            ['value' => 'orang_tua', 'label' => 'Orang Tua'],
                            ['value' => 'saudara', 'label' => 'Saudara'],
                            ['value' => 'lainnya', 'label' => 'Lainnya']
                        ]
                    ]
                ];
                break;

            // Tambahkan case untuk jenis surat lainnya sesuai kebutuhan

            default:
                $fields = [
                    [
                        'name' => 'keperluan',
                        'label' => 'Keperluan',
                        'type' => 'textarea',
                        'required' => true,
                        'placeholder' => 'Jelaskan keperluan pembuatan surat'
                    ]
                ];
                break;
        }

        return $fields;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil jenis surat dari request
        $jenisSurat = $request->input('jenis_surat');

        // Validasi data yang diterima
        $baseRules = [
            'jenis_surat' => ['required', 'integer'],
            'nik' => ['required', 'numeric', 'digits:16'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat' => ['required', 'string', 'max:255'],
            'agama' => ['required', 'string', 'max:255'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'keperluan' => ['required', 'string'],
        ];

        // Ambil aturan validasi dinamis
        $dynamicRules = $this->getDynamicValidation($jenisSurat);

        // Gabungkan aturan validasi
        $rules = array_merge($baseRules, $dynamicRules);

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Ambil semua input dari form
            $allInputs = $request->except(['_token', '_method']);

            // Data dasar yang akan disimpan ke data_pemohon
            $baseFields = [
                'jenis_surat',
                'nik',
                'nama_lengkap',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'agama',
                'pekerjaan',
                'keperluan',
            ];

            // Pisahkan data_pemohon dan data_surat
            $dataPemohon = [];
            $dataSurat = [];
            foreach ($allInputs as $key => $value) {
                if (in_array($key, $baseFields)) {
                    $dataPemohon[$key] = $value;
                } else {
                    $dataSurat[$key] = $value;
                }
            }

            // Buat objek Surat baru
            $surat = new Surat();
            $surat->sub_surat_type_id = $request->jenis_surat;

            // Simpan data_pemohon dan data_surat dalam format JSON
            $surat->data_pemohon = json_encode($dataPemohon);
            $surat->data_surat = !empty($dataSurat) ? json_encode($dataSurat) : null;

            // Status awal adalah 'pending'
            $surat->status = 'pending';

            // Tambahkan user_id dari pengguna yang sedang login
            $surat->user_id = Auth::id();

            // Simpan surat ke database
            $surat->save();

            return view('pages.pengajuan_surat.success', [
                'message' => 'Pengajuan surat berhasil dikirim. Silakan tunggu konfirmasi dari admin.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pengajuan surat: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }

    // dynamic validation
    private function getDynamicValidation($suratTypeId)
    {
        $fields = $this->getFieldsForSuratType($suratTypeId);

        $dynamicRules = [];

        foreach ($fields as $field) {
            $rules = [];

            // Aturan wajib untuk field yang required
            if ($field['required'] ?? false) {
                $rules[] = 'required';
            }

            // Validasi berdasarkan tipe field
            switch ($field['type']) {
                case 'text':
                    $rules[] = 'string';
                    $rules[] = 'max:255';
                    break;

                case 'textarea':
                    $rules[] = 'string';
                    $rules[] = 'max:1000';
                    break;

                case 'number':
                    $rules[] = 'numeric';

                    // Tambahkan validasi min jika ada
                    if (isset($field['min'])) {
                        $rules[] = 'min:' . $field['min'];
                    }
                    break;

                case 'date':
                    $rules[] = 'date';
                    break;

                case 'select':
                    // Jika ada opsi yang ditentukan, validasi dengan in
                    if (isset($field['options'])) {
                        $options = collect($field['options'])->pluck('value')->implode(',');
                        $rules[] = 'in:' . $options;
                    }
                    break;

                case 'radio':
                    // Serupa dengan select
                    if (isset($field['options'])) {
                        $options = collect($field['options'])->pluck('value')->implode(',');
                        $rules[] = 'in:' . $options;
                    }
                    break;
            }

            // Tambahkan aturan khusus untuk field tertentu
            switch ($field['name']) {
                case 'nik':
                    $rules[] = 'digits:16';
                    break;
            }

            // Simpan aturan untuk field ini
            $dynamicRules[$field['name']] = $rules;
        }

        return $dynamicRules;
    }

    // Menampilkan halaman sukses setelah pengajuan surat
    // public function success()
    // {
    //     return view('pages.pengajuan_surat.success');
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
