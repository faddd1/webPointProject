<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-tools">
                    @if (auth()->check() && (auth()->user()->role == 'admin') ) 
                     <a href="{{ url('/kategoripelanggaran/create') }}" class="btn btn-primary">Tambah Data</a>
                    @endif
                  </div>
                  <form action="{{ route('kategori.search') }}" class="form-inline" method="GET">
                    <div class="card-item d-flex">
                        <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari">
                        <button type="submit" class="btn btn-primary mb-2">Cari</button>
                    </div>
                </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggaran</th>
                                <th>Point</th>
                                <th>Level</th>
                                
                              @if (auth()->check() && (auth()->user()->role == 'admin'))
                                <th>Action</th>
                              @endif
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($kategori as $no => $kategori)
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$kategori->pelanggaran}}</td>
                                <td>{{$kategori->point}}</td>
                                <td>{{$kategori->level}}</td>
                              
                              @if (auth()->check() && (auth()->user()->role == 'admin') )  
                                <td class="d-inline">
                                  <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-info "><i class="fa-solid fa-pen-to-square "></i></a>
                                  <form action="{{ route('kategori.destroy', $kategori->id )}}" class="d-inline col-mb-2">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                                  </form>
                                </td>
                              @endif
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