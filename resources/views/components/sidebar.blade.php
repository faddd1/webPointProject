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
                          <p>Dashboard</p>
                      </a>
                  @endif
              </li>

              @if(auth()->check() && in_array($role, ['admin', 'guru', 'petugas']))
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
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

              @if(auth()->check() && $role == 'siswa')
                  <li class="nav-item has-treeview">
                      <a href="/listpelanggaran" class="nav-link">
                          <p>List Pelanggaran</p>
                      </a>
                  </li>
              @endif

              @if(auth()->check() && in_array($role, ['admin', 'guru']))
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <p>
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
                          <p>Laporan</p>
                      </a>
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="/laporan/review" class="nav-link">
                          <p>Review Laporan</p>
                      </a>
                  </li>
              @endif

              @if(auth()->check() && $role == 'admin')
                  <li class="nav-item has-treeview">
                      <a href="{{ url('/riwayat') }}" class="nav-link">
                          <p>Riwayat Laporan</p>
                      </a>
                  </li>
              @endif

              @if(auth()->check() && $role == 'admin')
                  <li class="nav-item has-treeview">
                      <a href="{{ url('/tambah') }}" class="nav-link">
                          <p>Tambah Akun</p>
                      </a>
                  </li>
              @endif

              <li class="nav-item has-treeview">
                  <a href="/logout" class="nav-link">
                      <p>
                          <i class="fas fa-right-from-bracket"></i> Logout
                      </p>
                  </a>
              </li>
          </ul>
      </nav>
      <!-- /.sidebar -->
  </aside>
