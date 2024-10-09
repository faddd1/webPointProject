<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('datasiswa.update', $studentItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>NIS</label>
        <input type="text" class="form-control" value="{{ $studentItem->nis }}" name="nis" placeholder="Enter NIS" required>
        @if ($errors->any())
        <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
    @endif
    </div>
    <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" class="form-control" value="{{ $studentItem->nama }}" name="nama" placeholder="Enter student name" required>
    </div>
    <div class="form-group mb-4">
        <label for="kelas" class="form-label">Kelas</label>
        <select class="form-control" id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="10"{{ $studentItem->kelas == '10' ? 'selected' : '' }}>10</option>
            <option value="11"{{ $studentItem->kelas == '11' ? 'selected' : '' }}>11</option>
            <option value="12"{{ $studentItem->kelas == '12' ? 'selected' : '' }}>12</option>
        </select>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkLaki" value="Laki-laki" {{ $studentItem->jk == 'Laki-laki' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jkLaki">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan" {{ $studentItem->jk == 'Perempuan' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jkPerempuan">Perempuan</label>
            </div>
        </div>
    </div>
    <div class="form-group mb-5">
        <label for="jurusan" class="form-label">Jurusan</label>
        <select class="form-control" id="jurusan" name="jurusan" required>
            <option value="TKR 1" {{ $studentItem->jurusan == 'TKR 1' ? 'selected' : '' }}>TKR 1</option>
            <option value="TKR 2" {{ $studentItem->jurusan == 'TKR 2' ? 'selected' : '' }}>TKR 2</option>
            <option value="TKR 3" {{ $studentItem->jurusan == 'TKR 3' ? 'selected' : '' }}>TKR 3</option>
            <option value="TKJ 1" {{ $studentItem->jurusan == 'TKJ 1' ? 'selected' : '' }}>TKJ 1</option>
            <option value="TKJ 2" {{ $studentItem->jurusan == 'TKJ 2' ? 'selected' : '' }}>TKJ 2</option>
            <option value="TKJ 3" {{ $studentItem->jurusan == 'TKJ 3' ? 'selected' : '' }}>TKJ 3</option>
            <option value="PPLG 1" {{ $studentItem->jurusan == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
            <option value="PPLG 2" {{ $studentItem->jurusan == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
            <option value="PPLG 3" {{ $studentItem->jurusan == 'PPLG 3' ? 'selected' : '' }}>PPLG 3</option>
            <option value="DPIB 1" {{ $studentItem->jurusan == 'DPIB 1' ? 'selected' : '' }}>DPIB 1</option>
            <option value="DPIB 2" {{ $studentItem->jurusan == 'DPIB 2' ? 'selected' : '' }}>DPIB 2</option>
            <option value="MPLB 1" {{ $studentItem->jurusan == 'MPLB 1' ? 'selected' : '' }}>MPLB 1</option>
            <option value="MPLB 2" {{ $studentItem->jurusan == 'MPLB 2' ? 'selected' : '' }}>MPLB 2</option>
            <option value="AK 1" {{ $studentItem->jurusan == 'AK 1' ? 'selected' : '' }}>AK 1</option>
            <option value="AK 2" {{ $studentItem->jurusan == 'AK 2' ? 'selected' : '' }}>AK 2</option>
            <option value="SK 1" {{ $studentItem->jurusan == 'SK 1' ? 'selected' : '' }}>SK 1</option>
            <option value="SK 2" {{ $studentItem->jurusan == 'SK 2' ? 'selected' : '' }}>SK 2</option>
        </select>
    </div>
    <button type="submit" class="btn btn-block btn-primary-custom">Update</button>
</form>
