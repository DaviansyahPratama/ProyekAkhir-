<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Tambah User'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'User', 'breadcrumb_item_active' => 'Tambah'])
        
        <div class="card">
          <div class="card-header">
            <h5>Tambah User Baru</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.user.store') }}">
              @csrf
              
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label">Name *</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <label class="form-label">Email *</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Password *</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6">
                  <label class="form-label">Confirm Password *</label>
                  <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="col-md-12">
                  <label class="form-label">Role *</label>
                  <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                  </select>
                  @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>

