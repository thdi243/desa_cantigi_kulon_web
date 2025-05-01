<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat Keterangan</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 40px;
                line-height: 1.5;
            }

            .kop-surat {
                text-align: center;
                border-bottom: 3px solid black;
                padding-bottom: 10px;
                margin-bottom: 20px;
                position: relative;
            }

            .kop-logo {
                position: absolute;
                left: 0;
                top: 0;
                width: 80px;
                height: 80px;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .kop-logo-text {
                font-size: 20px;
                font-weight: bold;
            }

            .kop-title {
                font-size: 16px;
                font-weight: bold;
                margin: 0;
                line-height: 1.3;
            }

            .kop-address {
                font-size: 12px;
                margin: 5px 0;
            }

            .kop-divider {
                border-bottom: 1px solid black;
                margin: 5px 0;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .title {
                font-size: 18px;
                font-weight: bold;
                text-decoration: underline;
                text-align: center;
                margin: 20px 0;
            }

            .nomor {
                text-align: center;
                margin-bottom: 30px;
            }

            .content {
                text-align: justify;
            }

            .identity {
                margin: 20px 0;
            }

            .identity-row {
                display: flex;
                margin: 5px 0;
            }

            .identity-label {
                width: 150px;
            }

            .identity-colon {
                width: 20px;
            }

            .identity-value {
                flex: 1;
            }

            .bold {
                font-weight: bold;
            }

            .signature {
                margin-top: 40px;
                text-align: right;
                width: 40%;
                float: right;
            }

            .signature-name {
                font-weight: bold;
                margin-top: 80px;
                text-decoration: underline;
            }

            .clear {
                clear: both;
            }
        </style>
    </head>

    <body>
        <div class="kop-surat">
            <div class="kop-logo">
                <div class="kop-logo-text">
                    <img src="{{ asset('images/logo/darma-ayu-logo.png') }}" alt="">
                </div>
            </div>
            <p class="kop-title">PEMERINTAH KABUPATEN INDRAMAYU</p>
            <p class="kop-title">KECAMATAN CANTIGI</p>
            <p class="kop-title">KANTOR DESA CANTIGI KULON</p>
            <br>
            <p class="kop-address">Jl. Raya Cantigi Kulon No. 270 Kecamatan Cantigi Kabupaten Indramayu Kode Pos : 45251
            </p>
            <p class="kop-address">Email : pemdescantigikulon@gmail.com Home Page : www.cantigikulon.com</p>
        </div>

        <div class="header">
            <div class="title">SURAT KETERANGAN</div>
            <div class="nomor">Nomor : {{ $surat->nomor_surat }}</div>
        </div>

        <div class="content">
            <p>Yang bertandatangan dibawah ini Kuwu Desa Cantigi Kulon Kecamatan Cantigi Kabupaten Indramayu :</p>

            <div class="identity">
                <div class="identity-row">
                    <div class="identity-label">Nama</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value bold">CHAEROTUNNISA, S.Pd.I.</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Jabatan</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Kuwu Desa Cantigi Kulon</div>
                </div>
            </div>

            <p>Menerangkan dengan sesungguhnya :</p>

            <div class="identity">
                <div class="identity-row">
                    <div class="identity-label">Nama</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value bold">HERLINA</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">NIK</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">3212176009780001</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Tempat/ tanggal lahir</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Jakarta/ 20-09-1978</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Jenis kelamin</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Perempuan</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Pekerjaan</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Wiraswasta</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Alamat</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Kampung Padang Kubur RT/RW. 003/004 Desa Toboali Kecamatan Toboali
                        Kabupaten Bangka Selatan.</div>
                </div>
            </div>

            <p>Bahwa benar nama tersebut diatas merupakan warga Desa Toboali Kecamatan Toboali Kabupaten Bangka Selatan
                yang sekarang bertempat tinggal dan atau berdomisili di :</p>

            <div class="identity">
                <div class="identity-row">
                    <div class="identity-label">Blok</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Blok Karang Poman</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">RT/RW</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">002/001</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Desa</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Cantigi Kulon</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Kecamatan</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Cantigi</div>
                </div>
                <div class="identity-row">
                    <div class="identity-label">Kabupaten</div>
                    <div class="identity-colon">:</div>
                    <div class="identity-value">Indramayu</div>
                </div>
            </div>

            <p>Demikian surat keterangan ini dibuat dengan sebenarnya, untuk dapat digunakan sebagaimana mestinya oleh
                yang bersangkutan.</p>

            <div class="signature">
                <p>Cantigi Kulon, 15 Januari 2025<br>
                    Kuwu Cantigi Kulon,</p>
                <br><br><br><br>
                <div class="signature-name">CHAEROTUNNISA, S.Pd.I.</div>
            </div>
            <div class="clear"></div>
        </div>
    </body>

</html>
