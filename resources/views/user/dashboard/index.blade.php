@extends('layout.user')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-md-flex align-items-center">
          <div>
            <h4 class="card-title">Dasboard User</h4>
          </div>
          <div class="ms-auto text-end">
            <h6 class="text-muted mb-0">Total Uang Tersisa:</h6>
            @if ($totalGaji === 0)
                <h3 class="text-danger">Gaji Belum Diinput</h3>
            @else
                <h3 class="text-success">Rp {{ number_format($sisaUang, 0, ',', '.') }}</h3>
                <small class="text-muted">
                    Gaji: Rp {{ number_format($totalGaji, 0, ',', '.') }},
                    Income: Rp {{ number_format($totalIncome, 0, ',', '.') }},
                    Outcome: Rp {{ number_format($totalOutcome, 0, ',', '.') }}
                </small>
            @endif
          </div>
        </div>
        <div class="row mt-10">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Pemasukan Terbaru</div>
              <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($recentIncomes as $income)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($income->tgl_pemasukan)->format('d/m/Y') }}</td>
                        <td>
                          @if ($income->kategori === 'Lainnya' && $income->keterangan)
                              {{ $income->keterangan }}
                          @else
                              {{ $income->kategori }}
                          @endif
                        </td>
                        <td>Rp {{ number_format($income->jumlah, 0, ',', '.') }}</td>
                      </tr>
                    @empty
                      <tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Pengeluaran Terbaru</div>
              <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Kategori</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($recentOutcomes as $outcome)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($outcome->tgl_pengeluaran)->format('d/m/Y') }}</td>
                        <td>{{ $outcome->kategori }}</td>
                        <td>Rp {{ number_format($outcome->jumlah, 0, ',', '.') }}</td>
                      </tr>
                    @empty
                      <tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>

@if (session('next_salary_reminder'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Reminder Gajian',
            html: `{!! session('next_salary_reminder') !!}`,
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if ($totalGaji === 0)
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Gaji Belum Diinput',
            text: 'Silakan tambahkan data gaji Anda terlebih dahulu.',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@endsection
