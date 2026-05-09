@extends('layouts.admin.app')

@section('title', 'Kelola Pesanan')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pesanan</h3>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mx-3 my-2">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <table id="pesananTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pemesanan</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanans as $index => $pesanan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pesanan->code_pemesanan }}</td>
                                    <td>{{ $pesanan->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pesanan->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $pesanan->produk }}</td>
                                    <td>Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($pesanan->bukti_pembayaran)
                                            <a href="{{ asset($pesanan->bukti_pembayaran) }}" target="_blank">
                                                <img src="{{ asset($pesanan->bukti_pembayaran) }}" alt="Bukti" width="60">
                                            </a>
                                        @else
                                            <span class="text-muted">Belum diupload</span>
                                        @endif
                                    </td>                                                                      
                                    <td>
                                        <span class="badge 
                                            {{ $pesanan->status == 'Diterima' ? 'bg-success' : '' }}
                                            {{ $pesanan->status == 'Ditolak' ? 'bg-danger' : '' }}
                                            {{ $pesanan->status == 'Diproses' ? 'bg-warning text-dark' : '' }}
                                        ">
                                            {{ $pesanan->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Diterima">
                                            <button type="submit" class="btn btn-sm btn-success" title="Terima Pesanan">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    
                                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Tolak Pesanan">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-12 -->
    </div> <!-- /.row -->
</section>
@endsection

@section('script')
<script>
  $(function() {
      $("#pesananTable").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
      });
  });
</script>
@endsection
