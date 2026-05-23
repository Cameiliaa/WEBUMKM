<!-- Tombol Edit -->
<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditAdmin{{ $admin->id }}">
    <i class="fas fa-edit"></i> Edit
</button>

<!-- Modal Edit Admin --> 
<div class="modal fade" id="modalEditAdmin{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.kelola-admin.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content bg-info" style="background: linear-gradient(45deg, #d4a574);">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="modalEditAdminLabel"><strong>Edit Admin</strong></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: white; font-weight: bold;">
                    <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required /> 
                    </div>
                    <div class="form-group">
                        <label for="email">Email Admin</label>
                        <input type="email" class="form-control" name="email" value="{{ $admin->email }}" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Ubah Password (Opsional)</label>
                        <input type="password" class="form-control" name="password" placeholder="Kosongkan jika tidak ingin mengubah" />
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
