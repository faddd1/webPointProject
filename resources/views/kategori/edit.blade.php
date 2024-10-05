
<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
</style>
<form action="{{ route('kategori.update', $kategoris->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama Pelanggaran</label>
        <input type="text" class="form-control" value="{{ $kategoris->pelanggaran }}" name="pelanggaran" placeholder="Nama Pelanggaran" required>
    </div>
    <div class="form-group">
        <label> Point yang Diberikan</label>
        <input type="text" class="form-control" value="{{ $kategoris->point }}" name="point" placeholder="Point yang Diberikan" required>
    </div>
    <div class="form-group">
        <label>Level</label>
        <select class="form-control" name="level" required>
            <option value="">Pilih Level</option>
            <option value="Ringan" {{ $kategoris->level == 'Ringan' ? 'selected' : ''}}>Ringan</option>
            <option value="Sedang" {{ $kategoris->level == 'Sedang' ? 'selected' : ''}}>Sedang</option>
            <option value="Berat" {{ $kategoris->level == 'Berat' ? 'selected' : ''}}>Berat</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-primary-custom">Update</button>
</form>