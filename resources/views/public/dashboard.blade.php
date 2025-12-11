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
    @include('layouts.layout-public')

    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Dashboard', 'breadcrumb_item_active' => 'Beranda'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <!-- Welcome Section -->
        <div class="card mb-4">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h3 class="mb-2">Selamat Datang di Sistem Monitoring Proyek Akhir</h3>
                <p class="text-muted mb-3">Lihat informasi umum tentang proyek akhir yang telah selesai. Login untuk akses lebih lanjut.</p>
                @guest
                  <div>
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                      <i data-feather="log-in" class="me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                      <i data-feather="user-plus" class="me-1"></i> Register
                    </a>
                  </div>
                @else
                  <div>
                    <p class="text-success mb-0">Anda sudah login sebagai <strong>{{ Auth::user()->name }}</strong></p>
                  </div>
                @endguest
              </div>
              <div class="col-md-4 text-end">
                <i class="feather icon-folder text-primary-500" style="font-size: 80px; opacity: 0.3;"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- [ Main Content ] start -->
        <div class="grid grid-cols-12 gap-x-6">
          <div class="col-span-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Total Proyek Selesai</h5>
                <a href="{{ route('public.proyek.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
              </div>
              <div class="card-body">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                  <h3 class="font-light flex items-center mb-0">
                    <i class="feather icon-check-circle text-success-500 text-[30px] mr-1.5"></i>
                    {{ $totalProyeks }}
                  </h3>
                  <p class="mb-0 text-muted">Proyek yang telah selesai dan tersedia untuk dilihat</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12">
            <div class="card">
              <div class="card-header">
                <h5>Proyek Terbaru</h5>
              </div>
              <div class="card-body">
                <div class="grid grid-cols-12 gap-4">
                  @forelse($recentProyeks as $proyek)
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                      <div class="card h-100">
                        <div class="card-body">
                          <h5 class="card-title">{{ Str::limit($proyek->judul, 40) }}</h5>
                          <p class="text-muted mb-2">{{ Str::limit($proyek->deskripsi, 100) }}</p>
                          <p class="mb-2"><strong>Mahasiswa:</strong> {{ $proyek->mahasiswa_nama }}</p>
                          <p class="mb-2"><strong>NIM:</strong> {{ $proyek->mahasiswa_nim }}</p>
                          <p class="mb-3"><strong>Dosen:</strong> {{ $proyek->dosen_pembimbing }}</p>
                          <a href="{{ route('public.proyek.show', $proyek) }}" class="btn btn-sm btn-primary w-100">Lihat Detail</a>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-span-12">
                      <div class="alert alert-info text-center">
                        <p class="mb-0">Belum ada proyek yang tersedia untuk dilihat.</p>
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

