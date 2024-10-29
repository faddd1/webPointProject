<nav class="main-header navbar navbar-expand" style="background-color: #ffff;">
    <style>
        .dropdown-item:hover {
            background-color: #4d869cb3 !important; 
            color: white !important; 
        }
    </style>


 
  <ul class="navbar-nav py-1">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: black; text-decoration: none;"  onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'"></i></a>
      </li>
  </ul>

 
  <ul class="navbar-nav ml-auto">
    @if (auth()->user()->role == 'siswa')
    @php
        $nis = Auth::user()->nis;
        
       
        $notifications = \App\Models\Laporan::where('nis', $nis)
                                ->where('created_at', '>=',  Carbon\Carbon::now()->subHours(10))
                                ->get();

       
        $count = $notifications->count();
    @endphp

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
      <i class="far fa-bell" style="color: black; text-decoration: none;" onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'"></i>
      <span class="badge badge-warning navbar-badge">{{ $count }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-lg">
        <span class="dropdown-item dropdown-header bg-primary text-white">{{ $count }} Notifikasi</span>
        <div class="dropdown-divider"></div>
  
        @if ($notifications->count() > 0)
          @foreach ($notifications as $notification)
          <a href="#" class="dropdown-item text-wrap w-100">
            <div class="d-flex align-items-center">
              <div class="mr-3">
                <i class="fas fa-exclamation-circle text-danger"></i>
              </div>
              <div class="text-truncate">
                <strong>Pelanggaran:</strong> {{ $notification->pelanggaran }}
                <br>
                <span class="text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
        @else
          <span class="dropdown-item text-center text-muted">Tidak ada notifikasi</span>
        @endif
    </div>
  </li>
  
    @endif

  <li class="nav-item dropdown" >
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" style="color: black; text-decoration: none;"  onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'">
        <i class="fa-solid fa-user" ></i>  {{ Auth::user()->name ?? 'Tidak diketahui' }}
    </a>    
    <div class="dropdown-menu dropdown-menu-right">
        <a href="/profile" class="dropdown-item" style="color: black; text-decoration: none;" 
           onmouseover="this.style.color='white'" onmouseout="this.style.color='#000'">Profil</a>
        <a href="/logout" class="dropdown-item" id="logoutButton" style="color: black; text-decoration: none;" 
           onmouseover="this.style.color='white'" onmouseout="this.style.color='#000'">Keluar</a>
    </div>
    
  </li>
  </ul>
  <script>
     document.addEventListener('DOMContentLoaded', function () {
      const logoutBtn = document.getElementById('logoutButton');

      if (logoutBtn) {
          console.log('Logout button found');
          logoutBtn.addEventListener('click', function(event) {
              event.preventDefault(); 
              console.log('Logout button clicked');

              Swal.fire({
                  title: 'Keluar',
                  text: "Apakah Anda yakin ingin keluar?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Keluar!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      console.log('Logout confirmed');
                      window.location.href = "{{ url('/logout') }}";
                  }
              });
          });
      } else {
          console.error('Logout button not found');
      }
  });
  </script>
</nav>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const logoutBtn = document.getElementById('logoutButton');

      if (logoutBtn) {
          console.log('Logout button found');
          logoutBtn.addEventListener('click', function(event) {
              event.preventDefault(); 
              console.log('Logout button clicked');

              Swal.fire({
                  title: 'Keluar',
                  text: "Apakah Anda yakin ingin keluar?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Keluar!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      console.log('Logout confirmed');
                      window.location.href = "{{ url('/logout') }}";
                  }
              });
          });
      } else {
          console.error('Logout button not found');
      }
  });
</script>
