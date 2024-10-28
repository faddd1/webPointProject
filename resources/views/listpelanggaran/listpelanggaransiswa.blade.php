<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center">
                <h4 class="card-title text-md" style="margin-top: 5px;">
                    Halo, <span class="text-bold">{{ Auth::user()->name }}</span>!
                </h4>
                <div class="card-tools">
                    @if (Auth::user()->siswa)
                        <span class="me-2"> Poin :</span>
                        @if (Auth::user()->siswa->point <= -1)
                            <a class="btn btn-danger btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}
                            </a>
                        @elseif (Auth::user()->siswa->point <= 20)
                            <a class="btn btn-primary btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}
                            </a>
                        @elseif (Auth::user()->siswa->point <= 50)
                            <a class="btn btn-warning btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}
                            </a>
                        @elseif (Auth::user()->siswa->point <= 100)
                            <a class="btn btn-danger btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}
                            </a>
                        @elseif (Auth::user()->siswa->point <= 150)
                            <a class="btn btn-danger btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}
                            </a>
                        @endif
                    @else
                        <span class="text-danger">Tidak Bisa Menampilkan Poin</span>
                    @endif
                </div>
              
            </div>
            
            <div class="card-body">
                @if (Auth::user()->siswa)
                    <div class="mt-1" style="font-size: 15px;">
                        <table>
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td class="text-bold">{{ Auth::user()->siswa->nis }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td class="text-bold">{{ Auth::user()->siswa->kelas }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td class="text-bold">{{ Auth::user()->siswa->jk }}</td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td class="text-bold">{{ Auth::user()->siswa->jurusan }}</td>
                            </tr>
                        </table>
                    </div>
                @else
                    <div class="text-danger">
                        Data Siswa Belum Terisi
                    </div>
                @endif
            </div>
           
        </div>
    </div>
   
                @if ($hukuman && $hukuman->count())
                    <div class="card text-center shadow">
                        <div class="card-body">
                            <h2 class="card-title">Poin Anda Sudah Mencapai: <strong>{{ Auth::user()->siswa->point }}</strong></h2>
                            @foreach ($hukuman as $item)
                                <p class="card-text text-warning">Anda Terkena Sanksi: <strong>{{ $item->nama_hukuman }}</strong></p>
                            @endforeach
                        </div>
                        <div class="card-footer text-muted">
                            Harap perhatikan peraturan yang berlaku.
                        </div>
                    </div>
                @else
                <div class="card">
                    <div class="card-body">
                        <p style="text-align: center; vertical-align: middle;" class="fs-23 card-footer text-muted">Tidak Ada Hukuman Untuk Anda.</p>
                    </div>
                </div>
                @endif
    

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
            </style>
    <div class="card">
        <div class="card-body">
            <h3 class="text-md py-2">Pelanggaran Yang Pernah Kamu Lakukan : <strong>{{ $totalPelanggaran }}</strong></h3>
            <div class="table-responsive">
                <table class="table table-sm table-bordered" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #4D869C; color:#ffff;">
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">No</td>
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelapor</td>
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelanggaran</td>
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Jumlah Point</td>
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Bukti</td>
                            <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($laporans->count() > 0)
                            @foreach ($laporans as $index => $laporan)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $index + 1 }}</td>
                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $laporan->pelapor->name ?? 'tidak diketahui' }}</td>
                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $laporan->pelanggaran }}</td>
                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $laporan->point }}</td>
                                    <td style="text-align: center; vertical-align: middle; margin-top:10px;">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $laporan->id }}">
                                            <div style="width: 50px; height: 50px; overflow: hidden; display: inline-block;">
                                                <img src="{{ asset('uploads/' . $laporan->bukti) }}" alt="Bukti {{ $laporan->nama }}" class="img-thumbnail bukti-image " style="width: 100%; height: auto; cursor: pointer;">
                                            </div>
                                        </a>
                                    
                                        <div class="modal fade" id="imageModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $laporan->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('uploads/' . $laporan->bukti) }}" alt="Bukti {{ $laporan->nama }}" class="img-fluid" style="max-width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $laporan->tanggal }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center;">Tidak ada laporan yang ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
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
            <div class="d-flex">
                <div class="ml-auto">
                    {{ $laporans->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div> 
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="text-md py-2">Prestasi Yang Pernah Kamu Lakukan : <strong>{{ $totalPrestasi }}</strong></h3>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                        <thead>
                            <tr style="background-color: #4D869C; color:#ffff;">
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">No</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelapor</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Prestasi</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Jumlah Point</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Bukti</td>
                                <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($laporans->count() > 0)
                                @foreach ($prestasi as $index => $prestasis)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $index + 1 }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasis->pelapor->name ?? 'tidak diketahui' }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasis->nama_Prestasi }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasis->point }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $laporan->id }}">
                                                <div style="width: 50px; height: 50px; overflow: hidden; display: inline-block;">
                                                    <img src="{{ asset('uploads/' . $laporan->bukti) }}" alt="Bukti {{ $laporan->nama }}" class="img-thumbnail bukti-image" style="width: 100%; height: auto; cursor: pointer;">
                                                </div>
                                            </a>

                                        
                                            <div class="modal fade" id="imageModal-{{ $prestasis->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $prestasis->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <img src="{{ asset('uploads/' . $prestasis->bukti) }}" alt="Bukti {{ $prestasis->nama }}" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;white-space: nowrap;">{{ $prestasis->tanggal }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center;">Tidak ada prestasi yang ditemukan</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
        </div>
        {{ $laporans->links('pagination::bootstrap-4') }}
    </div>
</x-layout>
