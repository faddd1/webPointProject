<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('Poin.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Prestasi</label>
        <input type="text" class="form-control" name="nama_Prestasi" placeholder="Nama Prestasi" required>
    </div>
    <div class="form-group">
        <label>Point yang Diberikan</label>
        <input type="text" class="form-control" name="point" placeholder="Point yang Diberikan" required>
    </div>

    <div class="form-group">
        <label>Tingkat</label>
        <select class="form-control" name="Tingkat" required>
            <option value="">Pilih Level</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-block btn-primary-custom">Tambah</button>
</form>