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
<div class="form-container"><form id="form-prestasi" action="{{ route('Poin.store') }}" method="POST" >
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
        <div class="form-group">
            <input type="text" class="form-control" name="Tingkat" placeholder="Tingkat yang Diberikan" required>
        </div>
    </div>
    <button type="button" class="btn btn-block btn-primary-custom" onclick="test(event, 'form-prestasi')">Tambah</button>
</form>
</div>
