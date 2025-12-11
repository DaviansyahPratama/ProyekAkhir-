<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header flex items-center py-4 px-6 h-header-height">
      <a href="{{ route('dashboard') }}" class="b-brand flex items-center gap-3">
        <!-- ========   Change your logo from here   ============ -->
        <img src="{{ asset('assets/images/logo-white.svg') }}" class="img-fluid logo logo-lg" alt="logo" />
        <img src="{{ asset('assets/images/favicon.svg') }}" class="img-fluid logo logo-sm" alt="logo" />
      </a>
    </div>
    <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
      <ul class="pc-navbar">
        @auth
          @if(Auth::user()->isAdmin())
            @include('layouts.menu-admin')
          @elseif(Auth::user()->isStaff())
            @include('layouts.menu-staff')
          @else
            @include('layouts.menu-guest')
          @endif
        @else
          @include('layouts.menu-public')
        @endauth
      </ul>
    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->

