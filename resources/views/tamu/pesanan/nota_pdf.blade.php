<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .nota-container {
            background: #fff;
            max-width: 700px;
            margin: auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            height: 60px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 26px;
            color: #2c3e50;
        }

        .info-section {
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .info-section p {
            margin: 6px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #f1f1f1;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .highlight {
            font-weight: bold;
            color: #007bff;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="nota-container">
        <div class="header">
            <img src="{{ public_path('assets/img/inoventa.png') }}" alt="Logo">
            <h2>Nota Pemesanan</h2>
        </div>

        <div class="info-section">
            <p><strong>Kode Pesanan:</strong> <span class="highlight">{{ $pesanan->code_pemesanan }}</span></p>
            <p><strong>Nama Pelanggan:</strong> {{ $pesanan->nama }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y') }}</p>
        </div>

        <table>
            <tr>
                <th>Produk</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>{{ $pesanan->produk }}</td>
                <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                <td>{{ $pesanan->status }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Terima kasih telah memesan produk kami.</p>
            <p><strong>UMKM Jajanan Rakyat</strong></p>
        </div>
    </div>

</body>
</html>
