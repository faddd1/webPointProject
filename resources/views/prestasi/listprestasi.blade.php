<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('listprestasi.prestasi')}}" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn" style="background-color: #266278; color: #fff;">
                                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Search icon -->
                                            </button>
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

                                .status-badge {
                                    font-size: 12px;
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
                                    transition: transform 0.5s ease;
                                }

                                .btn-danger:hover {
                                    transform: translateY(-5px);
                                    transition: transform 0.5s ease;
                                    align-content: center;
                                }
                            </style>
                            
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                    <thead>
                                        <tr style="background-color: #4D869C; color:#ffff;">
                                            <td class="text-center align-middle" class="py-2">No</td>
                                            <td class="text-center align-middle">NIS</td>
                                            <td class="text-center align-middle">Nama</td>
                                            <td class="text-center align-middle">Nama Prestasi</td>
                                            <td class="text-center align-middle">Jumlah Point</td>
                                            <td class="text-center align-middle">Tanggal</td>
                                            <td class="text-center align-middle">Bukti</td>
                                            <td class="text-center align-middle">Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($prestasis->isEmpty())
                                        <tr>
                                            <td colspan="9" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                        </tr>
                                        @else
                                        @foreach($prestasis as $no => $prestasi)
                                            <tr>
                                                <td class="text-center align-middle">{{ $no + 1 }}</td>
                                                <td class="text-center align-middle">{{ $prestasi->nis}}</td>
                                                <td class="text-center align-middle">{{ $prestasi->nama }}</td>
                                                <td class="text-center align-middle">{{ $prestasi->nama_Prestasi }}</td>
                                                <td class="text-center align-middle">{{ $prestasi->point }}</td>
                                                <td class="text-center align-middle">{{ $prestasi->tanggal }}</td>
                                                <td class="text-center align-middle">
                                                    @if ($prestasi->bukti)
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $prestasi->id }}">
                                                            <img src="{{ asset('uploads/' . $prestasi->bukti) }}" alt="Bukti {{ $prestasi->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;">
                                                        </a>
                                    
                                                    
                                                        <div class="modal fade" id="imageModal-{{ $prestasi->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $prestasi->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <img src="{{ asset('uploads/' . $prestasi->bukti) }}" alt="Bukti {{ $prestasi->nama }}" class="img-fluid">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($prestasi->status == 'Diterima')
                                                        <span class="badge status-badge" style="background: rgb(50, 202, 50); color:#000;">Laporan Diterima</span>
                                                    @elseif ($prestasi->status == 'Laporan Tidak Valid')
                                                        <span class="badge status-badge" style="background: rgb(255, 80, 80); color:#000;">Laporan Ditolak</span>
                                                    @else
                                                        <span class="badge status-badge" style="background: #fffb07; color:#000;">Menunggu Verifikasi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>                                
                                </table>
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        {{ $prestasis->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
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
        window.location.href = "{{ url('/listprestasi') }}";
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
            url: '/pelanggaran/' + id, 
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
{{-- <script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/listpelanggaran') }}"; 
      }
    });
  </script> --}}

    
</x-layout>