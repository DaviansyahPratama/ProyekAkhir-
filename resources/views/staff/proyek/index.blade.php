@php use Illuminate\Support\Str; @endphp
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Proyek Management'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'List'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Proyek Saya</h5>
            <a href="{{ route('staff.proyek.create') }}" class="btn btn-primary">
              <i data-feather="plus"></i> Tambah Proyek
            </a>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('staff.proyek.index') }}" class="mb-4">
              <div class="row g-3 align-items-end">
                <div class="col-md-6">
                  <label class="form-label small text-muted">Cari</label>
                  <input type="text" name="search" class="form-control" placeholder="Cari judul / mahasiswa / dosen..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                  <label class="form-label small text-muted">Status</label>
                  <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('staff.proyek.index') }}" class="btn btn-outline-secondary">
                      Reset
                    </a>
                    <button type="submit" class="btn btn-primary">
                      Filter
                    </button>
                  </div>
                </div>
              </div>
            </form>

            <div class="row g-3">
              @forelse($proyeks as $proyek)
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                          <h6 class="mb-1">{{ Str::limit($proyek->judul, 60) }}</h6>
                          <p class="text-muted mb-0 small">{{ $proyek->mahasiswa_nama }} ({{ $proyek->mahasiswa_nim }})</p>
                        </div>
                        <span class="badge bg-{{ $proyek->status_color }}-500 text-white text-capitalize">
                          {{ str_replace('_', ' ', $proyek->status) }}
                        </span>
                      </div>

                      <p class="mb-2 small text-muted">
                        Dosen: <span class="text-body">{{ Str::limit($proyek->dosen_pembimbing, 30) }}</span>
                      </p>

                      <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                          <span class="small text-muted">Progress</span>
                          <span class="small fw-semibold">{{ $proyek->progress }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                          <div class="progress-bar bg-{{ $proyek->status_color }}-500" role="progressbar"
                            style="width: {{ $proyek->progress }}%;" aria-valuenow="{{ $proyek->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>

                      <div class="mt-auto">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                          <div class="btn-group" role="group">
                            <a href="{{ route('staff.proyek.show', $proyek) }}" class="btn btn-sm btn-outline-primary px-3">
                              <i data-feather="eye" class="me-1"></i> Detail
                            </a>
                            <a href="{{ route('staff.proyek.edit', $proyek) }}" class="btn btn-sm btn-outline-warning text-warning px-3">
                              <i data-feather="edit" class="me-1"></i> Edit
                            </a>
                          </div>
                          <form action="{{ route('staff.proyek.destroy', $proyek) }}" method="POST" class="mb-0 ms-auto" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-3">
                              <i data-feather="trash-2" class="me-1"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @empty
                <div class="col-12">
                  <div class="alert alert-info text-center mb-0">
                    Belum ada proyek ditemukan.
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

