<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('petugas.submit') }}" method="POST"  id="uploadForm">
    @csrf
    <div class="form-group">
        <label>NIS</label>
        <input type="text" class="form-control" name="nis" placeholder="Enter NIS" required>
    </div>
    <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" class="form-control" name="namaP" placeholder="Enter student name" required>
    </div>
    <div class="form-group">
        <label for="kelas" class="form-label">Kelas</label>
        <select class="form-control" id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>
    </div>
    <div class="form-group">
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
    <div class="form-group">
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
          <option value="MP 1">MP 1</option>
          <option value="MP 2">MP 2</option>
          <option value="AK 1">AK 1</option>
          <option value="AK 2">AK 2</option>
          <option value="SK 1">SK 1</option>
          <option value="SK 2">SK 2</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama_orga" class="form-label">Organisasi</label>
        <select class="form-control" id="nama_orga" name="nama_orga" required>
          <option value="">Pilih Organisasi</option>
          <option value="MPK">MPK</option>
          <option value="OSIS">OSIS</option>
          <option value="PKS">PKS</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary-custom btn-block">Tambah</button>
</form>
