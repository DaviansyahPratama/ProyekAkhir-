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
            <h5>Monitoring Kinerja Staff</h5>
            <p class="text-muted mb-0">Pantau kinerja dan proyek yang dikelola oleh setiap staff</p>
          </div>
          <div class="card-body">
            <!-- Search -->
            <form method="GET" action="{{ route('admin.staff.monitoring') }}" class="mb-4">
              <div class="row g-3">
                <div class="col-md-10">
                  <input type="text" name="search" class="form-control" placeholder="Cari staff berdasarkan nama atau email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
              </div>
            </form>

            <!-- Staff List -->
            <div class="grid grid-cols-12 gap-4">
              @forelse($staffs as $staff)
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                          <div class="avatar avatar-lg bg-primary-500 text-white rounded-circle d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr($staff->name, 0, 1)) }}
                          </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                          <h5 class="mb-1">{{ $staff->name }}</h5>
                          <p class="text-muted mb-0 small">{{ $staff->email }}</p>
                        </div>
                      </div>
                      
                      <div class="row g-2 mb-3">
                        <div class="col-6">
                          <div class="text-center p-2 bg-light rounded">
                            <h4 class="mb-0">{{ $staff->proyeks_completed_count ?? 0 }}</h4>
                            <small class="text-muted">Completed</small>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="text-center p-2 bg-light rounded">
                            <h4 class="mb-0">{{ $staff->proyeks_total_count ?? 0 }}</h4>
                            <small class="text-muted">Total</small>
                          </div>
                        </div>
                      </div>

                      <a href="{{ route('admin.staff.detail', $staff) }}" class="btn btn-primary w-100">
                        <i data-feather="eye" class="me-1"></i> Lihat Detail
                      </a>
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

