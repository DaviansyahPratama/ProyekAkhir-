<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Detail User'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'User', 'breadcrumb_item_active' => 'Detail'])
        
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Detail User</h5>
            <div>
              <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-warning">Edit</a>
              <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6">
                <p><strong>Name:</strong> {{ $user->name }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Email:</strong> {{ $user->email }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Role:</strong> 
                  <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'staff' ? 'info' : 'secondary') }}-500">
                    {{ ucfirst($user->role) }}
                  </span>
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Created At:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>

