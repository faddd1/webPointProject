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

                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-md py-2">Tanggal <span class="text-bold">{{ \Carbon\Carbon::now()->format('j F Y') }}</span></h4>
                        </div>

                        <div class="card-body">
                            @if($penebusan->isEmpty())
                                <p class="text-center">Tidak ada penebusan yang menunggu verifikasi.</p>
                            @else
                             
                                <div class="table-responsive">
                                    <table class="table table-bordered btn-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                        <thead>
                                            <tr style="background-color: #4D869C; color:#ffff;">
                                                <td class="text-center align-middle">No</td>
                                                <td class="text-center align-middle">Nama Pelapor</td>
                                                <td class="text-center align-middle">Nama</td>
                                                <td class="text-center align-middle">Nama nama_Prestasi</td>
                                                <td class="text-center align-middle">Jumlah Point</td>
                                                <td class="text-center align-middle">Tanggal</td>
                                                <td class="text-center align-middle">Bukti</td>
                                                <td class="text-center align-middle">Status</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($penebusan as $no => $penebusan)
                                                <tr>
                                                    <td class="text-center align-middle">{{ $no + 1 }}</td>
                                                    <td class="text-center align-middle">{{ $penebusan->pelapor->name ?? 'tidak diketahui' }}</td>
                                                    <td class="text-center align-middle">{{ $penebusan->nama }}</td>
                                                    <td class="text-center align-middle">{{ $penebusan->nama_Prestasi }}</td>
                                                    <td class="text-center align-middle">{{ $penebusan->point }}</td>
                                                    <td class="text-center align-middle">{{ $penebusan->tanggal }}</td>
                                                    <td class="text-center align-middle">
                                                        @if ($penebusan->bukti)
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $penebusan->id }}">
                                                                <img src="{{ asset('uploads/' . $penebusan->bukti) }}" alt="Bukti {{ $penebusan->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;">
                                                            </a>

                                                           
                                                            <div class="modal fade" id="imageModal-{{ $penebusan->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $penebusan->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <img src="{{ asset('uploads/' . $penebusan->bukti) }}" alt="Bukti {{ $penebusan->nama }}" class="img-fluid">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <form action="{{ route('penebusan.approve', $penebusan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
                                                        </form>
                                                        
                                                        <form action="{{ route('penebusan.notApprove', $penebusan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('POST') 
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-minus"></i></button>
                                                        </form>
                                                        

                                                        <button class="btn btn-success btn-sm showBtn" data-id="{{ $penebusan->id }}"><i class="fa-solid fa-eye"></i></button>
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
                    const penebusanId = this.getAttribute('data-id');
                    fetch(`/penebusan/show/${penebusanId}`) 
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
