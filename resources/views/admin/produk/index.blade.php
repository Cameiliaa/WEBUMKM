@extends('layouts.admin.app')

@section('title', 'Kelola Produk')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Kelola Data Produk</h3>
                        <div>
                            @include('admin.produk.create') 
                        </div>
                    </div>
                    @if (session('sukses'))
                        <div class="alert alert-success">{{ session('sukses') }}</div>
                    @endif
                    <div class="card-body">
                        <table id="produkTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($produk->gambar)
                                                <img src="{{ asset($produk->gambar) }}" width="100">
                                            @else
                                                <small>Gambar tidak tersedia</small>
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.produk.edit')
                                            @include('admin.produk.delete')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $("#produkTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
            }).buttons().container().appendTo('#produkTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
