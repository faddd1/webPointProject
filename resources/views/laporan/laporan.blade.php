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
                            <!-- Buttons to Trigger Search -->
                            <button class="btn btn-primary" onclick="showSearchAlert('siswa')">Cari Siswa</button>
                            <button class="btn btn-success" onclick="showSearchAlert('pelanggaran')">Cari Pelanggaran</button>
                        </div>
                        
                        <div class="card-body">
                            <!-- Input Form -->
                            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <div class="form-group">
                                        <label for="nis">NIS :</label>
                                        <input type="text" id="nis-input" name="nis" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama :</label>
                                        <input type="text" id="nama-input" name="nama" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="pelanggaran">Pelanggaran :</label>
                                        <input type="text" id="pelanggaran-input" name="pelanggaran" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="point">Poin :</label>
                                        <input type="text" id="point-input" name="point" class="form-control" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" id="tanggal-input" name="tanggal" class="form-control">
                                    </div>
                                    <div class="tools">
                                        <label>Bukti : </label>
                                        <input type="file" id="tanggal-input" name="bukti">
                                   </div>

                                    <button type="submit" class="btn btn-primary mt-2">Selesai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <!-- JavaScript for Searching and Populating Data -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showSearchAlert(type) {
            let placeholderText = '';
            let searchUrl = '';

            if (type === 'siswa') {
                placeholderText = 'Nama Siswa';
                searchUrl = '{{ route("siswa.search") }}';  // Pastikan route ini sudah ada di Laravel
            } else if (type === 'pelanggaran') {
                placeholderText = 'Jenis Pelanggaran';
                searchUrl = '{{ route("pelanggaran.search") }}';  // Pastikan route ini sudah ada di Laravel
            }

            Swal.fire({
                title: `Cari ${placeholderText}`,
                input: 'text',
                inputPlaceholder: `Masukkan ${placeholderText}`,
                showCancelButton: true,
                confirmButtonText: 'Cari',
                showLoaderOnConfirm: true,
                preConfirm: (searchValue) => {
                    return new Promise((resolve, reject) => {
                        if (searchValue) {
                            $.ajax({
                                url: searchUrl,
                                method: 'GET',
                                data: { query: searchValue },
                                success: function(data) {
                                    if (data.length > 0) {
                                        resolve(data);
                                    } else {
                                        Swal.showValidationMessage(`Tidak ada ${placeholderText} yang ditemukan`);
                                    }
                                },
                                error: function(xhr) {
                                    reject(`Terjadi kesalahan: ${xhr.statusText}`);
                                }
                            });
                        } else {
                            Swal.showValidationMessage(`Harap masukkan ${placeholderText}`);
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    let dataItems = result.value;
                    let tableHtml = '';

                    if (type === 'siswa') {
                        tableHtml = `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ceklis</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        dataItems.forEach((item) => {
                            tableHtml += `
                                <tr>
                                    <td><input type="checkbox" class="pilih-siswa-checkbox" data-nis="${item.nis}" data-nama="${item.nama}"></td>
                                    <td>${item.nis}</td>
                                    <td>${item.nama}</td>
                                    <td>${item.kelas}</td>
                                    <td>${item.jurusan}</td>
                                </tr>
                            `;
                        });
                    } else if (type === 'pelanggaran') {
                        tableHtml = `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ceklis</th>
                                        <th>Pelanggaran</th>
                                        <th>Poin</th>
                                        <th>Level</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        dataItems.forEach((item) => {
                            tableHtml += `
                                <tr>
                                    <td><input type="checkbox" class="pilih-pelanggaran-checkbox" data-id="${item.id}" data-pelanggaran="${item.pelanggaran}" data-point="${item.point}"></td>
                                    <td>${item.pelanggaran}</td>
                                    <td>${item.point}</td>
                                    <td>${item.level}</td>
                                </tr>
                            `;
                        });
                    }

                    tableHtml += `
                            </tbody>
                        </table>
                        <button id="confirm-selection-btn" class="btn btn-primary mt-3">Konfirmasi Pilihan</button>
                    `;

                    Swal.fire({
                        title: `Pilih ${type === 'siswa' ? 'Siswa' : 'Pelanggaran'}`,
                        html: tableHtml,
                        showConfirmButton: false
                    });

                    document.getElementById('confirm-selection-btn').addEventListener('click', function() {
                        let selectedCheckboxes = document.querySelectorAll(type === 'siswa' ? '.pilih-siswa-checkbox:checked' : '.pilih-pelanggaran-checkbox:checked');
                        if (selectedCheckboxes.length > 0) {
                            let selectedItem = selectedCheckboxes[0];
                            if (type === 'siswa') {
                                let nis = selectedItem.getAttribute('data-nis');
                                let nama = selectedItem.getAttribute('data-nama');

                                document.getElementById('nama-input').value = nama;
                                document.getElementById('nis-input').value = nis;
                            } else if (type === 'pelanggaran') {
                                let pelanggaran = selectedItem.getAttribute('data-pelanggaran');
                                let point = selectedItem.getAttribute('data-point');

                                document.getElementById('pelanggaran-input').value = pelanggaran;
                                document.getElementById('point-input').value = point;
                            }

                            Swal.close();
                        } else {
                            Swal.showValidationMessage(`Pilih setidaknya satu ${type === 'siswa' ? 'siswa' : 'pelanggaran'}`);
                        }
                    });
                }
            });
        }
    </script>
</x-layout>
