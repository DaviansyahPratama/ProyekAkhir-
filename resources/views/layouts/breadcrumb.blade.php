<!-- [ breadcrumb ] start -->
<div class="page-header">
  <div class="page-block">
    <div class="page-header-title">
      <h5 class="mb-0 font-medium">{{ $breadcrumb_item_active ?? 'Dashboard' }}</h5>
    </div>
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript: void(0)">{{ $breadcrumb_item ?? 'Dashboard' }}</a></li>
      <li class="breadcrumb-item" aria-current="page">{{ $breadcrumb_item_active ?? 'Dashboard' }}</li>
    </ul>
  </div>
</div>
<!-- [ breadcrumb ] end -->
