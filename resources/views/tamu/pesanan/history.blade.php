<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

    @include('layouts.user.navbar') 

    <div class="container mt-5">
        <h2 class="mb-4">Riwayat Pesanan</h2>

        @if($pesanans->isEmpty())
            <p>Belum ada pesanan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th> <!-- Tambahkan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanans as $pesanan)
                        <tr>
                            <td>{{ $pesanan->code_pemesanan }}</td>
                            <td>{{ $pesanan->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($pesanan->tanggal)->format('Y-m-d') }}</td>
                            <td>{{ $pesanan->produk }}</td>
                            <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                            <td>{{ $pesanan->status }}</td>
                            <td>
                                @if($pesanan->bukti_pembayaran)
                                    <a href="{{ asset($pesanan->bukti_pembayaran) }}" target="_blank">Lihat</a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td>
                                @if($pesanan->status === 'Diterima')
                                    <a href="{{ route('pesanan.downloadNota', $pesanan->id) }}" class="btn btn-sm btn-primary">Download Nota</a>
                                @elseif($pesanan->status === 'Ditolak')
                                    <span class="text-danger">Ditolak</span>
                                @else
                                    <span class="text-muted">Menunggu</span>
                                @endif
                            </td>
                            
                            
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        @endif
    </div>

    @include('layouts.user.footer') 

</body>
</html>
