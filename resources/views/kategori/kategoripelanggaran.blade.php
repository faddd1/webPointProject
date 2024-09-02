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
                <form action="/kategoripelanggaran/search" class="form-inline" method="GET">
                  <div class="card-item d-flex">
                      <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                      <button type="submit" class="btn btn-primary mb-2">Cari</button>
                  </div>
              </form>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <div class="table table-striped">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="text-align: center; vertical-align: middle;">No</th>
                              <th style="text-align: center; vertical-align: middle;">Nama Pelanggaran</th>
                              <th style="text-align: center; vertical-align: middle;">Point</th>
                              <th style="text-align: center; vertical-align: middle;">Level</th>
                              
                            @if (auth()->check() && (auth()->user()->role == 'admin'))
                              <th style="text-align: center; vertical-align: middle;">Action</th>
                            @endif
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($kategori as $no => $kategori)
                          <tr>
                              <td style="text-align: center; vertical-align: middle;">{{$no+1}}</td>
                              <td style="text-align: center; vertical-align: middle;">{{$kategori->pelanggaran}}</td>
                              <td style="text-align: center; vertical-align: middle;">{{$kategori->point}}</td>
                              <td style="text-align: center; vertical-align: middle;">{{$kategori->level}}</td>
                            
                            @if (auth()->check() && (auth()->user()->role == 'admin') )  
                              <td style="text-align: center; vertical-align: middle;" class="d-inline">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-info editBtn" data-id="{{ $kategori->id }}"><i class="fa-solid fa-pen-to-square "></i></a>
                                <form action="{{ route('kategori.destroy', $kategori->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
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
  </div>
  
  <!-- JavaScript untuk menghapus pencarian dan kembali ke data awal -->
  <script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/kategoripelanggaran') }}"; // Kembali ke data semula
      }
    });

    // Alert for "Tambah Data" button
    document.getElementById('tambahDataBtn').addEventListener('click', function(event) {
          event.preventDefault(); // Prevent the default link behavior
          Swal.fire({
              title: 'Tambah Data',
              text: "Apakah Anda yakin ingin menambah data baru?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Tambah!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = "{{ url('/kategoripelanggaran/create') }}";
              }
          });
      });

      // Alert for "Edit" button
      document.querySelectorAll('.editBtn').forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent the default link behavior
              const studentId = this.getAttribute('data-id');
              Swal.fire({
                  title: 'Edit Data',
                  text: "Apakah Anda yakin ingin mengedit data ini?",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Edit!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = `/kategori/${kategoriId}/edit`;
                  }
              });
          });
      });

      // Alert for "Delete" button
      document.querySelectorAll('.deleteForm').forEach(form => {
          form.addEventListener('submit', function(event) {
              event.preventDefault(); // Prevent the form from submitting
              Swal.fire({
                  title: 'Hapus Data',
                  text: "Apakah Anda yakin ingin menghapus data ini?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      form.submit(); // Submit the form
                  }
              });
          });
      });
  </script>
</x-layout>
