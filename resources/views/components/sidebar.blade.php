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
                      <a href="/listpelanggaran" class="nav-link">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3.5L18.5 9M6 2c-1.11 0-2 .89-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/></svg>
                            Laporan</p>
                      </a>
                  </li>

                  <li class="nav-item has-treeview">
                      <a href="/laporan/review" class="nav-link">
                          <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2M6 14v-2.47l6.88-6.88c.2-.2.51-.2.71 0l1.77 1.77c.2.2.2.51 0 .71L8.47 14zm11 0h-6.5l2-2H17c.55 0 1 .45 1 1s-.45 1-1 1"/></svg>
                            Review Laporan</p>
                      </a>
                  </li>
              @endif

              @if(auth()->check() && $role == 'admin')
                  <li class="nav-item has-treeview">
                      <a href="{{ url('/riwayat') }}" class="nav-link">
                          <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z"/></svg>
                            Riwayat Laporan</p>
                      </a>
                  </li>
              @endif

              @if(auth()->check() && $role == 'admin')
                  <li class="nav-item has-treeview">
                      <a href="{{ url('/tambah') }}" class="nav-link">
                          <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M15 14c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4m-9-4V7H4v3H1v2h3v3h2v-3h3v-2m6 2a4 4 0 0 0 4-4a4 4 0 0 0-4-4a4 4 0 0 0-4 4a4 4 0 0 0 4 4"/></svg>
                            Tambah Akun</p>
                      </a>
                  </li>
              @endif

              <li class="nav-item has-treeview keluarBtn">
                  <a href="#" class="nav-link">
                      <p>
                          <i class="fas fa-right-from-bracket mr-2"></i> Keluar
                      </p>
                  </a>
              </li>
          </ul>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('.keluarBtn').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior
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
                            window.location.href = "{{ url('/logout') }}";
                        }
                    });
                });
            });

                // document.getElementById('.keluarBtn').addEventListener('click', function(event) {
                //     event.preventDefault(); // Prevent the default link behavior
                //     Swal.fire({
                //         title: 'Keluar',
                //         text: "Apakah Anda yakin ingin keluar?",
                //         icon: 'question',
                //         showCancelButton: true,
                //         confirmButtonColor: '#3085d6',
                //         cancelButtonColor: '#d33',
                //         confirmButtonText: 'Ya, Keluar!',
                //         cancelButtonText: 'Batal'
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             window.location.href = "{{ url('/logout') }}";
                //         }
                //     });
                // });
          </script>
      </nav>
      <!-- /.sidebar -->
  </aside>
