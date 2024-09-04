<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3>Laporan Menunggu Review</h3>
                            <h4 class="text-md py-2">Tanggal <span class="text-bold">{{ \Carbon\Carbon::now()->format('j F Y') }}</span></h4>
                        </div>

                        <div class="card-body">
                            @if($reports->isEmpty())
                                <p class="text-center">Tidak ada laporan yang menunggu verifikasi.</p>
                            @else
                                <!-- Membuat tabel responsif -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
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

                                                            <!-- Bootstrap Modal -->
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
                                                        <form action="{{ route('laporan.approve', $report->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                                                        </form>

                                                        <form action="{{ route('laporan.notApprove', $report->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-circle-minus "></i></button>
                                                        </form>

                                                        <button class="btn btn-success showBtn" data-id="{{ $report->id }}"><i class="fa-solid fa-eye"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- Akhir dari div.table-responsive -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Show Laporan --}}
    
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> <!-- Or use an icon -->
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.showBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const reportId = this.getAttribute('data-id');
                    fetch(`/laporan/show/${reportId}`) // Fetch the edit form for the specific student
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalBody').innerHTML = html; // Load edit form
                            document.getElementById('dataModalLabel').innerText = 'Detail Data Siswa';
                            new bootstrap.Modal(document.getElementById('dataModal')).show();
                        })
                        .catch(error => console.error('Error loading edit form:', error));
                });
            });

            document.querySelectorAll('.deleteForm').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the form from submitting
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
                                form.submit(); // Submit the form
                            }
                        });
                    });
                });
        });
    </script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</x-layout>
