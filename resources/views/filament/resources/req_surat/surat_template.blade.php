<div class="bg-white p-8 rounded-lg border border-gray-300 shadow-sm">
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold uppercase">PEMERINTAH KABUPATEN/KOTA</h2>
        <h3 class="text-lg font-bold uppercase">KECAMATAN ______</h3>
        <h1 class="text-2xl font-bold uppercase mt-2">KELURAHAN/DESA ______</h1>
        <p class="text-sm">Alamat: Jl. ______ No. __, Kode Pos: _____</p>
        <div class="border-b-2 border-black my-4"></div>
    </div>

    <div class="mb-4">
        <div class="flex justify-between">
            <div>Nomor: {{ $getRecord()->nomor_surat }}</div>
            <div>{{ \Carbon\Carbon::parse($getRecord()->tgl_surat)->isoFormat('D MMMM Y') }}</div>
        </div>
        <div class="mt-2">
            <div>Perihal: {{ $getRecord()->data_surat['jenis_surat'] ?? 'Surat Keterangan' }}</div>
        </div>
    </div>

    <div class="mb-6">
        <p class="font-bold text-center mb-4 text-lg">
            {{ strtoupper($getRecord()->data_surat['jenis_surat'] ?? 'SURAT KETERANGAN') }}</p>

        <p class="mb-4">Yang bertanda tangan di bawah ini:</p>

        <div class="pl-8 mb-4">
            <table>
                <tr>
                    <td class="pr-4">Nama</td>
                    <td>: {{ $getRecord()->data_surat['nama_penandatangan'] ?? 'Kepala Desa' }}</td>
                </tr>
                <tr>
                    <td class="pr-4">Jabatan</td>
                    <td>: {{ $getRecord()->data_surat['jabatan_penandatangan'] ?? 'Kepala Desa' }}</td>
                </tr>
            </table>
        </div>

        <p class="mb-4">Dengan ini menerangkan bahwa:</p>

        <div class="pl-8 mb-6">
            <table>
                <tr>
                    <td class="pr-4">Nama</td>
                    <td>: {{ $getRecord()->data_pemohon['nama_lengkap_pemohon'] }}</td>
                </tr>
                <tr>
                    <td class="pr-4">NIK</td>
                    <td>: {{ $getRecord()->data_pemohon['nik_pemohon'] }}</td>
                </tr>
                <tr>
                    <td class="pr-4">Tempat, Tgl Lahir</td>
                    <td>: {{ $getRecord()->data_pemohon['tempat_lahir_pemohon'] }},
                        {{-- {{ \Carbon\Carbon::parse($getRecord()->data_pemohon['tgl_lahir_pemohon'])->isoFormat('D MMMM Y') ?? '' }} --}}
                    </td>
                </tr>
                <tr>
                    <td class="pr-4">Jenis Kelamin</td>
                    {{-- <td>: {{ $getRecord()->data_pemohon['jenis_kelamin_pemohon'] }}</td> --}}
                </tr>
                <tr>
                    <td class="pr-4">Agama</td>
                    {{-- <td>: {{ $getRecord()->data_pemohon['agama_pemohon'] }}</td> --}}
                </tr>
                <tr>
                    <td class="pr-4">Pekerjaan</td>
                    {{-- <td>: {{ $getRecord()->data_pemohon['pekerjaan_pemohon'] }}</td> --}}
                </tr>
                <tr>
                    <td class="pr-4">Alamat</td>
                    {{-- <td>: {{ $getRecord()->data_pemohon['alamat_pemohon'] }}</td> --}}
                </tr>
            </table>
        </div>

        <div class="mb-6">
            <p class="mb-2">Adalah benar warga {{ $getRecord()->data_surat['nama_desa'] ?? 'Desa/Kelurahan' }} yang
                {{-- bermaksud untuk {{ $getRecord()->data_pemohon['keperluan_pemohon'] }}.</p> --}}

            <p class="mb-2">
                {{ $getRecord()->data_surat['isi_surat'] ?? 'Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.' }}
            </p>
        </div>
    </div>

    <div class="flex justify-end mt-8">
        <div class="text-center">
            <p>{{ $getRecord()->data_surat['tempat_penandatanganan'] ?? 'Tempat' }},
                {{ \Carbon\Carbon::parse($getRecord()->tgl_surat)->isoFormat('D MMMM Y') }}</p>
            {{-- <p class="mb-16">{{ $getRecord()->data_surat['jabatan_penandatangan'] ?? 'Kepala Desa' }}</p> --}}
            <p class="font-bold underline">
                {{ $getRecord()->data_surat['nama_penandatangan'] ?? '.........................' }}</p>
            @if (isset($getRecord()->data_surat['nip_penandatangan']))
                {{-- <p>NIP: {{ $getRecord()->data_surat['nip_penandatangan'] }}</p> --}}
            @endif
        </div>
    </div>
</div>
