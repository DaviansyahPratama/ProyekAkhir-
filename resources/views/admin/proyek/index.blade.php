<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Monitoring Proyek'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'Monitoring'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h5>Monitoring Proyek Akhir - Semua Staff</h5>
            <p class="text-muted mb-0">Sebagai Admin, Anda dapat memonitoring semua proyek dari seluruh staff</p>
          </div>
          <div class="card-body">
            <!-- Search and Filter -->
            <form method="GET" action="{{ route('admin.proyek.index') }}" class="mb-4">
              <div class="row g-3 align-items-end">
                <div class="col-md-3">
                  <label class="form-label small text-muted">Cari</label>
                  <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                  <label class="form-label small text-muted">Status</label>
                  <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label small text-muted">Staff</label>
                  <select name="staff_id" class="form-control">
                    <option value="">All Staff</option>
                    @foreach($staffList as $staff)
                      <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.proyek.index') }}" class="btn btn-outline-secondary">
                      Reset
                    </a>
                    <button type="submit" class="btn btn-primary">
                      Filter
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Dosen</th>
                    <th>Staff</th>
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
                      <td>{{ $proyek->dosen_pembimbing }}</td>
                      <td>
                        @if($proyek->user)
                          <span class="badge bg-info-500">{{ $proyek->user->name }}</span>
                        @else
                          <span class="text-muted">-</span>
                        @endif
                      </td>
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
                      <td colspan="8" class="text-center">No projects found</td>
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
