@extends('layouts.admin.app')

@section('title', 'Kelola Admin')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Data Admin</h3>
                    <div class="d-flex justify-content-end mb-3">
                        @include('admin.kelola-admin.create')
                    </div>
                </div>
                @if (session('sukses'))
                    <div class="alert alert-success">{{ session('sukses') }}</div>
                @endif
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @include('admin.kelola-admin.edit')
                                    @include('admin.kelola-admin.delete')
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
  $(function() {
      $("#example1").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": false,
         
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
  });
</script>
@endsection
