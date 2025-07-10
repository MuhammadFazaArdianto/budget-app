@extends('layout.user')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-md-flex align-items-center">
          <div>
            <h4 class="card-title">Salary User</h4>
            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addModal"
                title="Gaji sudah ditambahkan"
                data-bs-toggle="tooltip"
                @if($data->count() > 0) disabled @endif>
                + Tambah
            </button>
          </div>
          <div class="ms-auto text-end">
            @forelse ($data as $item)
                <div class="card mb-2 text-start">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-1 text-muted">
                            Tanggal Gajian: {{ \Carbon\Carbon::parse($item->tgl_gajian)->translatedFormat('d F Y') }}
                        </h6>
                        <h5 class="card-title">Rp {{ number_format($item->total_gaji, 0, ',', '.') }}</h5>
                        <button class="btn btn-warning btn-sm" onclick='editData(@json($item))'>Edit</button>
                        <form id="deleteForm_{{ $item->id }}" action="{{ route('user.salary.delete', $item->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada data gaji.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('user.salary.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Salary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tanggal Gajian</label>
              <input type="date" name="tgl_gajian" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Total Gaji</label>
              <input type="number" name="total_gaji" class="form-control" required min="0">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </div>
      </form>
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
            <h5 class="modal-title">Edit Salary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit_id">
            <div class="mb-3">
              <label class="form-label">Tanggal Gajian</label>
              <input type="date" name="tgl_gajian" id="edit_tgl_gajian" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Total Gaji</label>
              <input type="number" name="total_gaji" id="edit_total_gaji" class="form-control" required min="0">
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
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

  function editData(data) {
    $('#editForm').attr('action', '/dashboard-salary/update/' + data.id);
    $('#edit_id').val(data.id);
    $('#edit_tgl_gajian').val(data.tgl_gajian);
    $('#edit_total_gaji').val(data.total_gaji);
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
