<li class="pc-item pc-caption">
  <label>Navigation</label>
</li>
<li class="pc-item">
  <a href="{{ route('dashboard') }}" class="pc-link">
    <span class="pc-micon">
      <i data-feather="home"></i>
    </span>
    <span class="pc-mtext">Beranda</span>
  </a>
</li>
<li class="pc-item pc-caption">
  <label>Informasi Umum</label>
</li>
<li class="pc-item">
  <a href="{{ route('public.proyek.index') }}" class="pc-link">
    <span class="pc-micon">
      <i data-feather="folder"></i>
    </span>
    <span class="pc-mtext">Proyek Akhir</span>
  </a>
</li>
@guest
<li class="pc-item pc-caption">
  <label>Akun</label>
</li>
<li class="pc-item">
  <a href="{{ route('login') }}" class="pc-link">
    <span class="pc-micon">
      <i data-feather="log-in"></i>
    </span>
    <span class="pc-mtext">Login</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('register') }}" class="pc-link">
    <span class="pc-micon">
      <i data-feather="user-plus"></i>
    </span>
    <span class="pc-mtext">Register</span>
  </a>
</li>
@endguest

