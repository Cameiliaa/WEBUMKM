<!-- Tombol Edit -->
<button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
    data-target="#modalEditProduk{{ $produk->id }}">Edit</button>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditProduk{{ $produk->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content fw-bold" style="background: linear-gradient(45deg, #d4a574);">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="color: white; font-weight: bold;">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label><br>
                        @if($produk->gambar)
                            <img src="{{ asset($produk->gambar) }}" width="100" class="mb-2"><br>
                        @endif
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-light">Kosongkan jika tidak ingin mengubah gambar</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
