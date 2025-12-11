<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Monitoring Staff'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Monitoring', 'breadcrumb_item_active' => 'Staff'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h5 class="mb-1">Monitoring Kinerja Staff</h5>
            <p class="text-muted mb-0">Pantau kinerja dan proyek yang dikelola oleh setiap staff</p>
          </div>
          <div class="card-body">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.staff.monitoring') }}" class="mb-4">
              <div class="row g-3 align-items-end">
                <div class="col-md-10">
                  <label class="form-label small text-muted">Cari staff</label>
                  <input type="text" name="search" class="form-control" placeholder="Nama atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">
                    <i data-feather="search" class="me-1"></i>Cari
                  </button>
                </div>
              </div>
            </form>

            <!-- Staff List (Table) -->
            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th class="text-center">Completed</th>
                    <th class="text-center">Total</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($staffs as $staff)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <div class="avatar bg-primary-500 text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i data-feather="user"></i>
                          </div>
                          <span>{{ $staff->name }}</span>
                        </div>
                      </td>
                      <td>{{ $staff->email }}</td>
                      <td class="text-center">
                        <span class="badge bg-success-100 text-success-700 px-3 py-2">
                          {{ $staff->proyeks_completed_count ?? 0 }}
                        </span>
                      </td>
                      <td class="text-center">
                        <span class="badge bg-primary-100 text-primary-700 px-3 py-2">
                          {{ $staff->proyeks_total_count ?? 0 }}
                        </span>
                      </td>
                      <td class="text-center">
                        <a href="{{ route('admin.staff.detail', $staff) }}" class="btn btn-sm btn-primary">
                          <i data-feather="eye" class="me-1"></i> Detail
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">Belum ada staff yang terdaftar.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
              {{ $staffs->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>

