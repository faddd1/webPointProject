<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                title: "BERHASIL",
                                text: "{{ session('success') }}",
                                icon: "success"
                            });
                        </script>
                    @endif

                    <div class="card" style="background: #fff;">
                        <div class="card-body">
                            
                            <form id="download-form" method="GET" class="p-3 rounded shadow mt-3" style="background: #fff;">
                                <div class="form-group mb-3">
                                    <label for="jurusan" class="form-label font-weight-bold">Pilih Jurusan:</label>
                                    <select name="jurusan" id="jurusan" class="form-control">
                                        <option value="All">Semua Jurusan</option> 
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
                                        <option value="All">Semua Kelas</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            
                                <div class="text-center mt-3">
                                    <button type="button" onclick="confirmDownload('{{ route('sanksi.pdf') }}')" class="btn btn-danger shadow" style="transition:none; transform:none">
                                        <i class="fas fa-file-pdf"></i> Download Pdf
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <form action="{{ route('sanksi') }}" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn" style="background-color: #213555; color: #fff;">
                                                <i class="fa-solid fa-magnifying-glass"></i> <!-- Ikon pencarian -->
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
  
                                @media (max-width: 576px) {
                                    .input-group {
                                        flex-direction: row; 
                                        max-width: 180px; 
                                    }
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
  
                                .btn-danger:hover, .btn-primary:hover {
                                    transition: transform 0.5s ease;
                                    transform: translateY(-5px);
                                }
                            </style>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                @if($studentsWithSanctions->isNotEmpty())
                                    <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                        <thead>
                                            <tr style="background-color: #4F709C; color:#ffff;">
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;" class="py-2">No</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nis</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Siswa</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Kelas</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Jurusan</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Jenis Kelamin</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Poin</th>
                                                <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Sanksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentsWithSanctions as $no => $item)
                                            <tr>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $no + 1 }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->nis }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->nama }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->kelas }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->jurusan }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->jk }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $item->point ?? '0' }}</td>
                                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                    
                                                        @if ($item->hukuman)
                                                            {{ $item->hukuman->nama_hukuman }}
                                                        @else
                                                            <span class="text-danger">No Sanction</span>
                                                        @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p>Tidak ada data sanksi yang ditemukan.</p>
                                @endif
                                
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <style>
                                            .pagination .page-link {
                                                color: #4F709C; /* Warna teks */
                                                background-color: #f8f9fa; /* Warna latar */
                                                border-color: #dee2e6; /* Warna border */
                                            }
  
                                            .pagination .page-link:hover {
                                                color:  #4F709C;
                                                background-color: #e9ecef; 
                                                border-color: #dee2e6;
                                            }
  
                                            .pagination .active .page-link {
                                                color: white;
                                                background-color:  #4F709C;
                                                border-color:  #4F709C;
                                            }
                                        </style>
                                        {{-- {{ $kategoris->links('pagination::bootstrap-4') }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
           document.getElementById('search-input').addEventListener('input', function() {
              if (this.value === '') {
                  window.location.href = "{{ url('/hukuman/sanksi') }}";
              }
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
  