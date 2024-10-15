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
<div class="form-container">
    <form action="{{ route('Poin.update', $prestasi->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama Prestasi</label>
        <input type="text" class="form-control" name="nama_Prestasi" value="{{ $prestasi->nama_Prestasi }}" placeholder="Nama prestasi" required>
    </div>
    <div class="form-group">
        <label>Point yang Diberikan</label>
        <input type="text" class="form-control" name="point" value="{{ $prestasi->point }}" placeholder="Point yang Diberikan" required>
    </div>

    <div class="form-group">
        <label>Tingkat</label>
        <select class="form-control" name="Tingkat" required>
            <option value="">Pilih Level</option>
            <option value="10" {{ $prestasi->Tingkat == '10' ? 'selected' : ''}}>10</option>
            <option value="11" {{ $prestasi->Tingkat == '11' ? 'selected' : ''}}>11</option>
            <option value="12" {{ $prestasi->Tingkat == '12' ? 'selected' : ''}}>12</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-block btn-primary-custom">Update</button>
</form>
</div>

