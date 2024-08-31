<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
<<<<<<< Updated upstream
                            <form action="/listpelanggaran/search" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
=======
                            <form method="GET" action="{{ route('listpelanggaran.index') }}">
                                <div class="card-item d-flex flex-wrap">
                                    <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="kelas">
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
                                        <option value="DPIB 1" {{ request('jurusan') == 'DPIB 1' ? 'selected' : '' }}>DPIB 1</option>
                                        <option value="DPIB 2" {{ request('jurusan') == 'DPIB 2' ? 'selected' : '' }}>DPIB 2</option>
                                        <option value="MP 1" {{ request('jurusan') == 'MP 1' ? 'selected' : '' }}>MP 1</option>
                                        <option value="MP 2" {{ request('jurusan') == 'MP 2' ? 'selected' : '' }}>MP 2</option>
                                        <option value="AK 1" {{ request('jurusan') == 'AK 1' ? 'selected' : '' }}>AK 1</option>
                                        <option value="AK 2" {{ request('jurusan') == 'AK 2' ? 'selected' : '' }}>AK 2</option>
                                        <option value="SK 1" {{ request('jurusan') == 'SK 1' ? 'selected' : '' }}>SK 1</option>
                                        <option value="SK 2" {{ request('jurusan') == 'SK 2' ? 'selected' : '' }}>SK 2</option>
                                    </select>

                                    {{-- <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="kelas">
                                        <option>Kelas berapa</option>
                                        <option value="1" {{ request('kelas') == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ request('kelas') == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ request('kelas') == '3' ? 'selected' : '' }}>3</option>
                                    </select> --}}

>>>>>>> Stashed changes
                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Jumlah Point</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($students as $studentlist)
                                            <tr>
<<<<<<< Updated upstream
                                                <td style="text-align: center; vertical-align: middle;">{{ $no+1 }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $p->nis }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $p->nama }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $p->jk }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $p->kelas }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $p->jenis }}</td>
                                               <td style="text-align: center; vertical-align: middle;">
                                                <button data-id="{{ $p->id }}" data-target="#showDataModal" data-toggle="modal" class="btn btn-info btn-show">Show</button>
                                                @include('listpelanggaran.modal_edit')
                                               </td>
=======
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $studentlist->nis }}</td>
                                                <td>{{ $studentlist->nama }}</td>
                                                <td>{{ $studentlist->kelas }}</td>
                                                <td>{{ $studentlist->jurusan }}</td>
                                                <td>{{ $studentlist->point }}</td>
                                                <td>
                                                    <!-- Add action buttons if needed -->
                                                </td>
>>>>>>> Stashed changes
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pelanggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('listpelanggaran.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Pelanggaran</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('.btn-show').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/pelanggaran/' + id, // Sesuaikan dengan rute yang akan digunakan untuk mengambil data
            method: 'GET',
            success: function(response) {
                $('#dataDetail').html(response);
            },
            error: function() {
                $('#dataDetail').html('<p>Terjadi kesalahan saat memuat data.</p>');
            }
        });
    });
});
</script>
<script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/listpelanggaran') }}"; // Kembali ke data semula
      }
    });
  </script>

    
=======
>>>>>>> Stashed changes
</x-layout>
