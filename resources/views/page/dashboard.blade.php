<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  
  <section class="content">
    @if(session()->has('success'))
      <script>
          const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
              }
          });

          Toast.fire({
              icon: "success",
              title: "{{ session('success') }}"
          });
      </script>
    @endif
    
    @if (auth()->user()->role == 'admin')
    <div class="">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="small-box" onclick="window.location.href='/datasiswa';" style="background: #4dacff; color:#fff;">
              <div class="inner">
                <div class="content">
                  <h3>{{ $totalSiswa }}</h3>
                  <p>Jumlah Siswa</p>
                </div>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/datasiswa" class="small-box-footer d-none d-sm-block">Info lebih lanjut
              <i class="fas fa-arrow-circle-right" style="color: #fff;"></i></a>
            </div>
          </div>
      
          <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="small-box" onclick="window.location.href='/teacher';" style="background: #f9df6e; color:#fff;">
              <div class="inner">
                <div class="content">
                  <h3>{{ $totalGuru }}</h3>
                  <p>Jumlah Guru</p>
                </div>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/teacher" class="small-box-footer d-none d-sm-block">Info lebih lanjut
              <i class="fas fa-arrow-circle-right" style="color: #fff;"></i></a>
            </div>
          </div>
      
          <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="small-box" onclick="window.location.href='/tambah';" style="background: #3ecf69; color:#fff;">
              <div class="inner">
                <div class="content">
                  <h3>{{ $totalUser }}</h3>
                  <p>Jumlah User</p>
                </div>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/tambah" class="small-box-footer d-none d-sm-block">Info lebih lanjut
              <i class="fas fa-arrow-circle-right" style="color: #fff;"></i></a>
            </div>
          </div>
      
          <div class="col-lg-3 col-md-6 col-6 mb-3">
            <div class="small-box" onclick="window.location.href='/datapetugas';" style="background: #f04a4a; color:#fff;">
              <div class="inner">
                <div class="content">
                  <h3>{{ $totalPetugas }}</h3>
                  <p>Jumlah Petugas</p>
                </div>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/datapetugas" class="small-box-footer d-none d-sm-block">Info lebih lanjut
              <i class="fas fa-arrow-circle-right" style="color: #fff;"></i></a>
            </div>
          </div>
        </div>
      </div>
      
      <style>
          .small-box:hover {
            transform: translateY(-5px);
            background: linear-gradient(45deg, #4dacff, #3ecf69);
          }
        @media (max-width: 400px) {
          .col-lg-3.col-md-6.col-6 {
            flex: 0 0 100%;
            max-width: 100%;
          }
      
          .small-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            height: 70px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0;
            min-height: 30px;
            transition: transform 0.3s ease, background 0.3s ease;
          }
      
          .small-box .content {
            display: flex;
            align-items: center;
            gap: 10px;
          }
      
          .small-box .icon {
            display: block;
            font-size: 40px;
            margin-left: auto;
            align-self: center;
          }

          .small-box .icon .fa-users {
            font-size: 40px;
          }
      
          .small-box:hover .fa-users {
            font-size: 45px !important;
          }

          .inner h3 {
            font-size: 18px;
            margin: 0;
            line-height: 1;
          }
      
          .inner p {
            font-size: 12px;
            margin: 0;
            line-height: 1;
          }
      
          .row {
            margin-left: 0;
            margin-right: 0;
          }
      
          .small-box-footer .desktop-text {
            display: none;
          }
        }
      
        @media (min-width: 769px) {
          .small-box-footer .desktop-text {
            display: none;
          }
        }
      
        .small-box {
          background: #4dacff;
          border-radius: 12px;
          overflow: hidden;
          position: relative;
          transition: all 0.3s ease;
          cursor: pointer;
        }

        .card-siswa:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        
        .card-body h6 {
            font-size: 11px !important;
        }
      </style>
      
    @endif
    
    

      @if (auth()->user()->role == 'admin' ||auth()->user()->role == 'guru' )
        <div class="mt-5">
        <div class="row">
          <div class="col-xl-12 col-sm-12 mt-n5">
            <div class="card shadow-sm" style="background-color: #fff; border-radius: 10px;">
              <div class="card-header text-white text-center" style="background-color: #4D869C;" >
                <h5 class="card-title mb-0">Total Pelanggaran Hari Ini</h5>
              </div>
              <div class="card-body p-3 text-center">
                <h2 class="font-weight-bold mb-0">{{ $totalPelanggaranHariIni }}</h2>
                <p class="text-muted">Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
      @endif
      
      <h4>Top Siswa</h4>
      <div class="row">
        @if ($topStudents->isEmpty())
        <div class="card-body p-2">
          <div class="card col-xl-12 col-sm-12" style="padding: 20px; display: flex; justify-content: center; align-items: center; height: 100px;">
            <span style="align-items: center; align-content:center;">Tidak ada data yang ditemukan.</span>
          </div>
        </div>
        @else
        @foreach($topStudents as $index => $student)
          <div class="col-xl-3 col-lg-4 col-md-6 col-6 mb-3">
              <div class="card card-siswa h-100">
                <div class="top-siswa">
                  <div class="card-header text-center">
                      <h5 style="font-size: 18px; margin: 0;">{{ $index + 1 }}</h5>
                  </div>
                  <div class="card-body p-3">
                      <div class="numbers">
                          <table style="width: 100%;">
                              <tr>
                                  <td colspan="3">
                                      <h5 class="text-sm text-capitalize font-weight-bold mb-1">{{ $student->nama }}</h5>
                                  </td>
                              </tr>
                              <tr>
                                  <td style="width: 40%;">
                                      <h6 class="text-sm mb-0 text-capitalize font-weight-bold" style="color: #4D869C; font-size: 12px;">Nis</h6>
                                  </td>
                                  <td style="width: 10%; text-align: center;">:</td>
                                  <td>
                                      <div class="fill">
                                          <h6 class="text-sm mb-0 font-weight-bold">{{ $student->nis }}</h6>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 class="text-sm mb-0 text-capitalize font-weight-bold" style="color: #4D869C;">Kelas</h6>
                                  </td>
                                  <td style="text-align: center;">:</td>
                                  <td>
                                      <h6 class="text-sm mb-0 font-weight-bold">{{ $student->kelas }}</h6>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 class="text-sm mb-0 text-capitalize font-weight-bold" style="color: #4D869C;">Jurusan</h6>
                                  </td>
                                  <td style="text-align: center;">:</td>
                                  <td>
                                      <h6 class="text-sm mb-0 font-weight-bold">{{ $student->jurusan }}</h6>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 class="text-sm mb-0 text-capitalize font-weight-bold" style="color: #4D869C;">Poin</h6>
                                  </td>
                                  <td style="text-align: center;">:</td>
                                  <td>
                                      <h6 class="text-sm mb-0 font-weight-bold" style="font-size: 13px">{{ $student->point }}</h6>
                                  </td>
                              </tr>
                          </table>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          @endforeach
          @endif
      </div>



        <h4>Top Pelanggaran</h4>
        <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
          <thead>
            <tr style="background-color: #4D869C; color:#ffff; font-size: 15px;">
              <th style="text-align: center; vertical-align: middle;" class="py-2">Rank</th>
              <th style="text-align: center; vertical-align: middle;">Jenis Pelanggaran</th>
              <th style="text-align: center; vertical-align: middle;">Jumlah Pelanggaran</th> 
            </tr>
          </thead>
          <tbody>
            @if ($topPelanggaran->isEmpty())
            <tr>
                <td colspan="9" style="text-align: center;">Tidak ada data yang ditemukan</td>
            </tr>
            @else
            @foreach($topPelanggaran as $index => $pelanggaran)
            <tr>
              <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->pelanggaran }}</td>
              <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->jumlah }}</td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
      
    </div>
  </section>
</x-layout>