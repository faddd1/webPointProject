<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('listpelanggaran.index')}}" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </div>
                            </form>
                            
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered btn-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">No</th>
                                        <th class="text-center align-middle">Nama Pelapor</th>
                                        <th class="text-center align-middle">Nama</th>
                                        <th class="text-center align-middle">Nama Pelanggaran</th>
                                        <th class="text-center align-middle">Jumlah Point</th>
                                        <th class="text-center align-middle">Tanggal</th>
                                        <th class="text-center align-middle">Bukti</th>
                                        <th class="text-center align-middle">Status</th>
                                        <th class="text-center align-middle">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $no => $student)
                                        <tr>
                                            <td class="text-center align-middle">{{ $no + 1 }}</td>
                                            <td class="text-center align-middle">{{ $student->pelapor->name ?? 'tidak diketahui' }}</td>
                                            <td class="text-center align-middle">{{ $student->nama }}</td>
                                            <td class="text-center align-middle">{{ $student->pelanggaran }}</td>
                                            <td class="text-center align-middle">{{ $student->point }}</td>
                                            <td class="text-center align-middle">{{ $student->tanggal }}</td>
                                            <td class="text-center align-middle">
                                                @if ($student->bukti)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $student->id }}">
                                                        <img src="{{ asset('uploads/' . $student->bukti) }}" alt="Bukti {{ $student->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;">
                                                    </a>
                                
                                                    <!-- Bootstrap Modal -->
                                                    <div class="modal fade" id="imageModal-{{ $student->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $student->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <img src="{{ asset('uploads/' . $student->bukti) }}" alt="Bukti {{ $student->nama }}" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                {{-- Kolom Status --}}
                                                @if ($student->status == 'Diterima')
                                                    <span class="badge" style="background: rgb(50, 202, 50); color:#000;">Laporan Diterima</span>
                                                @elseif ($student->status == 'Laporan Tidak Valid')
                                                    <span class="badge" style="background: rgb(255, 80, 80); color:#000;">Laporan Ditolak</span>
                                                @else
                                                    <span class="badge" style="background: #fffb07; color:#000;">Menunggu Verifikasi</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('listpelanggaran.destroy', $student->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
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
                                    {{ $students->links('pagination::bootstrap-4') }}
                                </div>
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
        document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/listpelanggaran') }}"; // Kembali ke data semula
      }
    });
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
