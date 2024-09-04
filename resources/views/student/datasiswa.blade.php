<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold" style="margin-top: 7px;">Data Siswa</h3>
                            @if (auth()->user()->role == 'admin')
                            <div class="card-tools">
                                <button class="btn btn-primary" id="tambahDataBtn"><i class="fa-solid fa-circle-plus"></i> Tambah Data</button>
                            </div>
                            @endif
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">No</th>
                                            <th style="text-align: center; vertical-align: middle;">Nis</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama Siswa</th>
                                            <th style="text-align: center; vertical-align: middle;">Kelas</th>
                                            <th class="col-2" style="text-align: center; vertical-align: middle;">Jurusan</th>
                                            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                            @if (auth()->check() && (auth()->user()->role == 'admin'))
                                            <th style="text-align: center; vertical-align: middle;">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentItem as $no => $student)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">{{ $no + 1 }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nis }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nama }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->kelas }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jurusan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jk }}</td>
                                            @if (auth()->check() && (auth()->user()->role == 'admin'))
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button class="btn btn-primary editBtn" data-id="{{ $student->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <form action="{{ route('datasiswa.destroy', $student->id) }}" class="d-inline deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> <!-- Or use an icon -->
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>
        @include('student.confirsiswajs')
</x-layout>