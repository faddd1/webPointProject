<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-13">
                @if (session('success'))
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
                        icon: "success",
                        title: " {{ session('success') }}"
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
                    .btn-danger:hover {
                        transition: transform 0.5s ease;
                        transform: translateY(-5px);
                    }

                    .edit:hover {
                        transition: transform 0.5s ease;
                        transform: translateY(-5px);
                    }

                    .card-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        flex-wrap: nowrap; 
                    }

                    .card-header .btn-group {
                        flex: 1; 
                        margin-right: 15px;
                    }

                    #tambahDataBtn {
                        margin-left: auto;
                    }

                    @media (max-width: 576px) {
                        .card-header {
                            flex-wrap: wrap; 
                        }
                        .btn-group {
                            flex: 1 1 auto;
                            margin-bottom: 10px;
                            margin-top: 10px;
                        }
                        #tambahDataBtn {
                            margin-left: 0;
                            flex-basis: auto; 
                        }
                    }



                </style>
                <div class="card">
                    <div class="card-header">
                        <form action="tambahSiswa/search" class="form-inline" method="GET">
                            <div class="card-item d-flex">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn" style="background-color: #213555; color: #fff;">
                                            <i class="fa-solid fa-magnifying-glass"></i> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    
                    

                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #4F709C; color:#ffff;">
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;" class="py-2">No</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">NIS</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Password</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Role</th>
                                        <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="user-table-body">

                                    @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="9" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                    </tr>
                                    @else
                                    @foreach( $data as $datas)
                                        
                                
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $datas->name }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $datas->nis }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $datas->plain_password }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $datas->role }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                            <div class="action-buttons">
                                            <button data-id="{{ $datas->id }}" class="btn btn-sm editBtn edit" style="background-color: #213555; color: #fff;"><i class="fa-solid fa-pen-to-square "></i></button>
                                            <form action="{{ route('tambahSiswa.destroy', $datas->id )}}" class="d-inline col-mb-2 deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> </button>
                                            </form>
                                            </div>
                                        </td>
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
                                        background-color: #4F709C; /* Warna abu-abu saat aktif */
                                        border-color: #4F709C;
                                    }                                            
                                </style>
                                {{ $data->links('pagination::bootstrap-4') }}
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
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="dataModalLabel"></h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-arrow-right"></i></a>
                    
                </div>
                <div class="modal-body" id="modalBody">
                </div>
            </div>
        </div>
    </div>



@include('tambahUserSiswa.confiruserjs')
<script>
        document.getElementById('search-input').addEventListener('input', function() {
            if (this.value === '') {
                window.location.href = "{{ url('/tambahSiswa') }}";
            }
            });
</script>
</x-layout>