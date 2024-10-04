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
                        <span class="me-2">Sisa Poin :</span>
                        @if (Auth::user()->siswa->point == 0)
                            <a class="btn btn-success btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}/200
                            </a>
                        @elseif (Auth::user()->siswa->point <= 20)
                            <a class="btn btn-primary btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}/200
                            </a>
                        @elseif (Auth::user()->siswa->point <= 50)
                            <a class="btn btn-warning btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}/200
                            </a>
                        @elseif (Auth::user()->siswa->point <= 100)
                            <a class="btn btn-danger btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}/200
                            </a>
                        @elseif (Auth::user()->siswa->point <= 150)
                            <a class="btn btn-danger btn-sm" style="color: #fff;">
                                {{ Auth::user()->siswa->point }}/200
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

    <div class="card">
        <div class="card-body">
            <h4 class="text-md py-2">Pelanggaran Yang Pernah Kamu Lakukan :</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Pelapor</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Pelanggaran</th>
                            <th style="text-align: center; vertical-align: middle;">Jumlah Point</th>
                            <th style="text-align: center; vertical-align: middle;">Bukti</th>
                            <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($laporans->count() > 0)
                            @foreach ($laporans as $index => $laporan)
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">{{ $index + 1 }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $laporan->pelapor->name ?? 'tidak diketahui' }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $laporan->pelanggaran }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $laporan->point }}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $laporan->id }}">
                                            <img src="{{ asset('uploads/' . $laporan->bukti) }}" alt="Bukti {{ $laporan->nama }}" class="img-thumbnail" style="width: 50px; height: 50px; cursor: pointer;">
                                        </a>

                                       
                                        <div class="modal fade" id="imageModal-{{ $laporan->id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $laporan->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img src="{{ asset('uploads/' . $laporan->bukti) }}" alt="Bukti {{ $laporan->nama }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $laporan->tanggal }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center;">Tidak ada laporan yang ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $laporans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-layout>
