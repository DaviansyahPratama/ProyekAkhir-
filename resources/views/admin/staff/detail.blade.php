@php use Illuminate\Support\Str; @endphp
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Detail Staff'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Monitoring Staff', 'breadcrumb_item_active' => 'Detail'])
        
        <div class="card mb-4">
          <div class="card-header">
            <h5>Informasi Staff</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Total Proyek:</strong> {{ $stats['total'] }}</p>
                <p><strong>Completed:</strong> {{ $stats['completed'] }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Proyek yang Dikelola</h5>
            <a href="{{ route('admin.staff.monitoring') }}" class="btn btn-secondary">Kembali</a>
          </div>
          <div class="card-body">
            <!-- Stats -->
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="card bg-warning-50">
                  <div class="card-body text-center">
                    <h3>{{ $stats['pending'] }}</h3>
                    <p class="mb-0">Pending</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card bg-info-50">
                  <div class="card-body text-center">
                    <h3>{{ $stats['on_progress'] }}</h3>
                    <p class="mb-0">On Progress</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card bg-success-50">
                  <div class="card-body text-center">
                    <h3>{{ $stats['completed'] }}</h3>
                    <p class="mb-0">Completed</p>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card bg-primary-50">
                  <div class="card-body text-center">
                    <h3>{{ $stats['total'] }}</h3>
                    <p class="mb-0">Total</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Proyek List -->
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($proyeks as $proyek)
                    <tr>
                      <td>{{ Str::limit($proyek->judul, 40) }}</td>
                      <td>{{ $proyek->mahasiswa_nama }}</td>
                      <td>{{ $proyek->mahasiswa_nim }}</td>
                      <td>
                        <span class="badge bg-{{ $proyek->status_color }}-500">
                          {{ ucfirst(str_replace('_', ' ', $proyek->status)) }}
                        </span>
                      </td>
                      <td>{{ $proyek->progress }}%</td>
                      <td>
                        <a href="{{ route('admin.proyek.show', $proyek) }}" class="btn btn-sm btn-info">View</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Staff ini belum memiliki proyek</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
              {{ $proyeks->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>

