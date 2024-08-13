<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-tools">
                    <a href="{{ url('/kategoripelanggaran/create') }}" class="btn btn-primary">Tambah Data</a>
                  </div>
                </div>
                <div class="card-body">
                  <form action="/kategoripelanggaran/seacrh" class="form-inline" method="GET">
                    <div class="card-item d-flex flex-wrap">
                      <input type="seacrh" class="form-control col-md-11 col-14 mb-14 mr-3" name="seacrh" placeholder="Cari">
                      <button type="submit" class="btn btn-primary mb-2">Cari</button>
                    </div>
                  </form>
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggaran</th>
                                <th>Point yang diberikan</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($kategori as $no => $kategori)
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$kategori->pelanggaran}}</td>
                                <td>{{$kategori->point}}</td>
                                <td>{{$kategori->level}}</td>
                                <td></td>

                                <td>
                                  
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                         
                    </table>
                </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</x-layout>