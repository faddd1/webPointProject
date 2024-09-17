<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Main content -->
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

    <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-20 col-md-200">
            @if (auth()->user()->role == 'siswa')
              <div class="info-box">
                <div class="info-box-content">
                  <span class="info-box-text">Note!!</span>
                  <span class="info-box-number">
                    {{-- @if($report)
                        Anda telah melakukan pelanggaran "{{ $report->pelanggaran }}" !!
                    @else
                        Anda tidak melakukan pelanggaran apapun.
                    @endif --}}
                  </span>
                </div>
              </div>
            @endif
          </div>
        </div>

      @if (auth()->user()->role == 'admin')
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box" style="background: #4dacff; color:#fff;">
              <div class="inner">
                <h3>{{ $totalSiswa }}</h3>
                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/datasiswa" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box" style="background: #f9df6e; color:#fff;">
              <div class="inner">
                <h3>{{ $totalGuru }}</h3>
                <p>Jumlah Guru</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/teacher" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box" style="background: #3ecf69; color:#fff;">
              <div class="inner">
                <h3>{{ $totalUser }}</h3>
                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/tambah" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box" style="background: #f04a4a; color:#fff;">
              <div class="inner">
                <h3>{{ $totalPetugas }}</h3>
                <p>Jumlah Petugas</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="/datapetugas" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      @endif
      
     
        <h3>Top 4 Siswa Poin Pelanggaran Terbanyak</h3>
        <div class="row"> 
          @foreach($topStudents as $index => $student)
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header">
                  <div class="inner">
                    <h3>{{ $index + 1 }}</h3>
                  </div>
              </div>
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ $student->nama }}</p>
                      <p class="text-sm mb-0 text-capitalize font-weight-bold"><span class="text-success text-sm font-weight-bolder">Nis : </span>{{ $student->nis }}</p>
                      <p class="text-sm mb-0 text-capitalize font-weight-bold"><span class="text-success text-sm font-weight-bolder">kelas : </span>{{ $student->kelas }}</p>
                      <p class="text-sm mb-0 text-capitalize font-weight-bold"><span class="text-success text-sm font-weight-bolder">Jurusan : </span>{{ $student->jurusan }}</p>
                      <h5 class="font-weight-bolder mb-0">
                        <span class="text-success text-sm font-weight-bolder">Jumlah Poin : </span>
                        {{ $student->point }}
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                      <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <h3>Top 5 Pelanggaran Terbanyak</h3>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Rank</th>
              <th>Pelanggaran</th>
              <th>Jumlah Pelanggaran</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topPelanggaran as $index => $pelanggaran)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $pelanggaran->pelanggaran }}</td>
              <td>{{ $pelanggaran->jumlah }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @if (auth()->user()->role == 'admin' ||auth()->user()->role == 'guru' )
        <h3>Pelanggaran Yang Dilakukan Hari Ini</h3>
        <div class="row">
          <div class="col-xl-12 col-sm-12">
            <div class="card shadow-sm" style="background-color: #f4f4f4; border-radius: 10px;">
              <div class="card-header bg-danger text-white text-center">
                <h4 class="card-title mb-0">Total Pelanggaran Hari Ini</h4>
              </div>
              <div class="card-body p-3 text-center">
                <h2 class="font-weight-bold mb-0">{{ $totalPelanggaranHariIni }}</h2>
                <p class="text-muted">Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>
</x-layout>
