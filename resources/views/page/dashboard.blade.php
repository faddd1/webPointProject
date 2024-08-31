<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-20 col-md-200">
          <div class="info-box">
  
            <div class="info-box-content">
              <span class="info-box-text">Note!!</span>
              <span class="info-box-number">
                
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
       </div>
      @if (auth()->check() && (auth()->user()->role == 'admin'))
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalSiswa }}</h3>
                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $totalGuru }}</h3>
                <p>Jumlah Guru</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $totalPelanggaran }}</h3>
                <p>Jumlah Pelanggaran</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalUser }}</h3>
                <p>Jumlah User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        
        
        
        
        <!-- /.row -->
        <!-- /.row -->
      @endif

      <!-- Main row with two tables -->
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Top Pelanggaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="table table-striped">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th  style="text-align: center; vertical-align: middle;">No</th>
                    <th  style="text-align: center; vertical-align: middle;">Nama Pelanggaran</th>
                    <th  style="text-align: center; vertical-align: middle;">Total Pelanggaran</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($topPelanggaran as $index => $item)
                  <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->jenis }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $item->total }}</td>
                  </tr>
                @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Top Siswa Pelaku Pelanggaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive mb-3">
                  <div class="table table-striped">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th style="width: 10px; vertical-align: middle;">No</th>
                                  <th style="text-align: center; vertical-align: middle;">Nama</th>
                                  <th style="text-align: center; vertical-align: middle;">Jumlah Poin</th>
                                  @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                                  <th style="text-align: center; vertical-align: middle;">Action</th>
                                  @endif
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($topSiswa as $index => $siswa)
                              <tr>
                                  <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                                  <td style="text-align: center; vertical-align: middle;">{{ $siswa->nama }}</td>
                                  <td style="text-align: center; vertical-align: middle;">{{ $siswa->total_point }}</td>
                                  @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                                  <td style="text-align: center; vertical-align: middle;">
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                          <button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                                          <button type="button" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                                          <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                      </div>
                                  </td>
                                  @endif
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
          
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
</x-layout>
