<style>
    .btn-primary-custom {
        background-color: #245c70;
        color: #fff;
    }
    .btn-primary-custom:hover {
        color: #fff;
    }
    .form-control-custom {
        border: 1px solid #245c70;
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
        color: #245c70;
    }
    .form-container {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
</style>
<form action="{{ route('petugas.update', $petugas->id) }}" method="POST"  id="uploadForm">
    @csrf
    <div class="form-group">
        <label>NIS</label>
        <input type="text" class="form-control" name="nis" value="{{ $petugas->nis }}" placeholder="Enter NIS" required>
    </div>
    <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" class="form-control" name="nama" value="{{ $petugas->nama }}" placeholder="Enter student name" required>
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
          <option value="MPLB 1"{{ $petugas->jurusan == 'MPLB 1' ? 'selected' : '' }}>MPLB 1</option>
          <option value="MPLB 2" {{ $petugas->jurusan == 'MPLB 2' ? 'selected' : '' }}>MPLB 2</option>
          <option value="AK 1"{{ $petugas->jurusan == 'AKL 1' ? 'selected' : '' }}>AK 1</option>
          <option value="AK 2"{{ $petugas->jurusan == 'AKL 2' ? 'selected' : '' }}>AK 2</option>
          <option value="SK 1"{{ $petugas->jurusan == 'SK 1' ? 'selected' : '' }}>SK 1</option>
          <option value="SK 2"{{ $petugas->jurusan == 'SK 2' ? 'selected' : '' }}>SK 2</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="namao" class="form-label">Organisasi</label>
        <select class="form-control" id="namao" name="namao" required>
          <option value="">Pilih Organisasi</option>
          <option value="MPK" {{ $petugas->namao == 'MPK' ? 'selected' : '' }}>MPK</option>
          <option value="OSIS" {{ $petugas->namao == 'OSIS' ? 'selected' : '' }}>OSIS</option>
          <option value="PKS" {{ $petugas->namao == 'PKS' ? 'selected' : '' }}>PKS</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary-custom btn-block">Tambah</button>
</form>
