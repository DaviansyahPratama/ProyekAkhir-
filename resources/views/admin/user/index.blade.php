<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'User Management'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')
    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'User', 'breadcrumb_item_active' => 'List'])
        
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        @endif

        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5>User Management</h5>
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
              <i data-feather="plus"></i> Tambah User
            </a>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('admin.user.index') }}" class="mb-4">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                  <select name="role" class="form-control">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="guest" {{ request('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-1">
                  <a href="{{ route('admin.user.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($users as $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'staff' ? 'info' : 'secondary') }}-500">
                          {{ ucfirst($user->role) }}
                        </span>
                      </td>
                      <td>{{ $user->created_at->format('d/m/Y') }}</td>
                      <td>
                        <a href="{{ route('admin.user.show', $user) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        @if($user->id !== Auth::id())
                          <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                          </form>
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">No users found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div class="mt-4">
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layouts.footer-block')
    @include('layouts.footer-js')
  </body>
</html>

