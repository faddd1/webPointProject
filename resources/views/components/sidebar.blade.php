
<aside class="main-sidebar elevation-5" style="background-color: #ffff; ">

    <style>
        /* .main-sidebar {
            width: 230px;
            
        } */
        .nav-sidebar .nav-item .nav-link.active {
            background-color: #4D869C; 
            border-radius: 5px; 
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2); 
            color: #000 !important;
        }
        
        .nav-sidebar .nav-item .nav-link:hover,
        .nav-sidebar .nav-item .nav-link.active {
            background-color: #4d869c9b;
            border-radius: 0 20px 20px 0;
            transition: background-color 0.3s ease;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
        }
        
        .nav-sidebar .nav-item .nav-link p,
        .nav-sidebar .nav-item .nav-link:hover p,
        .nav-sidebar .nav-item .nav-link.active p {
            color: #000; /* Teks default */
            transition: color 0.3s ease;
        }

        
        .nav-sidebar .nav-item .nav-link:hover p,
        .nav-sidebar .nav-item .nav-link.active p {
            color: #000 !important; /* Warna teks saat hover atau aktif */
        }
        
        .nav-sidebar .nav-item .nav-link svg {
            width: 1.2rem;  
            height: 1.2rem; 
        }
        </style>
        
    
  <div class="sidebar mt-n2">
    @if (auth()->user()->role == 'siswa')
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom">
            <div class="image">
                <img src="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" style="color: #000; text-decoration: none;" 
                    onmouseover="this.style.color='#96B6C5'" 
                    onmouseout="this.style.color='#000'"
                    class="d-block">{{ Auth::user()->siswa->nama ?? 'Tidak Diketahui' }}
                </a>
            </div>
        </div>
    @endif
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guru' || auth()->user()->role == 'petugas')
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom">
            <div class="image">
                <img src="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" style="color: #000; text-decoration: none;" 
                   onmouseover="this.style.color='#96B6C5'" 
                   onmouseout="this.style.color='#000'">
                   {{ Auth::user()->name ?? 'Tidak Diketahui' }}
                </a>
            </div>
        </div>
    @endif

    <div class="thick-white-line" style="width: 50%;"></div>
    


     
      <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <div class="side" style="">
                    @if(auth()->check())
                        @php
                            $role = auth()->user()->role;
                        @endphp
  
                          <a href=" @if(auth()->user()->role == 'admin')
                              /dashboard/admin
                          @elseif(auth()->user()->role == 'guru')
                              /dashboard/guru
                          @elseif(auth()->user()->role == 'petugas')
                              /dashboard/petugas
                          @elseif(auth()->user()->role == 'siswa')
                              /dashboard/siswa
                          @endif" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24" class="nav-icon svg-icon"><path fill="currentColor" d="M3 12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm0 8a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-8a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1zm1-17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z" style="color: #000; text-decoration: none;"/></svg>
                            <p class="nav-text" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'; ">
                              Beranda</p>
                        </a>
                    @endif
                </li>
  
                @if(auth()->check() && in_array($role, ['admin', 'guru', 'petugas']))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16"><path fill="currentColor" d="M8 1.5a.5.5 0 0 1 .5-.5A6.5 6.5 0 0 1 15 7.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5zM7 3.522a.5.5 0 0 0-.545-.498a6 6 0 1 0 6.52 6.52a.5.5 0 0 0-.497-.544H7z" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                
                            <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                                Data Kategori
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/listpelanggaran" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">List Pelanggaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kategoripelanggaran" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Kategori Pelanggaran</p>
                                </a>
                            </li>
                            @if(auth()->check() && in_array($role, ['admin', 'guru']))
                                <li class="nav-item">
                                    <a href="/hukuman" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Kategori Hukuman</p>
                                    </a>
                                </li>
                            @endif

                            @if(auth()->check() && in_array($role, ['siswa', 'guru', 'petugas', 'admin']))
                                <li class="nav-item">
                                    <a href="/tatatertib" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Tata Tertib</p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
              
                    @if(auth()->check() && in_array($role, ['admin', 'guru',]))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-medal" style="color: #000; text-decoration: none; font-size: 17px; margin-right: 2px;"></i>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                                    Data Prestasi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/listprestasi" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">List Prestasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/PoinPenebusan" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Kategori Prestasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                @if(auth()->check() && $role == 'siswa')
                    <li class="nav-item has-treeview" >
                        <a href="{{ route('listsiswa') }}" class="nav-link" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                            <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">List Pelanggaran</p>
                        </a>
                    </li>
                @endif
  
                @if(auth()->check() && in_array($role, ['admin', 'guru']))
                    <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                            <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                                Data Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/datasiswa') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Data Siswa</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/teacher') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Data Guru</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('datapetugas') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Data Petugas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(auth()->check() && in_array($role, ['admin']))
                
                    <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3.5L18.5 9M6 2c-1.11 0-2 .89-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8L14 2z" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                            <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/laporan') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Laporan</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/laporan/review') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                    <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Review Laporan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->check() && in_array($role, ['petugas', 'guru']))
                <li class="nav-item">
                            <a href="{{ url('/laporan') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3.5L18.5 9M6 2c-1.11 0-2 .89-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8L14 2z" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Laporan</p>
                            </a>
                    </li>
                @endif

                @if(auth()->check() && in_array($role, ['admin']))
                <li class="nav-item has-treeview">
                  <a href="" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m19.41 7.41l-4.83-4.83c-.37-.37-.88-.58-1.41-.58H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8.83c0-.53-.21-1.04-.59-1.42M12 18c-1.65 0-3.19-.81-4.12-2.17a.75.75 0 0 1 .19-1.04c.34-.24.81-.15 1.04.19c.65.95 1.73 1.52 2.88 1.52c1.93 0 3.5-1.57 3.5-3.5a3.495 3.495 0 0 0-6.6-1.61L10.5 13H7c-.28 0-.5-.22-.5-.5V9l1.3 1.3A4.98 4.98 0 0 1 12 8c2.76 0 5 2.24 5 5s-2.24 5-5 5"  style="color: #000; text-decoration: none;"/></svg>
                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                            Restorasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/Penebusan') }}" class="nav-link">
                                <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Restorasi</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/penebusan/review') }}" class="nav-link">
                                <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Review Restorasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(auth()->check() && in_array($role, ['guru']))
                <li class="nav-item">
                            <a href="{{ url('/Penebusan') }}" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m19.41 7.41l-4.83-4.83c-.37-.37-.88-.58-1.41-.58H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8.83c0-.53-.21-1.04-.59-1.42M12 18c-1.65 0-3.19-.81-4.12-2.17a.75.75 0 0 1 .19-1.04c.34-.24.81-.15 1.04.19c.65.95 1.73 1.52 2.88 1.52c1.93 0 3.5-1.57 3.5-3.5a3.495 3.495 0 0 0-6.6-1.61L10.5 13H7c-.28 0-.5-.22-.5-.5V9l1.3 1.3A4.98 4.98 0 0 1 12 8c2.76 0 5 2.24 5 5s-2.24 5-5 5"  style="color: #000; text-decoration: none;"/></svg>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Restorasi</p>
                            </a>
                    </li>
                @endif
                    @if(auth()->check() && in_array($role, ['admin']))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M15 14c-2.67 0-8 1.33-8 4v2h16v-2c0-2.67-5.33-4-8-4m-9-4V7H4v3H1v2h3v3h2v-3h3v-2m6 2a4 4 0 0 0 4-4a4 4 0 0 0-4-4a4 4 0 0 0-4 4a4 4 0 0 0 4 4" style="color: #000; text-decoration: none;"/></svg>
                                <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                                    Akun
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/tambahSiswa') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Akun Siswa</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/tambahGuru') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Akun Guru</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/tambahPetugas') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Akun Petugas</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/tambah') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"></i>
                                        <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">Akun Admin</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
  
                   
                    <li class="nav-item">
                        <a href="#" id="logoutButon" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 3v18h12v-5h-2v3H7V5h8v3h2V3H5m11 7l-4 4l4 4v-3h4v-2h-4v-3Z" style="color: #000; text-decoration: none;" onmouseover="this.style.color='#96B6C5'" onmouseout="this.style.color='#000'"/></svg>
                            <p style="color: #000; text-decoration: none;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#000'">
                              Keluar</p>
                        </a>
                    </li>
  
            </ul>
        </div>
      </nav>
  </div>
</aside>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const logoutBtn = document.getElementById('logoutButon');

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