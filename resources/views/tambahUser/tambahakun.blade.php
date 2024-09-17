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
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-bordered" style="background: #e31414; color:#fff;" id="btn-siswa">Siswa</button>
                            <button type="button" class="btn btn-sm" style="background: #ffce1f; color:#fff;" id="btn-guru">Guru</button>
                            <button type="button" class="btn btn-sm" style="background: #161D6F; color: #fff;" id="btn-petugas">Petugas</button>
                        </div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-sm" id="tambahDataBtn"><i class="fa-solid fa-user-plus"></i> Add</button>
                        </div>
                    </div> 

                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center; vertical-align: middle;">Nama</th>
                                        <th style="text-align: center; vertical-align: middle;">Username</th>
                                        <th style="text-align: center; vertical-align: middle;">Password</th>
                                        <th style="text-align: center; vertical-align: middle;">Role</th>
                                        <th style="text-align: center; vertical-align: middle;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="user-table-body">

                                    @foreach( $data as $datas)
                                        
                                
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $datas->name }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $datas->nis }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $datas->plain_password }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $datas->role }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button data-id="{{ $datas->id }}" class="btn btn-sm btn-primary editBtn"><i class="fa-solid fa-pen-to-square "></i></button>
                                            <form action="{{ route('tambah.destroy', $datas->id )}}" class="d-inline col-mb-2 deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex">
                                <div class="ml-auto">
                                    {{ $data->links('pagination::bootstrap-4') }}
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
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="dataModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                </div>
            </div>
        </div>
    </div>



@include('tambahUser.confiruserjs')
</x-layout>


