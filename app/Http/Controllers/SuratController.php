<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SuratModel;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Models\SuratTypeModel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SubSuratTypeModel;
use App\Models\SuratModel as Surat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SuratController extends Controller
{

    use AuthorizesRequests;
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
        } elseif (Auth::user()->role_id !== 2) {
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
        $fields = $this->getFieldsForSuratType($id);


        // Struktur data yang akan dikirimkan ke frontend
        $responseData = [
            'success' => true,
            'data' => [
                'nama_surat' => $suratType->nama_sub_surat,
                'fields' => $fields
            ]
        ];

        return response()->json($responseData);
    }

    private function getFieldsForSuratType($suratTypeId)
    {

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
            'nik_pemohon' => ['required', 'numeric', 'digits:16'],
            'nama_lengkap_pemohon' => ['required', 'string', 'max:255'],
            'tempat_lahir_pemohon' => ['required', 'string', 'max:255'],
            'tgl_lahir_pemohon' => ['required', 'date'],
            'jenis_kelamin_pemohon' => ['required', 'in:L,P'],
            'alamat_pemohon' => ['required', 'string', 'max:255'],
            'agama_pemohon' => ['required', 'string', 'max:255'],
            'pekerjaan_pemohon' => ['required', 'string', 'max:255'],
            'keperluan_pemohon' => ['required', 'string'],
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
                'nik_pemohon',
                'nama_lengkap_pemohon',
                'tempat_lahir_pemohon',
                'tgl_lahir_pemohon',
                'jenis_kelamin_pemohon',
                'alamat_pemohon',
                'agama_pemohon',
                'pekerjaan_pemohon',
                'keperluan_pemohon',
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
            $surat->tgl_surat = now()->format('Y-m-d');
            $surat->nomor_surat = 'SURAT/' . now()->format('Y') . '/' . strtoupper(substr($request->nama_lengkap, 0, 3)) . '/' . strtoupper(substr($request->jenis_surat, 0, 3)) . '/' . uniqid();
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
    public function view(Surat $surat)
    {
        // Pastikan pengguna memiliki otorisasi untuk melihat surat
        $this->authorize('view', $surat);

        // Render view template surat
        return view('surat.view', [
            'surat' => $surat,
            // Tambahkan data tambahan yang diperlukan
            'details' => $surat->load(['relatedModels']), // Contoh eager loading
        ]);
    }

    /**
     * Generate dan download PDF surat
     */
    public function print($id)
    {
        // Ambil record surat
        $surat = SuratModel::findOrFail($id);

        // Generate PDF
        $storagePath = 'surat/printed';
        Storage::disk('public')->makeDirectory($storagePath);
        $imagePath = public_path('images/logo/darma-ayu-logo.png');
        $base64Image = 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));

        $pdf = PDF::loadView($this->getTemplateForSubType($surat->sub_surat_type_id), [
            'surat' => $surat,
            'logoBase64' => $base64Image,
        ]);

        // Generate nama file unik
        $filename = $surat->tgl_surat->format('Y-m-d') . '_' . $surat->subSuratType->nama_sub_surat . '_' . $surat->data_pemohon['nama_lengkap_pemohon'] . '.pdf';

        // Simpan di storage public
        $path = $storagePath . '/' . $filename;
        $pdfContent = $pdf->output();
        Storage::disk('public')->put($path, $pdfContent);

        // Generate URL untuk didownload (untuk referensi jika perlu)
        $url = Storage::url($path);

        // Download PDF - ini akan memicu download di browser
        return $pdf->stream($filename);
    }

    private function getTemplateForSubType($subTypeId)
    {

        // Map sub_surat_type_id to the corresponding template
        $templates = [
            1 => 'pdfs.sk_domisili_masyarakat',
            2 => 'pdfs.sk_wali_murid',
            3 => 'pdfs.sk_penghasilan_ortu',
            4 => 'pdfs.sk_beda_nama',
            5 => 'pdfs.sk_domisili_lembaga',
            6 => 'pdfs.sk_tidak_dalam_sengketa',
            7 => 'pdfs.sk_taksir_tanah',
            8 => 'pdfs.sk_kks_perbaikan',
            9 => 'pdfs.sk_tidak_mampu',
            10 => 'pdfs.sk_tidak_mampu_sekolah',
            11 => 'pdfs.sk_tidak_mampu_bpjs',
            12 => 'pdfs.sp_rt_rw',
            13 => 'pdfs.sp_ktp',
            14 => 'pdfs.si_usaha',
            // Add more mappings as needed
        ];

        // Return the mapped template or a default one if not found
        return $templates[$subTypeId] ?? 'pdfs.surat-template';
    }

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
