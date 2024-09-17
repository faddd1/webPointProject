
<form action="{{ route('petugas.update', $petugas->id) }}" method="POST"  id="uploadForm">
    @csrf
    <div class="form-group">
        <label>NIS</label>
        <input type="text" class="form-control" name="nis" value="{{ $petugas->nis }}" placeholder="Enter NIS" required>
    </div>
    <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" class="form-control" name="nama_petugas" value="{{ $petugas->namaP }}" placeholder="Enter student name" required>
    </div>
    <div class="form-group">
        <label for="kelas" class="form-label">Kelas</label>
        <select class="form-control" id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="10"{{ $petugas->kelas == '10' ? 'selected' : '' }}>10</option>
            <option value="11"{{ $petugas->kelas == '11' ? 'selected' : '' }}>11</option>
            <option value="12"{{ $petugas->kelas == '12' ? 'selected' : '' }}>12</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-label d-block">Jenis Kelamin</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jk" id="jkLaki"  value="Laki-laki"{{ $petugas->jk == 'Laki-laki' ? 'checked' : '' }} required>
            <label class="form-check-label" for="jkLaki">Laki-laki</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan"{{ $petugas->jk == 'Perempuan' ? 'checked' : '' }} required>
            <label class="form-check-label" for="jkPerempuan">Perempuan</label>
        </div>
    </div>
    <div class="form-group">
        <label for="jurusan" class="form-label">Jurusan</label>
        <select class="form-control" id="jurusan" name="jurusan" required>
          <option value="">Pilih Jurusan</option>
          <option value="TKR 1"{{ $petugas->jurusan == 'TKR 1' ? 'selected' : '' }}>TKR 1</option>
          <option value="TKR 2" {{ $petugas->jurusan == 'TKR 2' ? 'selected' : '' }}>TKR 2</option>
          <option value="TKR 3" {{ $petugas->jurusan == 'TKR 3' ? 'selected' : '' }}>TKR 3</option>
          <option value="TKJ 1" {{ $petugas->jurusan == 'TKJ 1' ? 'selected' : '' }}>TKJ 1</option>
          <option value="TKJ 2" {{ $petugas->jurusan == 'TKJ 2' ? 'selected' : '' }}>TKJ 2</option>
          <option value="TKJ 3" {{ $petugas->jurusan == 'TKJ 3' ? 'selected' : '' }}>TKJ 3</option>
          <option value="PPLG 1" {{ $petugas->jurusan == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
          <option value="PPLG 2" {{ $petugas->jurusan == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
          <option value="PPLG 3" {{ $petugas->jurusan == 'PPLG 3' ? 'selected' : '' }}>PPLG 3</option>
          <option value="DPIB 1" {{ $petugas->jurusan == 'DPIB 1' ? 'selected' : '' }}>DPIB 1</option>
          <option value="DPIB 2" {{ $petugas->jurusan == 'DPIB 2' ? 'selected' : '' }}>DPIB 2</option>
          <option value="MP 1"{{ $petugas->jurusan == 'MP 1' ? 'selected' : '' }}>MP 1</option>
          <option value="MP 2" {{ $petugas->jurusan == 'MP 2' ? 'selected' : '' }}>MP 2</option>
          <option value="AK 1"{{ $petugas->jurusan == 'AKL 1' ? 'selected' : '' }}>AK 1</option>
          <option value="AK 2"{{ $petugas->jurusan == 'AKL 2' ? 'selected' : '' }}>AK 2</option>
          <option value="SK 1"{{ $petugas->jurusan == 'SK 1' ? 'selected' : '' }}>SK 1</option>
          <option value="SK 2"{{ $petugas->jurusan == 'SK 2' ? 'selected' : '' }}>SK 2</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="nama_orga" class="form-label">Organisasi</label>
        <select class="form-control" id="nama_orga" name="nama_orga" required>
          <option value="">Pilih Organisasi</option>
          <option value="MPK" {{ $petugas->namao == 'MPK' ? 'selected' : '' }}>MPK</option>
          <option value="OSIS" {{ $petugas->namao == 'OSIS' ? 'selected' : '' }}>OSIS</option>
          <option value="PKS" {{ $petugas->namao == 'PKS' ? 'selected' : '' }}>PKS</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Tambah</button>
</form>
