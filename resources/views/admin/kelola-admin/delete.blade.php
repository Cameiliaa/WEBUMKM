<!-- Button trigger modal -->
<a role="button" class="btn btn-sm btn-danger delete-button" data-bs-toggle="modal"
data-bs-target=".bd-example-modal-sm{{ $admin->id }}">
    <i class="fas fa-trash"></i> Hapus
</a>

<!-- Modal -->
<div class="modal fade bd-example-modal-sm{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Hapus Admin</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus admin <strong>{{ $admin->name }}</strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.kelola-admin.destroy', $admin->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-danger light" value="Hapus">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>
