<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="container">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          @if (session('success'))
            <script>
              Swal.fire({
                title: "SUCCESS",
                text: "{{ session('success') }}",
                icon: "success"
              });
            </script>
          @endif
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                @if (auth()->user()->role == 'admin')
                  <button class="btn btn-sm btn-primary" id="tambahDataBtn" style="margin-top: 5px;">
                    <i class="fa-solid fa-circle-plus"></i> Add
                  </button>
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
                <table class="table table-bordered table-hover table-sm">
                  <thead>
                    <tr>
                      <th style="text-align: center; vertical-align: middle;">No</th>
                      <th style="text-align: center; vertical-align: middle;">Nama Pelanggaran</th>
                      <th style="text-align: center; vertical-align: middle;">Point</th>
                      <th style="text-align: center; vertical-align: middle;">Level</th>
                      @if (auth()->check() && auth()->user()->role == 'admin')
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
                        @if (auth()->check() && auth()->user()->role == 'admin')
                          <td style="text-align: center; vertical-align: middle;">
                            <button class="btn btn-sm btn-primary editBtn" data-id="{{ $kategori->id }}">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('kategori.destroy', $kategori->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash"></i>
                              </button>
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

  <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dataModalLabel">Tambah Data Pelanggaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">
          <!-- Content will be loaded here via JavaScript -->
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/kategoripelanggaran') }}";
      }
    });

    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('tambahDataBtn').addEventListener('click', function (event) {
        event.preventDefault();
        
        fetch('/kategoripelanggaran/create')
          .then(response => response.text())
          .then(html => {
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('dataModalLabel').innerText = 'Tambah Data Kategori';
            const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
            dataModal.show();
          })
          .catch(error => console.error('Error loading create form:', error));
      });

      document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
          const kategoriId = this.getAttribute('data-id');
          
          fetch(`/kategori/edit/${kategoriId}`)
            .then(response => response.text())
            .then(html => {
              document.getElementById('modalBody').innerHTML = html;
              document.getElementById('dataModalLabel').innerText = 'Edit Data Kategori';
              const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
              dataModal.show();
            })
            .catch(error => console.error('Error loading edit form:', error));
        });
      });

      document.querySelectorAll('.deleteForm').forEach(form => {
        form.addEventListener('submit', function(event) {
          event.preventDefault();
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
              form.submit();
            }
          });
        });
      });
    });
  </script>
</x-layout>
