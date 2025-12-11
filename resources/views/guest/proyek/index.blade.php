<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Proyek'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'List'])
        
        <div class="card">
          <div class="card-header">
            <h5>Completed Proyeks</h5>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('guest.proyek.index') }}" class="mb-4">
              <div class="row g-3">
                <div class="col-md-10">
                  <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
              </div>
            </form>

            <div class="grid grid-cols-12 gap-4">
              @forelse($proyeks as $proyek)
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

