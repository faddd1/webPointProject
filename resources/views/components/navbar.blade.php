<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li> --}}
  </ul>

  {{-- <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

    <!-- Notifications Dropdown Menu -->
    @if (auth()->user()->role == 'admin')
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    @endif

    @if (auth()->user()->role == 'siswa')
    @php

    $nis = Auth::user()->nis;
        
        // Ambil laporan pelanggaran dalam 24 jam terakhir
        $notifications = \App\Models\Laporan::where('nis', $nis)
                                ->where('created_at', '>=', now()->subDay())                
                                ->get();

        // Hitung jumlah notifikasi
        $count = $notifications->count();
    @endphp


    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ $count }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ $count }} Notifications</span>
          <div class="dropdown-divider"></div>
          @foreach ($notifications as $notification)
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> Anda telah melakukan pelanggaran {{ $notification->pelanggaran }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            @endforeach
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li>
    @endif

 
  
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
        <i class="fa-solid fa-user"></i>  {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="/profile" class="dropdown-item">Profile</a>
        <a href="/logout" class="dropdown-item">Logout</a>
    </div>
  </li>

  </ul>
</nav>
