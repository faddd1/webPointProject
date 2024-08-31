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
                        </div>

                        <div class="card-body">
                            @if($reports->isEmpty())
                                <p class="text-center">Tidak ada laporan yang menunggu verifikasi.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Foto Bukti</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Pelanggaran</th>
                                            <th>Point</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reports as $report)
                                            <tr>
                                                <td>
                                                    @if($report->bukti)
                                                        <a href="{{ asset('uploads/' . $report->bukti) }}" data-lightbox="report-{{ $report->id }}" data-title="Bukti {{ $report->nama }}">
                                                            <img src="{{ asset('uploads/' . $report->bukti) }}" alt="Bukti" width="100">
                                                        </a>
                                                    @else
                                                        Tidak ada bukti
                                                    @endif
                                                </td>
                                                <td>{{ $report->nis }}</td>
                                                <td>{{ $report->nama }}</td>
                                                <td>{{ $report->pelanggaran }}</td>
                                                <td>{{ $report->point }}</td>
                                                <td>{{ $report->tanggal }}</td>
                                                <td>{{ ucfirst($report->status) }}</td>
                                                <td>
                                                    <form action="{{ route('laporan.approve', $report->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    
                                                    <form action="{{ route('laporan.notApprove', $report->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-danger btn-sm">Not Approve</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
