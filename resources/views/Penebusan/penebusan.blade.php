<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">
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
        @elseif(session('error'))
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
                    title: " {{ session('error')}}"
                    });
        </script>
        @endif
        <div class="card shadow-lg border-0">
           
            <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #4D869C;">
               
                <div>
                    <button class="btn btn-outline-light me-2" onclick="showSearchAlert('siswa')">
                        <i class="fas fa-user"></i> Cari Siswa
                    </button>
                    <button class="btn btn-outline-light" onclick="showSearchAlert('penebusan')">
                        <i class="fas fa-search"></i> Cari Penebusan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('penebusan.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nama_Prestasi" class="form-label">Prestas :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                                <input type="text" id="penebusan-input" name="nama_Prestasi" class="form-control" readonly>
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
                    <button type="submit" class="btn w-100 laporForm" style="background-color: #4D869C;">
                        <i class="fas fa-paper-plane" style="color: #fff;"></i> <span style="color: #fff;">Selesai</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @include('penebusan.penebusanjs')
</x-layout>

