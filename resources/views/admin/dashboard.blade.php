<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    @include('layouts.head-page-meta', ['title' => 'Admin Dashboard'])
    @include('layouts.head-css')
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    @include('layouts.layout-vertical')

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Dashboard', 'breadcrumb_item_active' => 'Admin'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- [ Main Content ] start -->
        <div class="grid grid-cols-12 gap-x-6">
          <div class="col-span-12 xl:col-span-3 md:col-span-6">
            <div class="card">
              <div class="card-header !pb-0 !border-b-0">
                <h5>Total Proyek</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-folder text-primary-500 text-[30px] mr-1.5"></i>
                    {{ $totalProyeks }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-3 md:col-span-6">
            <div class="card">
              <div class="card-header !pb-0 !border-b-0">
                <h5>Pending</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-clock text-warning-500 text-[30px] mr-1.5"></i>
                    {{ $proyeksPending }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-3 md:col-span-6">
            <div class="card">
              <div class="card-header !pb-0 !border-b-0">
                <h5>On Progress</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-loader text-info-500 text-[30px] mr-1.5"></i>
                    {{ $proyeksOnProgress }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-3 md:col-span-6">
            <div class="card">
              <div class="card-header !pb-0 !border-b-0">
                <h5>Completed</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-check-circle text-success-500 text-[30px] mr-1.5"></i>
                    {{ $proyeksCompleted }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <div class="card">
              <div class="card-header !pb-0 !border-b-0">
                <h5>Total Users</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-users text-primary-500 text-[30px] mr-1.5"></i>
                    {{ $totalUsers }}
                  </h3>
                  <p class="mb-0">Staff: {{ $totalStaff }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Recent Proyeks</h5>
                <a href="{{ route('admin.proyek.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Judul</th>
                        <th>Mahasiswa</th>
                        <th>Staff</th>
                        <th>Status</th>
                        <th>Progress</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentProyeks as $proyek)
                        <tr>
                          <td>{{ Str::limit($proyek->judul, 30) }}</td>
                          <td>{{ $proyek->mahasiswa_nama }}</td>
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
                        </tr>
                      @empty
                        <tr>
                          <td colspan="5" class="text-center">No projects found</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12 xl:col-span-6 md:col-span-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Quick Actions</h5>
              </div>
              <div class="card-body">
                <div class="d-grid gap-2">
                  <a href="{{ route('admin.staff.monitoring') }}" class="btn btn-primary">
                    <i data-feather="users" class="me-2"></i> Monitoring Staff
                  </a>
                  <a href="{{ route('admin.proyek.index') }}" class="btn btn-outline-primary">
                    <i data-feather="folder" class="me-2"></i> Lihat Semua Proyek
                  </a>
                  <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                    <i data-feather="user-check" class="me-2"></i> Kelola Users
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
  <!-- [Body] end -->
</html>

