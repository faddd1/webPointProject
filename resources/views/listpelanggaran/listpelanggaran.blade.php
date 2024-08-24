<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- @if (auth()->check() && (auth()->user()->role == 'admin') )
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                                    Tambah Data
                                </button>
                            @endif --}}
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
            @foreach ($pelanggaran as $no => $pelanggaran)

                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">{{ $no+1 }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->nis }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->nama }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->jk }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->kelas }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $pelanggaran->jenis }}</td>
                                               <td style="text-align: center; vertical-align: middle;">
                                                <button data-id="{{ $pelanggaran->id }}" data-target="#showDataModal" data-toggle="modal" class="btn btn-info btn-show">Show</button>

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
    <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('listpelanggaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jk" name="jk" required>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Pelanggaran</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="point">Point</label>
                            <input type="number" class="form-control" id="point" name="point" required>
                        </div>
                        <div class="form-group">
                            <label for="pelapor">Pelapor</label>
                            <input type="text" class="form-control" id="pelapor" name="pelapor" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="bukti">Bukti (Foto/PDF)</label>
                            <input type="file" class="form-control-file" id="bukti" name="bukti">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showDataModal" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showDataModalLabel">Detail Data Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div id="dataDetail"><div>
                        <p><strong>NIS:</strong> {{ $pelanggaran->nis }}</p>
                        <p><strong>Nama:</strong> {{ $pelanggaran->nama }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $pelanggaran->jk }}</p>
                        <p><strong>Kelas:</strong> {{ $pelanggaran->kelas }}</p>
                        <p><strong>Jenis Pelanggaran:</strong> {{ $pelanggaran->jenis }}</p>
                        <p><strong>Point:</strong> {{ $pelanggaran->point }}</p>
                        <p><strong>Pelapor:</strong> {{ $pelanggaran->pelapor }}</p>
                        <p><strong>Tanggal:</strong> {{ $pelanggaran->tanggal }}</p>
                        <p><strong>Bukti:</strong> <a href="{{ asset('storage/' . $pelanggaran->bukti) }}" target="_blank">Lihat Bukti</a></p>
</div>
</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
