

<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    title: "ERROR",
                                    text: "{{ session('success') }}",
                                    icon: "error"
                                });
                            });
                        </script>
                    @endif
                    @if ($errors->has('nis'))
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
                            icon: "error",
                            title: " {{ $errors->first('nis') }}"
                        });
                    </script>
                     @endif

                     <style>
                        .btn-primary:hover, .btn-danger:hover, .btn-success:hover {
                            transform: translateY(-5px);
                            transition: transform 0.3s ease;
                        }

                        .btn-danger:hover {
                            transform: translateY(-5px);
                            transition: transform 0.5s ease;
                        }

                        .btn-success:hover {
                            transform: translateY(-5px);
                            transition: transform 0.3s ease;
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

                        #card{
                            margin: auto;
                            height: 135px;
                            margin-bottom: 20px
                        }

                        #card{
                            margin-bottom: 10px;
                        }

                        @media (max-width: 576px) {
                            #card {
                               height: 300px;
                            }

                        }


                    </style>
                    

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 id="bulan" style="font-weight: 700;"></h5>
                                    <p style="font-style: italic; margin-bottom: 0;">Data semua siswa yang ada di SMKN 1 KAWALI</p>
                                </div>
                               
                            </div>
                            <form id="download-form" method="GET" class="p-3 rounded shadow mt-3">
                                <div class="form-group mb-3">
                                    <label for="jurusan" class="form-label font-weight-bold">Pilih Jurusan:</label>
                                    <select name="jurusan" id="jurusan" class="form-control">
                                        <option value="all">Semua Jurusan</option> 
                                        <option value="TKR 1">TKR 1</option> 
                                        <option value="TKR 2">TKR 2</option> 
                                        <option value="TKR 3">TKR 3</option> 
                                        <option value="TKJ 1">TKJ 1</option>
                                        <option value="TKJ 2">TKJ 2</option>
                                        <option value="TKJ 3">TKJ 3</option>
                                        <option value="PPLG 1">PPLG 1</option>
                                        <option value="PPLG 2">PPLG 2</option>
                                        <option value="PPLG 3">PPLG 3</option>
                                        <option value="DPIB 1">DPIB 1</option>
                                        <option value="DPIB 2">DPIB 2</option>
                                        <option value="MPLB 1">MPLB 1</option>
                                        <option value="MPLB 2">MPLB 2</option>
                                        <option value="AK 1">AK 1</option>
                                        <option value="AK 2">AK 2</option>
                                        <option value="SK 1">SK 1</option>
                                        <option value="SK 2">SK 2</option>
                                    </select>
                                </div>
                            
                                <div class="form-group mb-3">
                                    <label for="kelas" class="form-label font-weight-bold">Pilih Kelas:</label>
                                    <select name="kelas" id="kelas" class="form-control">
                                        <option value="all">Semua Kelas</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" onclick="confirmDownload('{{ route('data.pdf') }}')" class="btn btn-danger mr-2">
                                        <i class="fas fa-file-pdf"></i> Pdf
                                    </button>
                            
                                    <button type="button" onclick="confirmDownload('{{ route('data.excel') }}')" class="btn btn-success">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </button>
                                </div>
                            </form>
                            
                        </div>
    
                    </div>
                      





                    <div class="card">
                        <div class="card-header">
                            @if (auth()->user()->role == 'admin')
                                <div class="card-tools">
                                    <button id="tambahDataBtn" class="btn btn-sm" style="margin-top: 10px; background-color:#245c70; color:#ffff;">
                                        <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Add</span>
                                    </button>
                                </div>
                            @endif
                        
                       
                            <form method="GET" action="{{ route('student.searchSiswa') }}">
                                <div class="card-item row mt-2 d-flex align-items-center">
                                    <!-- Input Nama Siswa -->
                                    <div class="col-md-3 col-sm-4 col-12 mb-2">
                                        <input type="text" class="form-control form-control-sm" name="nama" placeholder="Nama Siswa" value="{{ request('nama') }}">
                                    </div>
                            
                                    <!-- Select Kelas -->
                                    <div class="col-md-2 col-sm-4 col-6 mb-2">
                                        <select class="form-control form-control-sm" name="kelas">
                                            <option>PILIH KELAS</option>
                                            <option value="10" {{ request('kelas') == '10' ? 'selected' : '' }}>10</option>
                                            <option value="11" {{ request('kelas') == '11' ? 'selected' : '' }}>11</option>
                                            <option value="12" {{ request('kelas') == '12' ? 'selected' : '' }}>12</option>
                                        </select>
                                    </div>
                            
                                    <div class="col-md-3 col-sm-4 col-6 mb-2">
                                        <select class="form-control form-control-sm" name="jurusan">
                                        <option>PILIH JURUSAN</option>
                                        <option value="TKR 1" {{ request('jurusan') == 'TKR 1' ? 'selected' : '' }}>TKR 1</option>
                                        <option value="TKR 2" {{ request('jurusan') == 'TKR 2' ? 'selected' : '' }}>TKR 2</option>
                                        <option value="TKR 3" {{ request('jurusan') == 'TKR 3' ? 'selected' : '' }}>TKR 3</option>
                                        <option value="TKJ 1" {{ request('jurusan') == 'TKJ 1' ? 'selected' : '' }}>TKJ 1</option>
                                        <option value="TKJ 2" {{ request('jurusan') == 'TKJ 2' ? 'selected' : '' }}>TKJ 2</option>
                                        <option value="TKJ 3" {{ request('jurusan') == 'TKJ 3' ? 'selected' : '' }}>TKJ 3</option>
                                        <option value="PPLG 1" {{ request('jurusan') == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
                                        <option value="PPLG 2" {{ request('jurusan') == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
                                        <option value="PPLG 3" {{ request('jurusa  n') == 'PPLG 3' ? 'selected' : '' }}>PPLG 3</option>
                                        <option value="MPLB 1" {{ request('jurusan') == 'MPLB 1' ? 'selected' : '' }}>MPLB 1</option>
                                        <option value="MPLB 2" {{ request('jurusan') == 'MPLB 2' ? 'selected' : '' }}>MPLB 2</option>
                                        <option value="DPIB 1" {{ request('jurusan') == 'DPIB 1' ? 'selected' : '' }}>DPIB 1</option>
                                        <option value="DPIB 2" {{ request('jurusan') == 'DPIB 2' ? 'selected' : '' }}>DPIB 2</option>
                                        <option value="AK 1" {{ request('jurusan') == 'AK 1' ? 'selected' : '' }}>AK 1</option>
                                        <option value="AK 2" {{ request('jurusan') == 'AK 2' ? 'selected' : '' }}>AK 2</option>
                                        <option value="SP 1" {{ request('jurusan') == 'SP 1' ? 'selected' : '' }}>SP 1</option>
                                        <option value="SP 2" {{ request('jurusan') == 'SP 2' ? 'selected' : '' }}>SP 2 </option>
                                    </select>
                                    </div>
                            
                                    <button type="submit" class="btn mb-2 mr-2" style="background-color: #266278; color: #ffff;">Cari</button>
                                    
                                    <a href="{{ route('student.searchSiswa') }}" class="btn btn-danger mb-2">Clear</a>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px;  border-radius: 5px 5px 0 0; overflow: hidden;" id="studentTable">
                                    <thead>
                                        <tr style="background-color: #4D869C; color:#ffff;">
                                            <td style="text-align: center; vertical-align: middle;" class="py-2">No</td>
                                            <td style="text-align: center; vertical-align: middle;">Nis</td>
                                            <td style="text-align: center; vertical-align: middle;">Nama Siswa</td>
                                            <td style="text-align: center; vertical-align: middle;">Kelas</td>
                                            <td class="col-2" style="text-align: center; vertical-align: middle;">Jurusan</td>
                                            <td style="text-align: center; vertical-align: middle;">Jenis Kelamin</td>
                                            <td style="text-align: center; vertical-align: middle;">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($studentItem->isEmpty())
                                        <tr>
                                            <td colspan="7" style="text-align: center;">Tidak ada data yang ditemukan</td>
                                        </tr>
                                    @else
                                        @foreach ($studentItem as $student)
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                {{ ($studentItem->currentPage() - 1) * $studentItem->perPage() + $loop->iteration }}
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nis }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->nama }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->kelas }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jurusan }}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{ $student->jk }}</td>
                                            
                                            <td style="text-align: center; vertical-align: middle;">
                                                <div class="action-buttons">
                                                    <!-- Tombol Edit dan Delete hanya untuk Admin -->
                                                    @if(auth()->user()->role == 'admin')
                                                        <button class="btn btn-primary btn-sm editBtn" data-id="{{ $student->id }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        
                                                        <form action="{{ route('datasiswa.destroy', $student->id) }}" class="d-inline deleteForm" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                        <!-- Tombol Show yang bisa dilihat oleh semua (guru dan admin) -->
                                                    <button class="btn btn-sm btn-success showBtn" data-id="{{ $student->id }}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </div>
                                            </td>                                            
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                        <style>
                                            .pagination .page-link {
                                                color: #245c70; /* Warna abu-abu */
                                                background-color: #f8f9fa; /* Warna latar belakang */
                                                border-color: #dee2e6; /* Warna border */
                                            }
                                
                                            .pagination .page-link:hover {
                                                color:#245c70; /* Warna abu-abu yang lebih gelap saat hover */
                                                background-color: #e9ecef; /* Latar belakang sedikit lebih gelap */
                                                border-color: #dee2e6;
                                            }
                                
                                            .pagination .active .page-link {
                                                color: white; /* Warna teks saat aktif */
                                                background-color: #245c70; /* Warna abu-abu saat aktif */
                                                border-color: #245c70;
                                            }
                                            
                                        </style>
                                        <div class="card-footer mt-3" style="background: #fff;">
                                            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-center text-md-start gap-2">
                                                <form action="{{ route('hapus.point') }}" class="d-inline deletePoint" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        Hapus Semua Point <i class="fa-solid fa-star"></i>
                                                    </button>
                                                </form>
                                                <div class="mt-2 mt-md-0">
                                                    {{ $studentItem->links('pagination::bootstrap-4') }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="card-footer mt-3" style="background: #fff;">
                                            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row  text-center text-md-start">
                                                <form action="{{ route('hapus.point') }}" class="d-inline deletePoint" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-xs">
                                                        Hapus Semua Point <i class="fa-solid fa-star"></i>
                                                    </button>
                                                </form>
                                                    {{ $studentItem->links('pagination::bootstrap-4') }}
                                            </div>
                                        </div>  --}}
                                </div>
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
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="modal-body" id="modalBody">
                  
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.showBtn').forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id');
                fetch(`/datasiswa/show/${studentId}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalBody').innerHTML = html;
                        document.getElementById('dataModalLabel').innerText = 'Detail Data Siswa';
                        new bootstrap.Modal(document.getElementById('dataModal')).show();
                    })
                    .catch(error => console.error('Error loading data:', error));
            });
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "SUCCESS", 
                    text: "{{ session('success') }}", 
                    icon: "success" 
                });
            });
        </script>
    @elseif (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "ERROR",
                    text: "{{ session('error') }}",
                    icon: "error"
                });
            });
        </script>
    @endif



    @include('student.confirsiswajs')

        <script>
            // script untuk bulannya ganti dengan sendiri
            const date = new Date();
            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const currentMonth = monthNames[date.getMonth()];
            const currentYear = date.getFullYear();
        
            
            document.getElementById("bulan").textContent = `${currentMonth} ${currentYear}`;
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include AlertifyJS CSS and JS -->


        <script>
            document.querySelectorAll('.showBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const studentId = this.getAttribute('data-id');
                    fetch(`/datasiswa/show/${studentId}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalBody').innerHTML = html;
                            document.getElementById('dataModalLabel').innerText = 'Detail Data Siswa';
                            new bootstrap.Modal(document.getElementById('dataModal')).show();
                        })
                        .catch(error => console.error('Error loading data:', error));
                });
            });
        </script>

        <script>
            function confirmDownload(action) {
            const jurusan = document.getElementById('jurusan').value;
        
            
            Swal.fire({
                title: 'Konfirmasi Unduh',
                text: 'Apakah Anda yakin ingin mengunduh data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, unduh!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                document.getElementById('download-form').action = action;
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'jurusan';
                input.value = jurusan;
                document.getElementById('download-form').appendChild(input);
                
                document.getElementById('download-form').submit();
                }
            });
            }
        </script>



</x-layout>
