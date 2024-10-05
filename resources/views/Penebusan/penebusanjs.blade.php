<script>
    function showSearchAlert(type) {
        let placeholderText = '';
        let searchUrl = '';

        if (type === 'siswa') {
            placeholderText = 'Nama Siswa';
            searchUrl = '{{ route("siswa.search") }}';
        } else if (type === 'penebusan') {
            placeholderText = 'Jenis Penebusan';
            searchUrl = '{{ route("penebusan.search") }}';
        }

        Swal.fire({
            title: `Cari ${placeholderText}`,
            html: generateSearchHtml(type),
            showCancelButton: true,
            confirmButtonText: 'Cari',
            showLoaderOnConfirm: false, 
            preConfirm: () => {
                const searchValue = document.getElementById('search-input').value;
                const jurusan = document.getElementById('jurusan-select') ? document.getElementById('jurusan-select').value : '';
                const kelas = document.getElementById('kelas-select') ? document.getElementById('kelas-select').value : '';

                if (!searchValue) {
                    Swal.showValidationMessage(`Harap masukkan ${placeholderText}`);
                    return false;
                }

                Swal.showLoading(); 
                return fetch(`${searchUrl}?query=${searchValue}&jurusan=${jurusan}&kelas=${kelas}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Jaringan bermasalah atau URL tidak ditemukan');
                    }
                    return response.json(); 
                })
                .then(data => {
                    if (data.length === 0) {
                        Swal.showValidationMessage(`Tidak ada ${placeholderText} yang ditemukan`);
                        return false;
                    }
                    return { htmlContent: generateTableHtml(type, data) }; 
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request gagal: ${error.message}`);
                    return false;
                })
                .finally(() => {
                    Swal.hideLoading();
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed && result.value.htmlContent) {
                Swal.fire({
                    title: `Pilih ${type === 'siswa' ? 'Siswa' : 'Penebusan'}`,
                    html: result.value.htmlContent, 
                    showConfirmButton: false,
                    width: '80%',
                });

                document.getElementById('confirm-selection-btn').addEventListener('click', function() {
                    let selectedCheckboxes = document.querySelectorAll(type === 'siswa' ? '.pilih-siswa-checkbox:checked' : '.pilih-penebusan-checkbox:checked');
                    if (selectedCheckboxes.length > 0) {
                        let selectedItem = selectedCheckboxes[0];
                        if (type === 'siswa') {
                            let nis = selectedItem.getAttribute('data-nis');
                            let nama = selectedItem.getAttribute('data-nama');

                            document.getElementById('nama-input').value = nama;
                            document.getElementById('nis-input').value = nis;
                        } else if (type === 'penebusan') {
                            let penebusan = selectedItem.getAttribute('data-penebusan');
                            let point = selectedItem.getAttribute('data-point');

                            document.getElementById('penebusan-input').value = penebusan;
                            document.getElementById('point-input').value = point;
                        }

                        Swal.close();
                    } else {
                        Swal.showValidationMessage(`Pilih setidaknya satu ${type === 'siswa' ? 'siswa' : 'penebusan'}`);
                    }
                });

            }
        });
    }

    function generateSearchHtml(type) {
        let html = `
            <div class="form-group">
                <input id="search-input" type="text" class="form-control" placeholder="Masukkan ${type === 'siswa' ? 'Nama Siswa' : 'Jenis Penebusan'}">
            </div>
        `;

        if (type === 'siswa') {
            html += `
                <div class="form-group">
                    <label for="jurusan-select">Jurusan</label>
                    <select id="jurusan-select" class="form-control">
                        <option value="">-- Semua Jurusan --</option>
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
                        <option value="MP 1">MP 1</option>
                        <option value="MP 2">MP 2</option>
                        <option value="AK 1">AK 1</option>
                        <option value="AK 2">AK 2</option>
                        <option value="SK 1">SK 1</option>
                        <option value="SK 2">SK 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kelas-select">Kelas</label>
                    <select id="kelas-select" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
            `;
        }

        return html;
    }

    function generateTableHtml(type, dataItems) {
        let tableHtml = '';

        if (type === 'siswa') {
            tableHtml = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-check-square"></i></th>
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
                        <td><input type="radio" class="pilih-siswa-checkbox" name="selected-siswa" data-nis="${item.nis}" data-nama="${item.nama}"></td>
                        <td>${item.nis}</td>
                        <td>${item.nama}</td>
                        <td>${item.kelas}</td>
                        <td>${item.jurusan}</td>
                    </tr>
                `;
            });
        } else if (type === 'penebusan') {
            tableHtml = `
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-check-square"></i></th>
                                <th>Penebusan</th>
                                <th>Poin</th>
                                <th>Level</th>                                        
                            </tr>
                        </thead>
                        <tbody>
            `;

            dataItems.forEach((item) => {
                tableHtml += `
                    <tr>
                        <td><input type="radio" class="pilih-penebusan-checkbox" name="selected-penebusan" data-id="${item.id}" data-penebusan="${item.nama_Prestasi}" data-point="${item.point}"></td>
                        <td>${item.nama_Prestasi}</td>
                        <td>${item.point}</td>
                        <td>${item.Tingkat}</td>
                    </tr>
                `;
            });
        }

        tableHtml += `
                    </tbody>
                </table>
            </div>
            <button id="confirm-selection-btn" class="btn btn-primary mt-3">
                <i class="fas fa-check"></i> Konfirmasi Pilihan
            </button>
        `;

        return tableHtml;
    }
</script>

<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>