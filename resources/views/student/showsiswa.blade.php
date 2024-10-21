<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa - {{ $studentlist->nama }}</title>
</head>
<body>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h5>Detail Data Siswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td><strong>NIS</strong></td>
                        <td>{{ $studentlist->nis }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $studentlist->nama }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kelas</strong></td>
                        <td>{{ $studentlist->kelas }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jurusan</strong></td>
                        <td>{{ $studentlist->jurusan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>{{ $studentlist->jk }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Point</strong></td>
                        <td>{{ $studentlist->point }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Riwayat Pelanggaran</h5>
            </div>
            <div class="card-body">
                @if ($studentlist->pelanggaran->isEmpty())
                    <p class="text-center">Tidak ada riwayat pelanggaran yang tercatat.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">No</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Pelanggaran</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Jumlah Point</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentlist->pelanggaran as $index => $pelanggaran)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $index + 1 }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaran->pelanggaranDetail->pelanggaran }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaran->point }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ \Carbon\Carbon::parse($pelanggaran->tanggal)->format('j F Y') }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaran->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Riwayat Prestasi</h5>
            </div>
            <div class="card-body">
                @if ($studentlist->penebusan->isEmpty())
                    <p class="text-center">Tidak ada riwayat prestasi yang tercatat.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">No</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Prestasi</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Point</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Tanggal</th>
                                    <th style="text-align: center; vertical-align: middle; white-space: nowrap;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentlist->penebusan as $index => $prestasi)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $index + 1 }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->nama_Prestasi }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->point }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('j F Y') }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
