@extends('layout.user')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-md-flex align-items-center">
            <div>
                <h4 class="card-title">Outcomes User</h4>
            </div>
            <div class="ms-auto d-flex no-block align-items-center">
                <button class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal">
                    + Tambah Outcomes
                </button>
            </div>
        </div>
        <div class="row mt-10">
            <div class="col-lg-12">
              <div class="card w-100">
                <div class="card-body">
                  @if($data->isEmpty())
                    <p class="text-muted">Belum ada data income.</p>
                  @else
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead class="table-light">
                          <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pemasukan</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $index => $item)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $item->kategori }}</td>
                              <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                              <td>{{ \Carbon\Carbon::parse($item->tgl_pemasukan)->translatedFormat('d F Y') }}</td>
                              <td>{{ $item->keterangan ?? '-' }}</td>
                              <td>
                                <button class="btn btn-warning btn-sm"
                                  onclick='editIncome(@json($item))'>Edit</button>
          
                                <form id="deleteForm_{{ $item->id }}" action="{{ route('user.outcomes.delete', $item->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" action="{{ route('user.outcomes.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Income</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" id="kategori_add" class="form-control" required onchange="checkKeterangan('add')">
                  <option value="">-- Pilih Kategori --</option>
                  <option value="Rumah">Rumah</option>
                  <option value="Makan Minum">Makan Minum</option>
                  <option value="Transport">Transport</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required min="0">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Pengeluaran</label>
                <input type="date" name="tgl_pengeluaran" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan_add" class="form-control" placeholder="require jika form lainnya dipilih">
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
      <form method="POST" id="editForm">
        @csrf
        @method('PATCH')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Income</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="edit_id">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" id="edit_kategori" class="form-control" required onchange="checkKeterangan('edit')">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Rumah">Rumah</option>
                    <option value="Makan Minum">Makan Minum</option>
                    <option value="Transport">Transport</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required min="0">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal Pengeluaran</label>
                <input type="date" name="tgl_pemasukan" id="edit_tgl_pengeluaran" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" id="edit_keterangan" class="form-control">
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
    function checkKeterangan(mode) {
      const kategori = document.getElementById(mode === 'edit' ? 'edit_kategori' : 'kategori_add').value;
      const keterangan = document.getElementById(mode === 'edit' ? 'edit_keterangan' : 'keterangan_add');
      
      if (kategori === 'Lainnya') {
        keterangan.setAttribute('required', 'required');
      } else {
        keterangan.removeAttribute('required');
      }
    }
  
    function editIncome(data) {
      $('#editForm').attr('action', '/dashboard-outcomes/update/' + data.id);
      $('#edit_id').val(data.id);
      $('#edit_kategori').val(data.kategori);
      $('#edit_jumlah').val(data.jumlah);
      $('#edit_tgl_pengeluaran').val(data.tgl_pengeluaran);
      $('#edit_keterangan').val(data.keterangan);
      checkKeterangan('edit');
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
