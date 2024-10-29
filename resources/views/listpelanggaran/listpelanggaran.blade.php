<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-center text-md-start">
                        <span class="btn d-flex align-items-center" style=" margin-bottom: 0; font-size: 0.9rem; color: #6c757d; background: #e2e1e1; padding: 5px 10px; border-radius: 5px;">
                            <i class="fas fa-calendar-alt" id="dateIcon" style="font-size: 13px; margin-right: 5px;"></i>
                            <span id="date" style="font-weight: bold;"></span>
                        </span>
                    </div>
                    
                    <form id="exportPdfForm" action="/export-list-pdf" method="GET" class="row mt-4 g-3 p-3 bg-light rounded shadow-sm">
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <label for="start_date" class="form-label">Tanggal Awal</label>
                            <div class="input-group">
                                <span class="input-group-text" style="color: #213555; "><i class="fas fa-calendar-day"></i></span>
                                <input type="date" id="start_date" name="start_date" class="form-control" required placeholder="Pilih tanggal awal">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3 mb-md-0">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <div class="input-group">
                                <span class="input-group-text" style="color: #213555; "><i class="fas fa-calendar-day"></i></span>
                                <input type="date" id="end_date" name="end_date" class="form-control" required placeholder="Pilih tanggal akhir">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-end">
                            <button type="submit" id="downloadBtn" class="btn btn-danger shadow" style="transition: background-color 0.3s;">
                                <i class="fas fa-file-pdf"></i><span style="font-size: 13px; margin-left: 5px;"> Download Pdf</span>
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
                                    <div class="input-group" style="width: 100%;  max-width: 200px;">
                                        <input type="search" class="form-control" style="border-radius: 0.25rem 0 0 0.25rem; flex: 1; height: 30px; font-size: 0.875rem; " name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn-sm btn" style="background-color: #213555; color: #fff;">
                                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Search icon -->
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>

                        <div class="card-body">
                            <style>
                                
                                .bukti-image {
                                    width: 50px;     
                                    height: 50px;   
                                    object-fit: cover; 
                                    aspect-ratio: 1/1; 
                                    border-radius: 0.25rem; 
                                }

                                @media (max-width: 576px) {
                                    .bukti-image {
                                        width: 40px;  
                                        height: 40px; 
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
                                    transform: scale(1.05);
                                    background: linear-gradient(45deg, #4dacff, #3ecf69);
                                    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                                }

                                /* .btn-danger:hover {
                                    transform: scale(1.05);
                                    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                                    align-content: center; 
                                }*/
                            </style>
                            <div class="table-responsive table-scrollable" style="overflow-x: auto;">
                                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                    <thead>
                                        <tr style="background-color: #4F709C; color:#ffff;">
                                            <th class="text-center align-middle">No</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelapor</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelanggaran</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Jumlah Point</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Bukti</th>
                                            <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Status</th>
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
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $no + 1 }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $student->pelapor->name ?? 'tidak diketahui' }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $student->nama }}</td>
                                                <td style=" vertical-align: middle;">{{ $student->pelanggaran }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $student->point }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{  \Carbon\Carbon::parse($student->tanggal)->format('j F Y') }}</td>
                                                <td class="col-2 text-center align-middle">
                                                    @if ($student->bukti)
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $student->id }}">
                                                            <div style="width: 50px; height: 50px; overflow: hidden; display: inline-block;">
                                                                <img src="{{ asset('uploads/' . $student->bukti ?? 'tidak ada bukti') }}" alt="Bukti {{ $student->nama }}" class="img-thumbnail bukti-image" style="width: 100%; height: auto; cursor: pointer;">
                                                            </div>
                                                        </a>
                                                
                                                        <!-- Modal to show full image -->
                                                        <div class="modal fade" id="imageModal-{{ $student->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $student->id }}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-body text-center">
                                                                        <img src="{{ asset('uploads/' . $student->bukti) }}" alt="Bukti {{ $student->nama }}" class="img-fluid" style="max-width: 100%; height: auto;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                
                                                
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                    @if ($student->status == 'Diterima')
                                                        <span class="badge status-badge" style="background: rgb(50, 202, 50); color:#000;">Laporan Diterima</span>
                                                    @elseif ($student->status == 'Laporan Tidak Valid')
                                                        <span class="badge status-badge" style="background: rgb(255, 80, 80); color:#000;">Laporan Ditolak</span>
                                                    @else
                                                        <span class="badge status-badge" style="background: #fde37d; color:#000;">Menunggu Verifikasi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>                                
                                </table>
                            </div>   
                        </div>
                        <style>
                            .pagination .page-link {
                                color:  #4F709C; /* Warna abu-abu */
                                background-color: #f8f9fa; /* Warna latar belakang */
                                border-color: #dee2e6; /* Warna border */
                            }
                    
                            .pagination .page-link:hover {
                                color: #4F709C;/* Warna abu-abu yang lebih gelap saat hover */
                                background-color: #e9ecef; /* Latar belakang sedikit lebih gelap */
                                border-color: #dee2e6;
                            }
                        
                            .pagination .active .page-link {
                                color: white; /* Warna teks saat aktif */
                                background-color: #4F709C; /* Warna abu-abu saat aktif */
                                border-color:  #4F709C;
                            }                                            
                        </style>
                        <div class="card-footer mt-3" style="background: #fff;">
                            <div class="d-flex">
                                <div class="ml-auto">
                                    {{ $students->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                            @if (!$pelanggaranPerHari->isEmpty())
                                <div class="table-responsive mt-3">
                                    <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                        <thead>
                                            <tr style="background-color: #4F709C;  color:#ffff;">
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">No</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pelanggaranPerHari as $no=>$item)
                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $no+1 }}</td>
                                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ \Carbon\Carbon::parse($item->tanggal)->format('j F Y') }}</td>
                                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->total }}</td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div> 
                            @endif
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
</script>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Get the values of start_date and end_date fields
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        // Check if both dates are selected
        if (!startDate || !endDate) {
            Swal.fire({
                title: 'Tanggal Belum Dipilih!',
                text: "Silakan pilih tanggal awal dan akhir sebelum mendownload.",
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        } else {
            // If dates are valid, show the confirmation dialog
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
        }
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
    document.getElementById('date').textContent = `${day} ${month} ${year}`;
</script>
    
</x-layout>
