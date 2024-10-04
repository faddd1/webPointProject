<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('kategori.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Pelanggaran</label>
        <input type="text" class="form-control" name="pelanggaran" placeholder="Nama Pelanggaran" required>
    </div>
    <div class="form-group">
        <label>Point yang Diberikan</label>
        <input type="text" class="form-control" name="point" placeholder="Point yang Diberikan" required>
    </div>
    <div class="form-group">
        <label>Level</label>
        <select class="form-control" name="level" required>
            <option value="">Pilih Level</option>
            <option value="Ringan">Ringan</option>
            <option value="Sedang">Sedang</option>
            <option value="Berat">Berat</option>
        </select>
    </div>
    <button type="submit" class="btn btn-block btn-primary-custom">Tambah</button>
</form>