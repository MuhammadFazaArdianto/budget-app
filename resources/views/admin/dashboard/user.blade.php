@extends('layout.admin')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title">Dashboard User</h4>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Tambah User</button>
        </div>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                <button class="btn btn-warning btn-sm"
                                  onclick='editData(@json($user))'>Edit</button>
                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this)">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>

            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" id="editForm">
        @csrf
        @method('PATCH')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit_id">
            <div class="mb-3">
              <label class="form-label">Nama User</label>
              <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" id="edit_email" class="form-control" required min="0">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" id="edit_password" class="form-control" required min="0">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>

<script>
   function editData(data) {
    $('#editForm').attr('action', '/dashboard-admin/user/update/' + data.id);
    $('#edit_id').val(data.id);
    $('#edit_name').val(data.name);
    $('#edit_email').val(data.email);
    $('#edit_password').val(data.password);
    $('#editModal').modal('show');
  }

  function confirmDelete(id) {
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: 'Data ini akan dihapus secara permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deleteForm_' + id).submit();
      }
    });
  }
  </script>
@endsection







