<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMKN 1 KAWALI</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    @if(auth()->check())
                        @php
                            $role = auth()->user()->role;
                        @endphp
  
                        <a href="
                            @if($role == 'admin')
                                /dashboard/admin
                            @elseif($role == 'guru')
                                /dashboard/guru
                            @elseif($role == 'petugas')
                                /dashboard/petugas
                            @elseif($role == 'siswa')
                                /dashboard/siswa
                            @endif" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm0 8a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1zm1-17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z"/></svg>
                              Beranda</p>
                        </a>
                    @endif
                </li>
  
                @if(auth()->check() && in_array($role, ['admin', 'guru', 'petugas']))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><path d="M44 11v27c0 3.314-8.954 6-20 6S4 41.314 4 38V11"/><path d="M44 29c0 3.314-8.954 6-20 6S4 32.314 4 29m40-9c0 3.314-8.954 6-20 6S4 23.314 4 20"/><ellipse cx="24" cy="10" fill="currentColor" rx="20" ry="6"/></g></svg>
                                Data Kategori
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/listpelanggaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Pelanggaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kategoripelanggaran" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Pelanggaran</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
  
                @if(auth()->check() && $role == 'siswa')
                    <li class="nav-item has-treeview">
                        <a href="{{ url('/listpelanggaran/siswa') }}" class="nav-link">
                            <p>List Pelanggaran</p>
                        </a>
                    </li>
                @endif
  
                @if(auth()->check() && in_array($role, ['admin', 'guru']))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"/></svg>
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/datasiswa') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Siswa</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/teacher') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Guru</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('datapetugas') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Petugas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
  
                @if(auth()->check() && in_array($role, ['admin', 'guru', 'petugas']))
                    <li class="nav-item has-treeview">
                        <a href="/laporan" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3.5L18.5 9M6 2c-1.11 0-2 .89-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8L14 2z"/></svg>
                              Laporan</p>
                        </a>
                    </li>
  
                    <li class="nav-item has-treeview">
                        <a href="/laporan/review" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H8c-1.1 0-2 .9-2 2v3h2V4h12v16H8v-3H6v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2M16 10l-4 4l-4-4h8Z"/></svg>
                              Review Laporan</p>
                        </a>
                    </li>
                @endif
  
                <!-- Logout Button -->
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <a href="#" id="logoutButton" class="nav-link">
                            <p>
                              <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 3v18h12v-5h-2v3H7V5h8v3h2V3H5m11 7l-4 4l4 4v-3h4v-2h-4v-3Z"/></svg>
                              Keluar</p>
                        </a>
                    </li>

            </ul>
        </nav>
    </div>
  </aside>
  
  <!-- SweetAlert2 Script -->
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
