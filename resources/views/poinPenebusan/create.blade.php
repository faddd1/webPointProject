<form action="{{ route('Poin.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Nama Prestasi</label>
        <input type="text" class="form-control" name="nama_Prestasi" placeholder="Nama prestasi" required>
    </div>
    <div class="form-group">
        <label>Point yang Diberikan</label>
        <input type="text" class="form-control" name="point" placeholder="Point yang Diberikan" required>
    </div>

    <div class="form-group">
        <label>Tingkat</label>
        <input type="text" class="form-control" name="Tingkat" placeholder="Tingkat" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Tambah</button>
</form>