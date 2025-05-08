<!DOCTYPE html>
<html>

    <head>
        <title>Pemberitahuan Pengaduan</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .email-container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                border: 1px solid #ddd;
                padding: 20px;
            }

            .content {
                margin-bottom: 20px;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #eee;
            }

            h2 {
                color: #2c3e50;
                /* font-size: 22px; */
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .table td {
                padding: 8px;
                border: 1px solid #ddd;
            }

            .table th {
                padding: 10px;
                background-color: #3498db;
                color: white;
            }

            .footer {
                text-align: center;
                font-size: 12px;
                color: #777;
                margin-top: 20px;
                padding-top: 20px;
                border-top: 1px solid #eee;
            }

            .status {
                font-weight: bold;
            }

            .status.pending {
                color: orange;
            }

            .status.process {
                color: blue;
            }

            .status.finished {
                color: green;
            }
        </style>
    </head>

    <body>
        <div class="email-container">
            <h2>Halo {{ ucfirst($name) }},</h2>

            <p>Terima kasih telah mengajukan pengaduan. Berikut adalah rincian pengaduan Anda:</p>

            <div class="content">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $nik }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ ucfirst($category) }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi Pengaduan</th>
                        <td>{{ ucfirst($description) }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td>{{ ucfirst($location) }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td class="status {{ strtolower($status) }}">{{ ucfirst($status) }}</td>
                    </tr>
                </table>
            </div>

            <p>Tim kami akan segera memproses pengaduan Anda.</p>

            <p>Salam,</p>
            <p>Tim Pengaduan</p>

            <div class="footer">
                <p>Email ini dikirim secara otomatis. Mohon untuk tidak membalas email ini.</p>
                <p>&copy; {{ date('Y') }} Pemerintah Desa Cantigi Kulon. All rights
                    reserved.</p>
            </div>
        </div>
    </body>

</html>
