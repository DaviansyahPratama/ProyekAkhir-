<!doctype html>
<html lang="en">
  <head>
    @include('layouts.head-page-meta', ['title' => 'Unauthorized Access'])
    @include('layouts.head-css')
  </head>
  <body>
    @include('layouts.layout-vertical')

    <div class="pc-container">
      <div class="pc-content">
        @include('layouts.breadcrumb', ['breadcrumb_item' => 'Error', 'breadcrumb_item_active' => 'Unauthorized'])

        @if (session('error'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6">
            <div class="card">
              <div class="card-body text-center py-5">
                <div class="empty-state mb-0">
                  <div class="empty-state-icon mb-3">
                    <i data-feather="lock"></i>
                  </div>
                  <h4 class="empty-state-title mb-2">Akses Tidak Diizinkan</h4>
                  <p class="empty-state-text mb-4">
                    Maaf, Anda tidak memiliki hak akses untuk halaman ini. Jika merasa ini sebuah kesalahan,
                    silakan hubungi administrator sistem.
                  </p>
                  <a href="{{ route('dashboard') }}" class="btn btn-primary btn-upload-strong">
                    <i data-feather="home" class="me-1"></i> Kembali ke Dashboard
                  </a>
                </div>
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




