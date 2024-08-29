<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="/listpelanggaran/search" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </div>
                            </form>

                           
                        </div>
                        
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                            <div class="table table-striped">
                             <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">No</th>
                                            <th style="text-align: center; vertical-align: middle;">NIS</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama</th>
                                            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                            <th style="text-align: center; vertical-align: middle;">Kelas</th>
                                            <th style="text-align: center; vertical-align: middle;">Jenis Pelanggaran</th>
                                            
                                            @if (auth()->user()->role == 'admin')
                                                <th style="text-align: center; vertical-align: middle;">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
            @foreach ($pelanggaran as $no => $p)

                                            <tr>
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
    </div>

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

    
</x-layout>
