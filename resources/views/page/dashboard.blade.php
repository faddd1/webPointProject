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
          <div class="col-lg-12 d-flex flex-wrap">
            <div class="small-box bg-info" style="margin-right: 15px; margin-bottom: 15px; flex: 1;">
              <div class="inner">
                <h3>150</h3>
                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        
            <div class="small-box bg-success" style="margin-right: 15px; margin-bottom: 15px; flex: 1;">
              <div class="inner">
                <h3>53</h3>
                <p>Jumlah Guru</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        
            <div class="small-box bg-warning" style="margin-right: 15px; margin-bottom: 15px; flex: 1;">
              <div class="inner">
                <h3>44</h3>
                <p>Jumlah Pelanggaran</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        
            <div class="small-box bg-danger" style="margin-bottom: 15px; flex: 1;">
              <div class="inner">
                <h3>65</h3>
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
            <div class="table-responsive mt-4 mb-4">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pelanggaran</th>
                    <th>Total Pelanggaran</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1.</td>
                    <td>Tawuran</td>
                    <td>50</td>
                  </tr>
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
              <div class="table-responsive mt-4 mb-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama</th>
                      <th>Jumlah Poin</th>
                      @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                      <th>Action</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Alif Miftah Fauzan</td>
                      <td>100</td>
                      @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                      <td>
                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square "></i> </button>
                          <button type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                        </div>
                      </td>
                      @endif
                    </tr>

                    <tr>
                      <td>2.</td>
                      <td>Fadli Alam Akbar</td>
                      <td>100</td>
                      @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                      <td>
                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square "></i> </button>
                          <button type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                        </div>
                      </td>
                      @endif
                    </tr>

                    <tr>
                      <td>3.</td>
                      <td>Kafiyan</td>
                      <td>200</td>
                      @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                      <td>
                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square "></i> </button>
                          <button type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                        </div>
                      </td>
                      @endif
                    </tr>

                    <tr>
                      <td>4.</td>
                      <td>Usep</td>
                      <td>50</td>
                      @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))
                      <td>
                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square "></i> </button>
                          <button type="submit" class="btn btn-success"><i class="fa-solid fa-eye"></i></button>
                          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                        </div>
                      </td>
                      @endif
                    </tr>
                  </tbody>
                </table>
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
