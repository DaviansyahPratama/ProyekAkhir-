
<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Tambah Proyek'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Proyek', 'breadcrumb_item_active' => 'Tambah'])
        
        <div class="card">
          <div class="card-header">
            <h5>Tambah Proyek Baru</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.proyek.store') }}" enctype="multipart/form-data">
              @csrf
              
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label">Judul Proyek *</label>
                  <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                  @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label">Deskripsi *</label>
                  <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi') }}</textarea>
                  @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">NIM Mahasiswa *</label>
                  <input type="text" name="mahasiswa_nim" class="form-control @error('mahasiswa_nim') is-invalid @enderror" value="{{ old('mahasiswa_nim') }}" maxlength="10" pattern="[0-9]{10}" placeholder="10 digit angka" required>
                  <small class="text-muted">Masukkan 10 digit NIM (angka saja)</small>
                  @error('mahasiswa_nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Nama Mahasiswa *</label>
                  <input type="text" name="mahasiswa_nama" class="form-control @error('mahasiswa_nama') is-invalid @enderror" value="{{ old('mahasiswa_nama') }}" required>
                  @error('mahasiswa_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Dosen Pembimbing *</label>
                  <input type="text" name="dosen_pembimbing" class="form-control @error('dosen_pembimbing') is-invalid @enderror" value="{{ old('dosen_pembimbing') }}" required>
                  @error('dosen_pembimbing')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Status *</label>
                  <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="on_progress" {{ old('status') == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                  </select>
                  @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tanggal Mulai</label>
                  <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}">
                  @error('tanggal_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Tanggal Selesai</label>
                  <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}">
                  @error('tanggal_selesai')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Progress (%)</label>
                  <input type="number" name="progress" class="form-control @error('progress') is-invalid @enderror" value="{{ old('progress', 0) }}" min="0" max="100">
                  @error('progress')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label">Catatan</label>
                  <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan') }}</textarea>
                  @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label">File Dokumen (PDF, DOC, DOCX - Max 10MB)</label>
                  <input type="file" name="file_dokumen" class="form-control @error('file_dokumen') is-invalid @enderror" accept=".pdf,.doc,.docx">
                  @error('file_dokumen')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label">File Lampiran (Multiple - PDF, DOC, DOCX, JPG, PNG - Max 10MB each)</label>
                  <input type="file" name="file_lampiran[]" class="form-control @error('file_lampiran.*') is-invalid @enderror" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                  @error('file_lampiran.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ route('admin.proyek.index') }}" class="btn btn-secondary">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
    <script>
      // Hanya izinkan input angka untuk NIM
      document.querySelector('input[name="mahasiswa_nim"]').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
      });
    </script>
  </body>
</html>

