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
                  <button class="btn btn-sm" style="background-color:#e8c742; color:#ffff; margin-top: 5px; margin-right: 10px;" id="tambahDataBtnn">
                     <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
                  </button>
                @endif
              </div>
              <form action="/listprestasi/search" class="form-inline" method="GET">
                <div class="card-item d-flex">
                    <div class="input-group">
                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                        <div class="input-group-append">
                            <button type="submit" class="btn" style="background-color: #213555; color: #fff;">
                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Search icon -->
                            </button>
                        </div>
                    </div>
                </div>
            </form>
          </div>

          <style>
            .input-group {
                width: 100%; /* Full width */
                max-width: 200px; /* Set a maximum width for a compact look */
            }

            .input-group .form-control {
                border-radius: 0.25rem 0 0 0.25rem; /* Rounded corners on the left */
                flex: 1; /* Allow input to take up available space */
                height: 30px; /* Set a smaller height for the input field */
                font-size: 0.875rem; /* Smaller font size */
            }

            .input-group .btn {
                border-radius: 0 0.25rem 0.25rem 0; /* Rounded corners on the right */
                background-color: #266278; /* Same button color */
                color: #fff; /* Button text color */
                height: 30px; /* Match the height of the input field */
                padding: 0 10px; /* Smaller padding for a more compact button */
            }

            /* Adjust styles for mobile devices */
            @media (max-width: 576px) {
                .input-group {
                    flex-direction: row; /* Ensure items are in a row */
                    max-width: 180px; /* Set a smaller max width for mobile */
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
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                transform: scale(1.05);
              }

              .edit:hover {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                transform: scale(1.05);
              }
        </style>
        
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                    <thead>
                      <tr style="background-color: #4F709C; color:#ffff;">
                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">No</th>
                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Prestasi</th>
                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Poin</th>
                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Tingkat</th>
                        @if (auth()->check() && auth()->user()->role == 'admin')
                          <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Aksi</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                      @if ($prestasi->isEmpty())
                      <tr>
                          <td colspan="9" style="text-align: center;">Tidak ada data yang ditemukan</td>
                      </tr>
                      @else
                      @foreach ($prestasi as $no => $prestasis)
                        <tr>
                          <td style="text-align: center; vertical-align: middle;">{{$no+1}}</td>
                          <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$prestasis->nama_Prestasi}}</td>
                          <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$prestasis->point}}</td>
                          <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$prestasis->Tingkat}}</td>
                          @if (auth()->check() && auth()->user()->role == 'admin')
                            <td style="text-align: center; vertical-align: middle;">
                              <button class="btn btn-sm editBtnn edit" style="background-color: #213555; color: #fff;" data-id="{{ $prestasis->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                              </button>
                              <form action="{{ route('Poin.destroy', $prestasis->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
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
                                color: #245c70; /* Warna abu-abu */
                                background-color: #f8f9fa; /* Warna latar belakang */
                                border-color: #dee2e6; /* Warna border */
                            }
                    
                            .pagination .page-link:hover {
                                color:#245c70; /* Warna abu-abu yang lebih gelap saat hover */
                                background-color: #e9ecef; /* Latar belakang sedikit lebih gelap */
                                border-color: #dee2e6;
                            }
                        
                            .pagination .active .page-link {
                                color: white; /* Warna teks saat aktif */
                                background-color: #245c70; /* Warna abu-abu saat aktif */
                                border-color: #245c70;
                            }                                            
                        </style>
                        {{ $prestasi->links('pagination::bootstrap-4') }}
                    </div>
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
              window.location.href = "{{ url('/PoinPenebusan') }}";
            }
          });

        document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('tambahDataBtnn').addEventListener('click', function (event) {
                    event.preventDefault(); 
                    fetch('/PoinPenebusan/create')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalBody').innerHTML = html;
                        document.getElementById('dataModalLabel').innerText = 'Tambah Kategori Prestasi';
                        const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                        dataModal.show();
                    })
                    .catch(error => console.error('Error loading create form:', error));
                });
    
            document.querySelectorAll('.editBtnn').forEach(button => {
              button.addEventListener('click', function () {
                const prestasiId = this.getAttribute('data-id');
                
                fetch(`/PoinPenebusan/edit/${prestasiId}`)
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


<script>
  function test(event, formId){
      event.target.setAttribute('disabled','disabled');
      const a =  document.querySelector(`#${formId}`);
      a.submit();
  } 
</script>
  </x-layout>
  
