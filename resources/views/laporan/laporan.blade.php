<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mt-3">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
               
                <div>
                    <button class="btn btn-outline-light me-2" onclick="showSearchAlert('siswa')">
                        <i class="fas fa-user-search"></i> Cari Siswa
                    </button>
                    <button class="btn btn-outline-light" onclick="showSearchAlert('pelanggaran')">
                        <i class="fas fa-search"></i> Cari Pelanggaran
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nis" class="form-label">NIS :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                <input type="text" id="nis-input" name="nis" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" id="nama-input" name="nama" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pelanggaran" class="form-label">Pelanggaran :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                                <input type="text" id="pelanggaran-input" name="pelanggaran" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="point" class="form-label">Poin :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-star"></i></span>
                                <input type="text" id="point-input" name="point" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Bukti :</label>
                        <input type="file"  name="bukti">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal :</label>
                        <input type="date" id="tanggal-input" name="tanggal" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 laporForm">
                        <i class="fas fa-paper-plane"></i> Selesai
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('laporan.confirjs')
</x-layout>

