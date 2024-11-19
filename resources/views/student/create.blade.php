<style>
    .btn-primary-custom {
        background-color: #4F709C;
        color: #fff;
    }
    .btn-primary-custom:hover {
        color: #fff;
    }
    .form-control-custom {
        border: 1px solid #4F709C;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        transition: border-color 0.3s ease-in-out;
    }
    .form-control-custom:focus {
        border-color: #4D869C;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }
    .form-group label {
        font-weight: bold;
        color: #4F709C;
    }
    .form-container {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
</style>
<div class="form-container">
    <form action="{{ route('datasiswa.store') }}" method="POST"  id="uploadForm">
        @csrf
        <div class="form-group">
            <label>NIS</label>
            <input type="text" class="form-control" name="nis" placeholder="NIS" required>
        </div>
        <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" required>
        </div>
        <div class="form-group mb-4">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-control" id="kelas" name="kelas" required>
                <option value="">Pilih Kelas</option>
                <option value="10" >10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-label d-block">Jenis Kelamin</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkLaki" value="Laki-laki" required>
                <label class="form-check-label" for="jkLaki">Laki-laki</label>
        </div>
        <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan" required>
                <label class="form-check-label" for="jkPerempuan">Perempuan</label>
            </div>
        </div>
        <div class="form-group mb-5">
            <label for="jurusan" class="form-label">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan" required>
              <option value="">Pilih Jurusan</option>
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
              <option value="MPLB 1">MPLB 1</option>
              <option value="MPLB 2">MPLB 2</option>
              <option value="AK 1">AK 1</option>
              <option value="AK 2">AK 2</option>
              <option value="SK 1">SK 1</option>
              <option value="SK 2">SK 2</option>
            </select>

            <label for="jurusan" class="form-label mt-4">Pilih Status</label>
            <select class="form-control"name="role" required>
                <option>Pilih Status Siswa</option>
                <option value="siswa">Siswa</option>
                <option value="petugas">Petugas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-primary-custom">Tambah</button>
    </form>
</div>
