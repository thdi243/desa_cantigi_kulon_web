{{-- resources/views/filament/resources/req-surat/templates/template_surat.blade.php --}}
<div class="p-4 bg-white rounded shadow dark:text-gray-800">
    <div class="kop-surat text-center border-b-2 border-gray-800 pb-2 mb-2 relative">
        <div class="kop-logo absolute left-6 top-2 ">
            {{-- Logo Desa --}}
            @if (isset($record->desa) && $record->desa->logo)
                <img src="{{ Storage::url($record->desa->logo) }}" alt="Logo Desa" class="w-24 h-24">
            @else
                <img src="{{ asset('images/logo/darma-ayu-logo.png') }}" alt="Logo Desa" class="w-24 h-24"
                    style="width: 60px; ">
            @endif
        </div>
        <p class="kop-title text-sm font-bold m-0">PEMERINTAH KABUPATEN INDRAMAYU</p>
        <p class="kop-title text-sm font-bold m-0">KECAMATAN CANTIGI</p>
        <p class="kop-title text-sm font-bold mb-2">KANTOR DESA CANTIGI KULON</p>
        <p class="kop-address my-1" style="font-size: 10px">Jl. Raya Cantigi Kulon No. 270 Kecamatan Cantigi
            Kabupaten Indramayu Kode
            Pos : 45251</p>
        <p class="kop-address my-1" style="font-size: 10px">Email : pemdescantigikulon@gmail.com Home Page :
            www.cantigikulon.com</p>
    </div>

    <div class="line text-center mb-2">
        <hr class="border-x-15 border-gray-900 mb-2"
            style="margin: 0; height: 3px; width: 100%; border-top-width: 2px; border-color: #414141;">
    </div>

    <div class="header text-center mb-4">
        <div class="title text-xs font-bold underline mt-4 mb-1" style="text-transform: uppercase">
            {{ $record->subSuratType->suratType->nama_surat ?? 'SURAT KETERANGAN' }}
        </div>
        <div class="nomor text-xs">{{ $record->nomor_surat ?? 'Nomor: -' }}</div>
    </div>

    <div class="content text-justify text-xs">
        <p class="mb-2">Yang bertandatangan dibawah ini Kuwu Desa Cantigi Kulon Kecamatan Cantigi Kabupaten Indramayu
            :</p>

        <div class="identity my-4 text-xs">
            <div class="flex mb-1">
                <div class="w-32">Nama</div>
                <div class="w-4">:</div>
                <div class="font-bold">CHAEROTUNNISA, S.Pd.I.</div>
            </div>
            <div class="flex mb-1 text-xs">
                <div class="w-32">Jabatan</div>
                <div class="w-4">:</div>
                <div>Kuwu Desa Cantigi Kulon</div>
            </div>
        </div>

        <p class="mb-2">Menerangkan dengan sesungguhnya :</p>

        <div class="identity my-4 text-xs">
            <div class="flex mb-1">
                <div class="w-32">Nama</div>
                <div class="w-4">:</div>
                <div class="font-bold uppercase">{{ $record->data_pemohon['nama_lengkap_pemohon'] ?? '-' }}</div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">NIK</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_pemohon['nik_pemohon'] ?? '-' }}</div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Tempat/ tanggal lahir</div>
                <div class="w-4">:</div>
                <div>
                    @if (isset($record->data_pemohon['tempat_lahir_pemohon']) && isset($record->data_pemohon['tgl_lahir_pemohon']))
                        {{ ucfirst($record->data_pemohon['tempat_lahir_pemohon']) . '/' . $record->data_pemohon['tgl_lahir_pemohon'] }}
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Jenis kelamin</div>
                <div class="w-4">:</div>
                <div>
                    @if (isset($record->data_pemohon['jenis_kelamin_pemohon']))
                        {{ $record->data_pemohon['jenis_kelamin_pemohon'] == 'L'
                            ? 'Laki-laki'
                            : ($record->data_pemohon['jenis_kelamin_pemohon'] == 'P'
                                ? 'Perempuan'
                                : '-') }}
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Pekerjaan</div>
                <div class="w-4">:</div>
                <div>
                    {{ isset($record->data_pemohon['pekerjaan_pemohon']) ? ucfirst($record->data_pemohon['pekerjaan_pemohon']) : '-' }}
                </div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Alamat</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_pemohon['alamat_pemohon'] ?? '-' }}</div>
            </div>
        </div>

        <p class="mb-2 text-xs">Bahwa benar nama tersebut diatas merupakan warga Desa Toboali Kecamatan Toboali
            Kabupaten
            Bangka Selatan yang sekarang bertempat tinggal dan atau berdomisili di :</p>

        <div class="identity my-4 text-xs">
            <div class="flex mb-1">
                <div class="w-32">Blok</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_surat['blok'] ?? '-' }}</div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">RT/RW</div>
                <div class="w-4">:</div>
                <div>
                    @if (isset($record->data_surat['rt']) && isset($record->data_surat['rw']))
                        {{ $record->data_surat['rt'] . '/' . $record->data_surat['rw'] }}
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Desa</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_surat['desa'] ?? '-' }}</div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Kecamatan</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_surat['kecamatan'] ?? '-' }}</div>
            </div>
            <div class="flex mb-1">
                <div class="w-32">Kabupaten</div>
                <div class="w-4">:</div>
                <div>{{ $record->data_surat['kabupaten'] ?? '-' }}</div>
            </div>
        </div>
    </div>

    <p class="pl-8 mb-4 text-xs">Demikian surat keterangan ini dibuat dengan sebenarnya, untuk dapat digunakan
        sebagaimana
        mestinya oleh yang bersangkutan.</p>

    <div class="float-left w-2/5 text-right text-xs">
        <p class="mb-6">
            Cantigi Kulon,
            @if (isset($record->tgl_surat))
                {{ \Carbon\Carbon::parse($record->tgl_surat)->locale('id')->isoFormat('D MMMM YYYY') }}
            @else
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY') }}
            @endif
            <br>
            Kuwu Cantigi Kulon,
        </p>
        <div class="font-bold underline" style="margin-top: 3.5rem">CHAEROTUNNISA, S.Pd.I.</div>
    </div>
    <div class="clear-both"></div>
</div>
