<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                title: "ERROR",
                                text: "{{ session('success') }}",
                                icon: "error"
                            });
                        });
                    </script>
                @endif
                @if ($errors->has('nis'))
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
                        icon: "error",
                        title: " {{ $errors->first('nis') }}"
                    });
                </script>
                 @endif


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

                            .status-badge {
                                display: inline-block;
                                width: 120px;
                                padding: 5px 0; 
                                text-align: center;
                                font-size: 12px; 
                                border-radius: 4px;
                            }

                            .status-badge:hover {
                                transform: translateY(-5px);
                                background: linear-gradient(45deg, #4dacff, #3ecf69);
                            }

                            .btn-primary:hover {
                                transform: translateY(-5px);
                                transition: transform 0.3s ease;
                            }

                            .btn-danger:hover {
                                transform: translateY(-5px);
                                transition: transform 0.3s ease;
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
                    </style>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                @if (auth()->user()->role == 'admin')
                                <button class="btn btn-sm" style="margin-top: 1px; background-color:#245c70; color:#ffff; margin-right: 10px;" id="tambahDataBtn">
                                    <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Add</span>
                                </button>
                                @endif
                            </div>
                            <form action="/datapetugas/search" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn" style="background-color: #266278; color: #fff;">
                                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Search icon -->
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                     
  
                        
                        <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px;  border-radius: 5px 5px 0 0; overflow: hidden;">
                                  <thead>
                                      <tr style="background-color: #4D869C; color:#ffff;">
                                          <td style="text-align: center; vertical-align: middle;" class="py-2">No</td>
                                          <td style="text-align: center; vertical-align: middle;">NIS</td>
                                          <td style="text-align: center; vertical-align: middle;">Nama</td>
                                          <td style="text-align: center; vertical-align: middle;">Kelas</td>
                                          <td style="text-align: center; vertical-align: middle;">Jenis Kelamin</td>
                                          <td style="text-align: center; vertical-align: middle;">Jurusan</td>
                                          <td style="text-align: center; vertical-align: middle;">Organisasi</td>
                                          @if (auth()->user()->role == 'admin')
                                          <td style="text-align: center; vertical-align: middle;">Action</td>
                                          @endif
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @if ($petugas->isEmpty())
                                    <tr>
                                        <td colspan="8" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                    </tr>
                                    @else
                                      @foreach ($petugas as $no => $petugasd)
                                      <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ ($petugas->currentPage() - 1) * $petugas->perPage() + $loop->iteration }}
                                        </td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->nis }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->nama}}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->kelas }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jk }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jurusan }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->namao }}</td>
                                          @if (auth()->user()->role == 'admin')
                                          <td style="text-align: center; vertical-align: middle; ">
                                            <div class="action-buttons">
                                              <button class="btn btn-sm btn-primary editBtn" data-id="{{ $petugasd->id }}">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                              </button>
                                              <form action="{{ route('petugas.delete', $petugasd->id) }}" method="POST" class="d-inline deleteForm">
                                                  @csrf
                                                  
                                                  <button type="submit" class="btn btn-sm btn-danger deleteBtn">
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
                              <div class="d-flex">
                                <div class="ml-auto">
                                    {{ $petugas->links('pagination::bootstrap-4') }}
                                </div>
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
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                </div>
            </div>
        </div> 
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
       document.getElementById('search-input').addEventListener('input', function() {
         if (this.value === '') {
           window.location.href = "{{ url('/datapetugas') }}"; 
         }
       });
   
        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById('tambahDataBtn').addEventListener('click', function (event) {
                event.preventDefault();
                fetch('/datapetugas/tambah')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Petugas';
                    const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                    dataModal.show();
                })
                .catch(error => console.error('Error loading create form:', error));
            });
            document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const petugasId = this.getAttribute('data-id'); 
                fetch(`/datapetugas/edit/${petugasId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Edit Data Petugas';
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