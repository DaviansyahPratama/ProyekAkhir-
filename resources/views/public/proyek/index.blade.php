<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Proyek - Informasi Umum'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-public')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'Informasi Umum'])
        
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Proyek Akhir - Informasi Umum</h5>
            @guest
              <div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Register</a>
              </div>
            @endguest
          </div>
          <div class="card-body">
            <p class="text-muted mb-4">Berikut adalah daftar proyek akhir yang telah selesai dan tersedia untuk dilihat oleh publik.</p>
            
            <form method="GET" action="{{ route('public.proyek.index') }}" class="mb-4">
              <div class="row g-3">
                <div class="col-md-10">
                  <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul, NIM, nama mahasiswa, atau dosen pembimbing..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
              </div>
            </form>

            <div class="grid grid-cols-12 gap-4">
              @forelse($proyeks as $proyek)
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <h5 class="card-title">{{ Str::limit($proyek->judul, 40) }}</h5>
                      <p class="text-muted mb-2">{{ Str::limit($proyek->deskripsi, 100) }}</p>
                      <p class="mb-2"><strong>Mahasiswa:</strong> {{ $proyek->mahasiswa_nama }}</p>
                      <p class="mb-2"><strong>NIM:</strong> {{ $proyek->mahasiswa_nim }}</p>
                      <p class="mb-2"><strong>Dosen:</strong> {{ $proyek->dosen_pembimbing }}</p>
                      <p class="mb-3"><strong>Progress:</strong> {{ $proyek->progress }}%</p>
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

