<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Detail Data Siswa - {{ $studentlist->nama }}</title>
    <style>
        .modal-body {
            max-height: 82vh; 
            overflow-y: auto; 
        }

        .pagination .page-item.active .page-link {
            background-color: #4F709C; 
            border: none;
        }
        .pagination .page-link {
            color: #4F709C;
        }
        .pagination .page-item:not(.active) .page-link:hover {
            background-color: #4f709ca5; 
            color: white; 
        }
    </style>
</head>
<body>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h5>Detail Data Siswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm" style="font-size: 13px;">
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
                @if ($pelanggaran->isEmpty())
                    <p class="text-center">Tidak ada riwayat pelanggaran yang tercatat.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="font-size: 13px;">
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
                                @foreach($pelanggaran as $index => $pelanggaranItem)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaran->firstItem() + $index }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaranItem->pelanggaranDetail->pelanggaran }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaranItem->point }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ \Carbon\Carbon::parse($pelanggaranItem->tanggal)->format('j F Y') }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $pelanggaranItem->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div id="pelanggaran-content" class="mt-3 paginate">
                        {{ $pelanggaran->appends(['prestasi_page' => request('prestasi_page')])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Riwayat Prestasi</h5>
            </div>
            <div class="card-body">
                @if ($penebusan->isEmpty())
                    <p class="text-center">Tidak ada riwayat prestasi yang tercatat.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" style="font-size: 13px;">
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
                                @foreach($penebusan as $index => $prestasi)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $penebusan->firstItem() + $index }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->nama_Prestasi }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->point }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ \Carbon\Carbon::parse($prestasi->tanggal)->format('j F Y') }}</td>
                                        <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{ $prestasi->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination Links -->
                    <div id="penebusan-content" class="mt-3 paginate">
                        {{ $penebusan->appends(['pelanggaran_page' => request('pelanggaran_page')])->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
