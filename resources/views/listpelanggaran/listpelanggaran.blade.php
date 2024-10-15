<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-center text-md-start">
                        <span class="btn" style="font-style: italic; margin-bottom: 0; font-size: 0.9rem; color: #6c757d; background:#e2e1e1">
                            <i class="fas fa-calendar-alt"></i> 8 Oktober 2024
                        </span>
                    </div>
            
                   <!-- Date filter form -->
                   <form action="/export-list-pdf" method="GET" class="row mt-4 g-3">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <label for="start_date" class="form-label">Tanggal Awal</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            <input type="date" id="start_date" name="start_date" class="form-control" required placeholder="Pilih tanggal awal">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                            <input type="date" id="end_date" name="end_date" class="form-control" required placeholder="Pilih tanggal akhir">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-end">
                        <button type="submit" class="btn btn-danger" style="transition: background-color 0.3s;">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </button>
                    </div>
                </form>

                </div>
            </div>
            
            
            
            </div>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('listpelanggaran.index')}}" class="form-inline" method="GET">
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
                            
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                    <thead>
                                        <tr style="background-color: #4D869C; color:#ffff;">
                                            <td class="text-center align-middle">No</td>
                                            <td class="text-center align-middle">Nama Pelapor</td>
                                            <td class="text-center align-middle">Nama</td>
                                            <td class="text-center align-middle">Nama Pelanggaran</td>
                                            <td class="text-center align-middle">Jumlah Point</td>
                                            <td class="text-center align-middle">Tanggal</td>
                                            <td class="text-center align-middle">Bukti</td>
                                            <td class="text-center align-middle">Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($students->isEmpty())
                                        <tr>
                                            <td colspan="9" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                        </tr>
                                        @else
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
                                                    @if ($student->status == 'Diterima')
                                                        <span class="badge status-badge" style="background: rgb(50, 202, 50); color:#000;">Laporan Diterima</span>
                                                    @elseif ($student->status == 'Laporan Tidak Valid')
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
                                        {{ $students->links('pagination::bootstrap-4') }}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                            <thead>
                                                <tr style="background-color: #4D869C; color:#ffff;">
                                                    <td class="text-center align-middle">No</td>
                                                    <td class="text-center align-middle">Tangal</td>
                                                    <td class="text-center align-middle">Jumlah</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($pelanggaranPerHari->isNotEmpty())
                                                @foreach ($pelanggaranPerHari as $no=>$item)
                                                    <tr>
                                                        <td class="text-center align-middle">{{ $no+1 }}</td>
                                                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                                        <td class="text-center align-middle">{{ $item->total }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center">Tidak ada data pelanggaran.</td>
                                                </tr>
                                            @endif                 
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
    </div>

   
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel"></h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/listpelanggaran') }}";
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
</script>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission

        Swal.fire({
            title: 'Anda yakin?',
            text: "Apakah anda yakin ingin mendownload data ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, download!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form after confirmation
                document.getElementById('exportPdfForm').submit();
            }
        });
    });
</script>



<script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/listpelanggaran') }}"; 
      }
    });
  </script>
<script>
    // Fungsi untuk mendapatkan nama bulan
    function getMonthName(monthIndex) {
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 
            'Mei', 'Juni', 'Juli', 'Agustus', 
            'September', 'Oktober', 'November', 'Desember'
        ];
        return months[monthIndex];
    }

    // Mengambil tanggal saat ini
    const now = new Date();
    const day = now.getDate();
    const month = getMonthName(now.getMonth());
    const year = now.getFullYear();

    // Mengupdate elemen dengan ID 'date'
    document.getElementById('date').textContent = ` ${day} ${month} ${year}`;
</script>
    
</x-layout>
