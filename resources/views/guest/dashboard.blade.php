<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    @include('layouts.head-page-meta', ['title' => 'Dashboard'])
    @include('layouts.head-css')
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    @include('layouts.layout-vertical')

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Dashboard', 'breadcrumb_item_active' => 'Home'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- [ Main Content ] start -->
        <div class="grid grid-cols-12 gap-x-6">
          <div class="col-span-12">
            <div class="card">
              <div class="card-header">
                <h5>Total Completed Proyeks</h5>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-check-circle text-success-500 text-[30px] mr-1.5"></i>
                    {{ $totalProyeks }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12">
            <div class="card">
              <div class="card-header">
                <h5>Recent Completed Proyeks</h5>
              </div>
              <div class="card-body">
                <div class="grid grid-cols-12 gap-4">
                  @forelse($recentProyeks as $proyek)
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">{{ Str::limit($proyek->judul, 40) }}</h5>
                          <p class="text-muted mb-2">{{ Str::limit($proyek->deskripsi, 100) }}</p>
                          <p class="mb-2"><strong>Mahasiswa:</strong> {{ $proyek->mahasiswa_nama }}</p>
                          <p class="mb-2"><strong>NIM:</strong> {{ $proyek->mahasiswa_nim }}</p>
                          <p class="mb-3"><strong>Dosen:</strong> {{ $proyek->dosen_pembimbing }}</p>
                          <a href="{{ route('guest.proyek.show', $proyek) }}" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-span-12">
                      <p class="text-center text-muted">No completed projects available</p>
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

