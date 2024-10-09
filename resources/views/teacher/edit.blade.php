<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('update.guru', $teacher->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>NIP</label>
        <input type="text" class="form-control" name="nis" value="{{ $teacher->nis }}" placeholder="KETIK NIP" required>
    </div>
    <div class="form-group">
        <label>Nama Guru</label>
        <input type="text" class="form-control" name="namaguru" value="{{ $teacher->namaguru }}" placeholder="KETIK NAMA GURU" required>
    </div>
    <div class="form-group">
        <label>Jabatan</label>
        <input type="text" class="form-control" name="jabatan" value="{{ $teacher->jabatan }}" placeholder="KETIK JABATAN" required>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkLaki" value="Laki-laki" {{ $teacher->jk == 'Laki-laki' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jkLaki">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan" {{ $teacher->jk == 'Perempuan' ? 'checked' : '' }} required>
                <label class="form-check-label" for="jkPerempuan">Perempuan</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-block btn-primary-custom">Update</button>
</form>