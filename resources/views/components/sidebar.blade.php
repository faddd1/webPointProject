<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/dashboard" class="nav-link">
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (auth()->check() && (auth()->user()->role == 'admin'))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              {{-- <i class="nav-icon fas fa-copy"></i> --}}
              <p>
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

          @if (auth()->check() && (auth()->user()->role == 'siswa' || auth()->user()->role == 'petugas' || auth()->user()->role == 'guru'))
          <li class="nav-item has-treeview">
            <a href="/listpelanggaran" class="nav-link">
              <p>
                List Pelanggaran
              </p>
            </a>
          </li>
          @endif

          @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('student') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('teacher') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Guru</p>
                </a>
              </li>
            </ul>
          </li>
          @endif


          @if (auth()->check() && (auth()->user()->role == 'petugas' || auth()->user()->role == 'siswa'))
          <li class="nav-item has-treeview">
            <a href="{{ url('student') }}" class="nav-link">
              <p>
                Data Siswa
              </p>
            </a>
          </li>
            @endif
          
          @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
          <li class="nav-item has-treeview">
            <a href="laporan" class="nav-link">
              <p>
                Laporan
              </p>
            </a>
            </li>
          @endif

          @if (auth()->user()->role == 'admin')
          <li class="nav-item has-treeview">
            <a href="{{ url('/tambah') }}" class="nav-link">
              <p>
                Tambah Akun Siswa da Guru
              </p>
            </a>
          </li>
        @endif

          <li class="nav-item has-treeview">
            <a href="/logout" class="nav-link">
              <p>
                Log Out
              </p>
            </a>
            
          </li>
         
          
    <!-- /.sidebar -->
  </aside>
