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

          @if (session('error'))
          <script>
            Swal.fire({
              title: "error",
              text: "{{ session('error') }}",
              icon: "error"
            });
          </script>
        @endif
          <div class="card">
            <div class="card-header">
              <div class="card-tools">
                @if (auth()->user()->role == 'admin')
                  <button class="btn btn-sm" style="background-color:#e8c742; color:#ffff; margin-top: 5px; margin-right: 10px;" id="tambahDataBtn">
                     <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
                  </button>
                @endif
              </div>
              <form action="/kategoripelanggaran/search" class="form-inline" method="GET">
                <div class="card-item d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}"  id="search-input">
                        <div class="input-group-append">
                            <button type="submit" class="btn" style="background-color: #213555; color: #fff;">
                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Search icon -->
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
            <style>
                .input-group {
                    width: 100%; 
                    max-width: 200px; 
                }

                .input-group .form-control {
                    border-radius: 0.25rem 0 0 0.25rem; 
                    flex: 1; 
                    height: 30px; 
                    font-size: 0.875rem; 
                }

                .input-group .btn {
                    border-radius: 0 0.25rem 0.25rem 0;
                    background-color: #266278; 
                    color: #fff; 
                    height: 30px; 
                    padding: 0 10px; 
                }

                @media (max-width: 576px) {
                    .input-group {
                        flex-direction: row; 
                        max-width: 180px; 
                    }
                }

                .action-buttons {
                      display: flex;
                      justify-content: center;
                      gap: 5px;
                  }

                
                  @media (max-width: 576px) {
                      .action-buttons {
                          flex-direction: row; 
                      }
                  }

                  .btn-danger:hover {
                    transition: transform 0.5s ease;
                    transform: translateY(-5px);
                  }

                  .edit:hover {
                    transition: transform 0.5s ease;
                    transform: translateY(-5px);
                    background-color: #213555;
                    color: #fff;
                  }

                  .edit {
                    background-color: #213555;
                    color: #fff;
                  }
            </style>
          
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                  <thead>
                    <tr style="background-color: #4F709C; color:#ffff;">
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;" class="py-2">No</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;" class="py-2">Kode</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelanggaran</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Pasal</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Poin</td>
                      @if (auth()->check() && auth()->user()->role == 'admin')
                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Aksi</td>
                      @endif
                    </tr>
                  </thead>
                  
                  <tbody>
                    @if ($kategoris->isEmpty())
                    <tr>
                      <td colspan="6" style="text-align: center;">Tidak ada data yang ditemukan</td>
                    </tr>
                    @else
                        @foreach ($kategoris as $no => $kategori)
                            <tr>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$no+1}}</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$kategori->kode}}</td>
                                <td style="vertical-align: middle; width:300px;">{{$kategori->pelanggaran}}</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$kategori->pasal->level  ?? 'Tidak Ada Pasal'}}</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$kategori->point}}</td>
                                @if (auth()->check() && auth()->user()->role == 'admin')
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                  <div class="action-buttons text-center align-middle">
                                      <button class="btn btn-sm editBtn edit" data-id="{{ $kategori->id }}">
                                          <i class="fa-solid fa-pen-to-square"></i>
                                      </button>
                                      <form action="{{ route('kategori.destroy', $kategori->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger">
                                              <i class="fa-solid fa-trash"></i>
                                          </button>
                                      </form>
                                  </div>
                              </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer mt-3" style="background: #fff;">
                <div class="d-flex">
                  <div class="ml-auto">
                      <style>
                          .pagination .page-link {
                              color: #4F709C; /* Warna abu-abu */
                              background-color: #f8f9fa; /* Warna latar belakang */
                              border-color: #dee2e6; /* Warna border */
                          }
              
                          .pagination .page-link:hover {
                              color:#4F709C; /* Warna abu-abu yang lebih gelap saat hover */
                              background-color: #e9ecef; /* Latar belakang sedikit lebih gelap */
                              border-color: #dee2e6;
                          }
              
                          .pagination .active .page-link {
                              color: white; /* Warna teks saat aktif */
                              background-color:#4F709C; /* Warna abu-abu saat aktif */
                              border-color: #4F709C;
                          }
                      </style>
                      {{ $kategoris->links('pagination::bootstrap-4') }}
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
          <div class="card" style="width: 98%; max-width: 1000px; margin: auto;">
            <div class="card-header">
             
              <div class="card-tools">
                @if (auth()->user()->role == 'admin')
                  <button class="btn btn-sm" style="background-color:#e8c742; color:#ffff; margin-top: 5px; margin-right: 10px;" id="tambahPasal">
                     <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
                  </button>
                @endif
              </div>
              <h5>Pasal</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                  <thead>
                      <tr style="background-color: #4F709C; color:#ffff;">
                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">No</td>
                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Jenis</td>
                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Pasal</td>
                        <td style="vertical-align: middle;">Deskripsi</td>
                        @if (auth()->check() && auth()->user()->role == 'admin')
                          <td style="text-align: center; vertical-align: middle;">Aksi</td>

                        @endif
                      </tr>
                </thead>
                <tbody>
                  @foreach ($pasal as $no => $item)
                    <tr>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $no + 1 }}</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->jenis }}</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->level }}</td>
                      <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->deskripsi }}</td>
                      @if (auth()->check() && auth()->user()->role == 'admin')
                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                          <div class="action-buttons text-center align-middle">
                            <button class="btn btn-sm editPasal edit"  data-id="{{ $item->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('kategori.destroyPasal', $item->id )}}" class="d-inline col-mb-2 deletePasal" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
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
  </div>

  

  <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dataModalLabel">Tambah Data Pelanggaran</h5>
          <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-arrow-right"></i></a>
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
            document.getElementById('dataModalLabel').innerText = 'Tambah Kategori Pelanggaran';
            const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
            dataModal.show();
          })
          .catch(error => console.error('Error loading create form:', error));
      });

      document.getElementById('tambahPasal').addEventListener('click', function (event) {
        event.preventDefault();
        
        fetch('/kategoripelanggaran/pasal')
          .then(response => response.text())
          .then(html => {
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('dataModalLabel').innerText = 'Tambah Kategori Pasal';
            const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
            dataModal.show();
          })
          .catch(error => console.error('Error loading create form:', error));
      });

      document.querySelectorAll('.editPasal').forEach(button => {
        button.addEventListener('click', function () {
          const pasalId = this.getAttribute('data-id');
          
          fetch(`/kategoripelanggaran/pasal/edit/${pasalId}`)
            .then(response => response.text())
            .then(html => {
              document.getElementById('modalBody').innerHTML = html;
              document.getElementById('dataModalLabel').innerText = 'Edit Kategori Pasal';
              const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
              dataModal.show();
            })
            .catch(error => console.error('Error loading edit form:', error));
        });
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
      document.querySelectorAll('.deletePasal').forEach(form => {
        form.addEventListener('submit', function(event) {
          event.preventDefault();
          Swal.fire({
            title: 'Hapus Pasal',
            text: "Apakah Anda yakin ingin menghapus Pasal ini?",
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

<script>
  function test(event, formId){
      event.target.setAttribute('disabled','disabled');
      const a =  document.querySelector(`#${formId}`);
      a.submit();
  } 
</script>
  
</x-layout>