<form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama Pelanggaran</label>
        <input type="text" class="form-control" value="{{ $kategori->pelanggaran }}" name="pelanggaran" placeholder="Nama Pelanggaran" required>
    </div>
    <div class="form-group">
        <label> Point yang Diberikan</label>
        <input type="text" class="form-control" value="{{ $kategori->point }}" name="point" placeholder="Point yang Diberikan" required>
    </div>
    <div class="form-group">
        <label>Level</label>
        <select class="form-control" name="level" required>
            <option value="">Pilih Level</option>
            <option value="ringan" {{ $kategori->level == 'Ringan' ? 'selected' : ''}}>Ringan</option>
            <option value="sedang" {{ $kategori->level == 'Sedang' ? 'selected' : ''}}>Sedang</option>
            <option value="berat" {{ $kategori->level == 'Berat' ? 'selected' : ''}}>Berat</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Update</button>
</form>