{{-- resources/views/pdfs/surat-template.blade.php --}}
<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $surat->data_surat['jenis_surat'] ?? 'Surat Keterangan' }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.5;
                margin: 0;
                padding: 20px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header h1,
            .header h2,
            .header h3 {
                margin: 0;
                text-transform: uppercase;
            }

            .header h1 {
                font-size: 18px;
                margin: 5px 0;
            }

            .header h2 {
                font-size: 16px;
            }

            .header h3 {
                font-size: 14px;
            }

            .divider {
                border-bottom: 2px solid black;
                margin: 10px 0;
            }

            .letter-number {
                display: flex;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            .letter-title {
                text-align: center;
                font-weight: bold;
                font-size: 14px;
                margin: 20px 0;
                text-transform: uppercase;
            }

            .content {
                margin-bottom: 20px;
            }

            .indent {
                margin-left: 40px;
            }

            table.info {
                width: 100%;
            }

            table.info td {
                padding: 2px 0;
                vertical-align: top;
            }

            table.info td:first-child {
                width: 120px;
            }

            .signature {
                margin-top: 40px;
                text-align: right;
                float: right;
                width: 40%;
            }

            .signature-name {
                margin-top: 60px;
                font-weight: bold;
                text-decoration: underline;
            }
        </style>
    </head>

    <body>


        <div class="header">
            <h2>PEMERINTAH KABUPATEN/KOTA</h2>
            <h3>KECAMATAN {{ $surat->data_surat['nama_kecamatan'] ?? 'NAMA KECAMATAN' }}</h3>
            <h1>KELURAHAN/DESA {{ $surat->data_surat['nama_desa'] ?? 'NAMA DESA' }}</h1>
            <p>Alamat: Jl. {{ $surat->data_surat['alamat_kantor'] ?? '______' }} No.
                {{ $surat->data_surat['nomor_kantor'] ?? '__' }}, Kode Pos:
                {{ $surat->data_surat['kode_pos'] ?? '_____' }}
            </p>
            <div class="divider"></div>
        </div>

        <div class="letter-number">
            <div>Nomor: {{ $surat->nomor_surat ?? 'Tidak Tersedia' }}</div>
            <div>{{ \Carbon\Carbon::parse($surat->tgl_surat ?? now())->isoFormat('D MMMM Y') }}</div>
        </div>
        <div>Perihal: {{ $surat->data_surat['jenis_surat'] ?? 'Surat Keterangan' }}</div>

        <div class="letter-title">
            {{ strtoupper($surat->data_surat['jenis_surat'] ?? 'SURAT KETERANGAN') }}
        </div>

        <div class="content">
            <p>Yang bertanda tangan di bawah ini:</p>

            <div class="indent">
                <table class="info">
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $surat->data_surat['nama_penandatangan'] ?? 'Kepala Desa' }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: {{ $surat->data_surat['jabatan_penandatangan'] ?? 'Kepala Desa' }}</td>
                    </tr>
                </table>
            </div>

            <p>Dengan ini menerangkan bahwa:</p>

            <div class="indent">
                <table class="info">
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $surat->data_pemohon['nama_lengkap_pemohon'] ?? 'Tidak Tersedia' }}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>: {{ $surat->data_pemohon['nik_pemohon'] ?? 'Tidak Tersedia' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tgl Lahir</td>
                        <td>: {{ $surat->data_pemohon['tempat_lahir_pemohon'] ?? 'Tidak Tersedia' }},
                            {{-- {{ $surat->data_pemohon['tgl_lahir_pemohon'] ? \Carbon\Carbon::parse($surat->data_pemohon['tgl_lahir_pemohon'])->isoFormat('D MMMM Y') : 'Tidak Tersedia' }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        {{-- <td>: {{ $surat->data_pemohon['jenis_kelamin_pemohon'] ?? 'Tidak Tersedia' }}</td> --}}
                    </tr>
                    <tr>
                        <td>Agama</td>
                        {{-- <td>: {{ $surat->data_pemohon['agama_pemohon'] ?? 'Tidak Tersedia' }}</td> --}}
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        {{-- <td>: {{ $surat->data_pemohon['pekerjaan_pemohon'] ?? 'Tidak Tersedia' }}</td> --}}
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        {{-- <td>: {{ $surat->data_pemohon['alamat_pemohon'] ?? 'Tidak Tersedia' }}</td> --}}
                    </tr>
                </table>
            </div>

            <p>Adalah benar warga {{ $surat->data_surat['nama_desa'] ?? 'Desa/Kelurahan' }} yang bermaksud untuk
                {{ $surat->data_pemohon['keperluan_pemohon'] ?? 'Tidak Tersedia' }}.</p>

            <p>{{ $surat->data_surat['isi_surat'] ?? 'Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.' }}
            </p>
        </div>

        <div class="signature">
            <p>{{ $surat->data_surat['tempat_penandatanganan'] ?? 'Tempat' }},
                {{ \Carbon\Carbon::parse($surat->tgl_surat ?? now())->isoFormat('D MMMM Y') }}</p>
            <p>{{ $surat->data_surat['jabatan_penandatangan'] ?? 'Kepala Desa' }}</p>
            <div class="signature-name">{{ $surat->data_surat['nama_penandatangan'] ?? '.........................' }}
            </div>
            @if (isset($surat->data_surat['nip_penandatangan']))
                <p>NIP: {{ $surat->data_surat['nip_penandatangan'] }}</p>
            @endif
        </div>
    </body>

</html>
