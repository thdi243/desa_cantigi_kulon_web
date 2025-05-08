{{-- resources/views/emails/surat.blade.php --}}
<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $surat->data_surat['jenis_surat'] ?? 'Surat Keterangan' }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                padding: 20px;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
                padding: 20px;
                background-color: #f7f7f7;
                border-bottom: 3px solid #ddd;
            }

            .content {
                margin-bottom: 20px;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #eee;
            }

            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>{{ $surat->subSuratType->nama_sub_surat ?? 'Surat Keterangan' }}</h1>
                <p>Nomor: {{ $surat->nomor_surat }}</p>
            </div>

            <div class="content">
                <p>Kepada Yth,<br>
                    {{ $surat->data_pemohon['nama_lengkap_pemohon'] }}</p>

                <p>Dengan hormat,</p>

                <p>Terlampir kami kirimkan {{ $surat->subSuratType->nama_sub_surat ?? 'Surat Keterangan' }} sesuai
                    dengan permohonan Saudara/i.</p>

                <p>Dokumen ini merupakan dokumen resmi yang dikeluarkan oleh Pemerintah Desa Cantigi Kulon
                    {{ $surat->data_surat['nama_desa'] ?? 'Desa/Kelurahan' }} dan dapat digunakan untuk
                    {{ $surat->data_pemohon['keperluan_pemohon'] ?? 'keperluan Anda' }}.</p>

                <p>Jika ada pertanyaan lebih lanjut, silakan menghubungi kami melalui kontak yang tersedia.</p>

                <p>Hormat kami,<br>
                    Kuwu Desa Cantigi Kulon<br>
                    Chaerotunnisa, S.Pd.I.</p>
            </div>

            <div class="footer">
                <p>Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>
                <p>&copy; {{ date('Y') }} Pemerintah Desa Cantigi Kulon. All rights
                    reserved.</p>
            </div>
        </div>
    </body>

</html>
