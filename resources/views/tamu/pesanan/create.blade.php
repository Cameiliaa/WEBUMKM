<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f1f3f5;
        }

        input:focus, select:focus, .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.2);
        }

        .card h3 {
            font-family: 'Segoe UI', sans-serif;
            font-weight: 700;
            color: #0d6efd;
        }

        .card {
            border: 1px solid #dee2e6;
            transition: transform 0.3s ease;
            background: #f8f9fa;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .btn-primary, .btn-success {
            border-radius: 30px;
            font-weight: 600;
        }

        label i {
            margin-right: 6px;
            color: #0d6efd;
        }

        #qris-modal .modal-content {
            border-radius: 1rem;
            padding: 20px;
        }

        #qris-modal .modal-header {
            border-bottom: none;
        }

        #qris-modal .modal-body {
            text-align: center;
        }
    </style>
</head>
<body>

@include('layouts.user.navbar')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-5 p-4">
                <div class="card-body">
                    <h3 class="mb-4 text-center">Buat Pemesanan</h3>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('tamu.pesanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-fill"></i>Nama</label>
                            <input type="text" name="nama" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-calendar-date-fill"></i>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control form-control-lg" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div id="produk-wrapper" class="mb-3">
                            <label class="form-label d-block"><i class="bi bi-box-seam-fill"></i>Produk</label>
                            <div class="produk-item d-flex gap-2 align-items-center mb-2">
                                <select name="produk_id[]" class="form-select form-select-lg produk-select" required onchange="updateHarga()">
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produks as $produk)
                                        <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                                            {{ $produk->nama_produk }} - Rp{{ number_format($produk->harga) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusProduk(this)">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-secondary btn-sm mb-3" onclick="tambahProduk()">
                            <i class="bi bi-plus-circle-fill"></i> Tambah Produk
                        </button>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-cash-coin"></i>Total Harga</label>
                            <input type="text" id="total-harga" class="form-control form-control-lg bg-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-receipt"></i>Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control form-control-lg" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-send-fill"></i> Submit
                            </button>
                            <button type="button" class="btn btn-success px-4 py-2" data-bs-toggle="modal" data-bs-target="#qris-modal">
                                <i class="bi bi-qr-code"></i> Lakukan Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal QRIS --}}
<div class="modal fade" id="qris-modal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100" id="qrisModalLabel">Scan QRIS untuk Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('assets/img/fakeqris.jpg') }}" alt="QRIS" class="img-fluid rounded shadow" style="max-width: 250px;">
      </div>
    </div>
  </div>
</div>

@include('layouts.user.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function tambahProduk() {
        const wrapper = document.getElementById('produk-wrapper');
        const newItem = document.createElement('div');
        newItem.classList.add('produk-item', 'd-flex', 'gap-2', 'align-items-center', 'mb-2');

        newItem.innerHTML = `
            <select name="produk_id[]" class="form-select form-select-lg produk-select" required onchange="updateHarga()">
                <option value="">-- Pilih Produk --</option>
                @foreach($produks as $produk)
                    <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">
                        {{ $produk->nama_produk }} - Rp{{ number_format($produk->harga) }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapusProduk(this)">
                <i class="bi bi-trash-fill"></i>
            </button>
        `;

        wrapper.appendChild(newItem);
    }

    function hapusProduk(button) {
        const item = button.closest('.produk-item');
        item.remove();
        updateHarga();
    }

    function updateHarga() {
        const selects = document.querySelectorAll('.produk-select');
        let total = 0;
        selects.forEach(s => {
            const harga = s.options[s.selectedIndex]?.getAttribute('data-harga');
            if (harga) total += parseInt(harga);
        });
        document.getElementById('total-harga').value = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>

</body>
</html>
