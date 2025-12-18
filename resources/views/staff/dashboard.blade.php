@php use Illuminate\Support\Str; @endphp
<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    @include('layouts.head-page-meta', ['title' => 'Staff Dashboard'])
    @include('layouts.head-css')
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    @include('layouts.layout-vertical')

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Dashboard', 'breadcrumb_item_active' => 'Staff'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- [ Main Content ] start -->
        <div class="grid grid-cols-12 gap-x-6">
          <div class="col-span-12 xl:col-span-3 md:col-span-6">
            <div class="card card-stat">
              <div class="card-header !pb-0 !border-b-0">
                <h5>My Proyeks</h5>
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
            <div class="card card-stat">
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
            <div class="card card-stat">
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
          <div class="col-span-12">
            <div class="card">
              <div class="card-header">
                <h5>My Recent Proyeks</h5>
              </div>
              <div class="card-body">
                <div class="row g-3">
                  @forelse($myRecentProyeks as $proyek)
                    <div class="col-12 col-md-6 col-lg-4">
                      <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                          <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                              <h6 class="mb-1">{{ Str::limit($proyek->judul, 60) }}</h6>
                              <p class="text-muted mb-0 small">{{ $proyek->mahasiswa_nama }}</p>
                            </div>
                            <span class="badge bg-{{ $proyek->status_color }}-500 text-white text-capitalize">
                              {{ str_replace('_', ' ', $proyek->status) }}
                            </span>
                          </div>

                          <div class="mb-2">
                            <span class="small text-muted">Progress</span>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                <div class="progress-bar bg-{{ $proyek->status_color }}-500" role="progressbar"
                                  style="width: {{ $proyek->progress }}%;" aria-valuenow="{{ $proyek->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <span class="small fw-semibold">{{ $proyek->progress }}%</span>
                            </div>
                          </div>

                          <div class="mt-auto">
                            <a href="{{ route('staff.proyek.show', $proyek) }}" class="btn btn-sm btn-primary w-100">
                              <i data-feather="eye" class="me-1"></i> Lihat Detail
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <div class="alert alert-info text-center mb-0">
                        No projects found
                      </div>
                    </div>
                  @endforelse
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

