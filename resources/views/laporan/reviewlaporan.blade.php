<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <script>
                            const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                            });
                            Toast.fire({
                            icon: "success",
                            title: " {{ session('success') }}"
                            });
                         </script>
                    @endif

                    <style>
                        .btn-primary:hover {
                            transform: translateY(-5px);
                        }

                        .btn-danger:hover {
                            transform: translateY(-5px);
                        }

                        .btn-success:hover {
                            transform: translateY(-5px);
                        }
                        
                        .action-buttons {
                            display: flex;
                            justify-content: center;
                            gap: 5px;
                        }

                        
                        @media (max-width: 576px) {
                            .action-buttons {
                                flex-direction: row; 
                            }
                        }
                    </style>

                    <div class="card">
                        <div class="card-header">
                            {{-- <h3>Laporan Menunggu Review</h3> --}}
                            <h4 class="text-md mt-2">Tanggal <span class="text-bold">{{ \Carbon\Carbon::now()->format('j F Y') }}</span></h4>
                        </div>

                        <div class="card-body">
                            @if($reports->isEmpty())
                                <p class="text-center">Tidak ada laporan yang menunggu verifikasi.</p>
                            @else
                             
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 15px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                        <thead>
                                            <tr style="background-color: #4D869C; color:#ffff;">
                                                <td class="text-center align-middle" class="py-2">No</td>
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
                                            @foreach($reports as $no => $report)
                                                <tr>
                                                    <td class="text-center align-middle">{{ $no + 1 }}</td>
                                                    <td class="text-center align-middle">{{ $report->pelapor->name ?? 'tidak diketahui' }}</td>
                                                    <td class="text-center align-middle">{{ $report->nama }}</td>
                                                    <td class="text-center align-middle">{{ $report->pelanggaran }}</td>
                                                    <td class="text-center align-middle">{{ $report->point }}</td>
                                                    <td class="text-center align-middle">{{ $report->tanggal }}</td>
                                                    <td class="text-center align-middle">
                                                        @if ($report->bukti)
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $report->id }}">
                                                                <img src="{{ asset('uploads/' . $report->bukti) }}" alt="Bukti {{ $report->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;">
                                                            </a>

                                                           
                                                            <div class="modal fade" id="imageModal-{{ $report->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $report->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <img src="{{ asset('uploads/' . $report->bukti) }}" alt="Bukti {{ $report->nama }}" class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="action-buttons">
                                                            <form action="{{ route('laporan.approve', $report->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                                                            </form>

                                                            <form action="{{ route('laporan.notApprove', $report->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('POST')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-minus "></i></button>
                                                            </form>

                                                            <button class="btn btn-success btn-sm showBtn" data-id="{{ $report->id }}"><i class="fa-solid fa-eye"></i></button>
                                                        </div>
                                                    </td>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                   
                </div>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.showBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const reportId = this.getAttribute('data-id');
                    fetch(`/laporan/show/${reportId}`) 
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalBody').innerHTML = html; 
                            document.getElementById('dataModalLabel').innerText = 'Detail Data Siswa';
                            new bootstrap.Modal(document.getElementById('dataModal')).show();
                        })
                        .catch(error => console.error('Error loading edit form:', error));
                });
            });

            document.querySelectorAll('.deleteForm').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Hapus Data',
                            text: "Apakah Anda yakin ingin menghapus data ini?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); 
                            }
                        });
                    });
                });
        });
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
