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
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                  <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="on_progress" {{ request('status') == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-1">
                  <a href="{{ route('staff.proyek.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Dosen</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($proyeks as $proyek)
                    <tr>
                      <td>{{ Str::limit($proyek->judul, 40) }}</td>
                      <td>{{ $proyek->mahasiswa_nama }}</td>
                      <td>{{ $proyek->mahasiswa_nim }}</td>
                      <td>{{ $proyek->dosen_pembimbing }}</td>
                      <td>
                        <span class="badge bg-{{ $proyek->status_color }}-500">
                          {{ ucfirst(str_replace('_', ' ', $proyek->status)) }}
                        </span>
                      </td>
                      <td>{{ $proyek->progress }}%</td>
                      <td>
                        <a href="{{ route('staff.proyek.show', $proyek) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('staff.proyek.edit', $proyek) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('staff.proyek.destroy', $proyek) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center">No projects found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
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

