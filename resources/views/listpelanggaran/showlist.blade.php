<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Siswa - {{ $studentlist->nama }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
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
                                    <th>No</th>
                                    <th>Nama Pelanggaran</th>
                                    <th>Jumlah Point</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentlist->pelanggaran as $index => $pelanggaran)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pelanggaran->pelanggaranDetail->pelanggaran }}</td>
                                        <td>{{ $pelanggaran->point }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pelanggaran->tanggal)->format('j F Y') }}</td>
                                        <td>{{ $pelanggaran->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>