<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="container-fluid">
      <div class="col-12">
          <div class="row">
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
                  <div class="card">
                      <div class="card-header">
                          <div class="card-tools">
                              @if (auth()->user()->role == 'admin')
                              <button class="btn btn-sm" style="margin-top: 1px; background-color:#245c70; color:#ffff; margin-right: 10px;" id="tambahDataBtn">
                                <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Add</span>
                              </button>
                              @endif
                          </div>
                          <form action="/teacher/search" class="form-inline" method="GET">
                            <div class="card-item d-flex">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn" style="background-color: #266278; color: #fff;">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
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
                                transition: transform 0.5s ease;
                            }

                            .btn-danger:hover {
                                transform: translateY(-5px);
                                transition: transform 0.5s ease;
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

                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #4D869C; color:#ffff;">
                                        <th style="text-align: center; vertical-align: middle;" class="py-2">No</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">NIP</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Guru</th>
                                        <th class="col-2" style="text-align: center; vertical-align: middle; white-space: nowrap;">Jabatan</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Jenis Kelamin</th>
                                        @if (auth()->user()->role == 'admin')
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($teacher->isEmpty())
                                    <tr>
                                        <td colspan="6" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                    </tr>
                                    @else
                                    @foreach ($teacher as  $teachers)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ ($teacher->currentPage() - 1) * $teacher->perPage() + $loop->iteration }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $teachers->nis }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $teachers->namaguru }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $teachers->jabatan }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $teachers->jk }}</td>
                                        @if (auth()->user()->role == 'admin')
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                            <div class="action-buttons">
                                            <button class="btn btn-primary editBtn btn-sm" data-id="{{ $teachers->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('destroy.guru', $teachers->id) }}" method="POST" class="d-inline deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn">
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
                                {{ $teacher->links('pagination::bootstrap-4') }}
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
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Siswa</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="modal-body" id="modalBody">
                
                </div>
            </div>
        </div>
    </div>
    
@include('teacher.confirgurujs')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
  <script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/teacher') }}";
      }
    });
</script>
</x-layout>

