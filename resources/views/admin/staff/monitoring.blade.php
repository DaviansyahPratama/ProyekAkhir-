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

            <!-- Staff List -->
            <div class="grid grid-cols-12 gap-4">
              @forelse($staffs as $staff)
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                  <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                      <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-lg bg-primary-500 text-white rounded-circle d-flex align-items-center justify-content-center fw-semibold"
                            style="width: 52px; height: 52px; flex-shrink: 0;">
                            {{ strtoupper(substr($staff->name, 0, 1)) }}
                          </div>
                          <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ $staff->name }}</h6>
                            <p class="text-muted mb-0 small">{{ $staff->email }}</p>
                          </div>
                        </div>
                        <span class="badge bg-primary-100 text-primary-700 fw-semibold px-3 py-2">{{ $staff->proyeks_total_count ?? 0 }} proyek</span>
                      </div>

                      <div class="row g-2 mb-3">
                        <div class="col-6">
                          <div class="p-3 rounded border text-center h-100">
                            <p class="text-muted mb-1 small">Completed</p>
                            <h4 class="mb-0 text-success-600">{{ $staff->proyeks_completed_count ?? 0 }}</h4>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="p-3 rounded border text-center h-100">
                            <p class="text-muted mb-1 small">Total</p>
                            <h4 class="mb-0 text-info-600">{{ $staff->proyeks_total_count ?? 0 }}</h4>
                          </div>
                        </div>
                      </div>

                      <div class="mt-auto">
                        <a href="{{ route('admin.staff.detail', $staff) }}" class="btn btn-primary w-100">
                          <i data-feather="eye" class="me-1"></i> Lihat Detail
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-span-12">
                  <div class="alert alert-info text-center">
                    <p class="mb-0">Belum ada staff yang terdaftar.</p>
                  </div>
                </div>
              @endforelse
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

