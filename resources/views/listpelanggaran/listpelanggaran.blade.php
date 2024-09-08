<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="GET" action="{{ route('listpelanggaran.index') }}">
                                <div class="card-item d-flex flex-wrap">
                                    <input type="text" class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="nama" placeholder="Nama Siswa" value="{{ request('nama') }}">
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
                                    <a href="{{ route('listpelanggaran.index') }}" class="btn btn-danger mb-2">Clear</a>
                                </div>
                            </form>
                            
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">No</th>
                                            <th style="text-align: center; vertical-align: middle;">Nis</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama</th>
                                            <th style="text-align: center; vertical-align: middle;">Kelas</th>
                                            <th style="text-align: center; vertical-align: middle;">Jurusan</th>
                                            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                            <th style="text-align: center; vertical-align: middle;">Point</th>
                                            <th style="text-align: center; vertical-align: middle;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $no => $studentlist)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle;">{{ $no+1 }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->nis }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->nama }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->kelas }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->jurusan }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->jk }}</td>
                                                <td style="text-align: center; vertical-align: middle;">{{ $studentlist->point }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <button class="btn btn-sm btn-success showBtn" data-id="{{ $studentlist->id }}"><i class="fa-solid fa-eye"></i></button>
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

    <!-- Modal untuk menampilkan data siswa -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.showBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const studentlistId = this.getAttribute('data-id');
                    fetch(`/listpelanggaran/show/${studentlistId}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalBody').innerHTML = html;
                            document.getElementById('dataModalLabel').innerText = 'Detail List Pelanggaran Siswa';
                            new bootstrap.Modal(document.getElementById('dataModal')).show();
                        })
                        .catch(error => console.error('Error loading data:', error));
                });
            });
        });
    


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
