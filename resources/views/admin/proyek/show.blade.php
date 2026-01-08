<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Detail Proyek'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'Detail'])
        
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Detail Proyek</h5>
            <div>
              <a href="{{ route('admin.proyek.edit', $proyek) }}" class="btn btn-primary me-2">
                <i data-feather="edit" class="me-1"></i> Edit Proyek
              </a>
              <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-12">
                <h4>{{ $proyek->judul }}</h4>
              </div>
              <div class="col-md-12">
                <p><strong>Deskripsi:</strong></p>
                <p>{{ $proyek->deskripsi }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>NIM:</strong> {{ $proyek->mahasiswa_nim }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Nama Mahasiswa:</strong> {{ $proyek->mahasiswa_nama }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Dosen Pembimbing:</strong> {{ $proyek->dosen_pembimbing }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Staff:</strong> 
                  @if($proyek->user)
                    <span class="badge bg-info-500">{{ $proyek->user->name }}</span>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Status:</strong> 
                  <span class="badge bg-{{ $proyek->status_color }}-500">
                    {{ ucfirst(str_replace('_', ' ', $proyek->status)) }}
                  </span>
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Progress:</strong> {{ $proyek->progress }}%</p>
              </div>
              <div class="col-md-6">
                <p><strong>Tanggal Mulai:</strong> {{ $proyek->tanggal_mulai?->format('d/m/Y') ?? '-' }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Tanggal Selesai:</strong> {{ $proyek->tanggal_selesai?->format('d/m/Y') ?? '-' }}</p>
              </div>
              @if($proyek->catatan)
                <div class="col-md-12">
                  <p><strong>Catatan:</strong></p>
                  <p>{{ $proyek->catatan }}</p>
                </div>
              @endif
              @if($proyek->file_dokumen)
                <div class="col-md-12">
                  <p><strong>File Dokumen:</strong></p>
                  <a href="{{ asset('storage/' . $proyek->file_dokumen) }}" target="_blank" class="btn btn-sm btn-info">Download</a>
                </div>
              @endif
              @if($proyek->file_lampiran && count($proyek->file_lampiran) > 0)
                <div class="col-md-12">
                  <p><strong>File Lampiran:</strong></p>
                  <ul class="list-unstyled">
                    @foreach($proyek->file_lampiran as $file)
                      <li class="mb-2"><a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-info">Download File</a></li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>
