<nav class="main-header navbar navbar-expand" style="background-color: #ffff;">


 
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
                
                                ->get();

       
        $count = $notifications->count();
    @endphp

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell" style="color: black; text-decoration: none;"  onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'"></i>
          <span class="badge badge-warning navbar-badge">{{ $count }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ $count }} Notifikasi</span>
          <div class="dropdown-divider"></div>
          @foreach ($notifications as $notification)
          <a href="#" class="dropdown-item text-wrap w-100">
            <i class="fas fa-envelope mr-2"></i> Anda telah melakukan pelanggaran {{ $notification->pelanggaran }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
            </a>
            @endforeach
          <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
      </div>
    </li>
    @endif

  <li class="nav-item dropdown" >
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" style="color: black; text-decoration: none;"  onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'">
        <i class="fa-solid fa-user" ></i>  {{ Auth::user()->name ?? 'Tidak diketahui' }}
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="/profile" class="dropdown-item"style="color: black; text-decoration: none;"  onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'">Profile</a>
        <a href="/logout" class="dropdown-item" id="logoutButton" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#4D869C'" onmouseout="this.style.color='#000'">Logout</a>
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
