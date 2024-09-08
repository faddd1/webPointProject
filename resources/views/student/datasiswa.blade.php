
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
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
                    <div class="card">
                        <div class="card-header">
                            @if (auth()->user()->role == 'admin')
                            <div class="card-tools">
                                <button class="btn btn-sm btn-primary" style="margin-top: 10px;" id="tambahDataBtn"><i class="fa-solid fa-circle-plus"></i> Add</button>
                            </div>
                            @endif
                       
                        <form method="GET" action="{{ route('student.searchSiswa') }}">
                            <div class="card-item d-flex flex-wrap mt-2">
                                <input type="text" class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="nama" placeholder="Nama Siswa" value="{{ request('nama') }}">
                                <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="kelas" style="max-width: 120px;">
                                    <option>PILIH KELAS</option>
                                    <option value="10" {{ request('kelas') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="11" {{ request('kelas') == '11' ? 'selected' : '' }}>11</option>
                                    <option value="12" {{ request('kelas') == '12' ? 'selected' : '' }}>12</option>
                                </select>
                        
                                <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="jurusan">
                                    <option>PILIH JURUSAN</option>
                                    <option value="TKR 1" {{ request('jurusan') == 'TKR 1' ? 'selected' : '' }}>TKR 1</option>
                                    <option value="TKR 2" {{ request('jurusan') == 'TKR 2' ? 'selected' : '' }}>TKR 2</option>
                                    <option value="TKR 3" {{ request('jurusan') == 'TKR 3' ? 'selected' : '' }}>TKR 3</option>
                                    <option value="TKJ 1" {{ request('jurusan') == 'TKJ 1' ? 'selected' : '' }}>TKJ 1</option>
                                    <option value="TKJ 2" {{ request('jurusan') == 'TKJ 2' ? 'selected' : '' }}>TKJ 2</option>
                                    <option value="TKJ 3" {{ request('jurusan') == 'TKJ 3' ? 'selected' : '' }}>TKJ 3</option>
                                    <option value="PPLG 1" {{ request('jurusan') == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
                                    <option value="PPLG 2" {{ request('jurusan') == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
                                    <option value="PPLG 3" {{ request('jurusan') == 'PPLG 3' ? 'selected' : '' }}>PPLG 3</option>
                                    <option value="MPLB 1" {{ request('jurusan') == 'MPLB 1' ? 'selected' : '' }}>MPLB 1</option>
                                    <option value="MPLB 2" {{ request('jurusan') == 'MPLB 2' ? 'selected' : '' }}>MPLB 2</option>
                                    <option value="DPIB 1" {{ request('jurusan') == 'DPIB 1' ? 'selected' : '' }}>DPIB 1</option>
                                    <option value="DPIB 2" {{ request('jurusan') == 'DPIB 2' ? 'selected' : '' }}>DPIB 2</option>
                                    <option value="AK 1" {{ request('jurusan') == 'AK 1' ? 'selected' : '' }}>AK 1</option>
                                    <option value="AK 2" {{ request('jurusan') == 'AK 2' ? 'selected' : '' }}>AK 2</option>
                                    <option value="SP 1" {{ request('jurusan') == 'SP 1' ? 'selected' : '' }}>SP 1</option>
                                    <option value="SP 2" {{ request('jurusan') == 'SP 2' ? 'selected' : '' }}>SP 2 </option>
                                    <!-- Opsi lainnya... -->
                                </select>
                        
                                <button type="submit" class="btn btn-primary mb-2 mr-2">Cari</button>
                        
                                <!-- Tambahkan tombol "Clear" -->
                                <a href="{{ route('student.searchSiswa') }}" class="btn btn-danger mb-2">Clear</a>
                            </div>
                        </form>
                    </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm" id="studentTable">
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
                                        @foreach ($studentItem as $student)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ ($studentItem->currentPage() - 1) * $studentItem->perPage() + $loop->iteration }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nis }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nama }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->kelas }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jurusan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jk }}</td>
                                            @if (auth()->check() && (auth()->user()->role == 'admin'))
                                            <td style="text-align: center; vertical-align: middle;">
                                                <button class="btn btn-primary btn-sm editBtn" data-id="{{ $student->id }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>

                                                <form action="{{ route('datasiswa.destroy', $student->id) }}" class="d-inline deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        {{ $studentItem->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>



    @include('student.confirsiswajs')
</x-layout>
