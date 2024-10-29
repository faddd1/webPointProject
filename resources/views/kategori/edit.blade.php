
<style>
    .btn-primary-custom {
        background-color: #4F709C;
        color: #fff;
    }
    .btn-primary-custom:hover {
        color: #fff;
    }
    .form-control-custom {
        border: 1px solid #4F709C;
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
        color: #4F709C;
    }
    .form-container {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
</style>

<div class="form-container">
    <form action="{{ route('kategori.update', $kategoris->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Pelanggaran</label>
            <input type="text" class="form-control" value="{{ $kategoris->pelanggaran }}" name="pelanggaran" placeholder="Nama Pelanggaran" required>
        </div>
        <div class="form-group">
            <label> Poin yang Diberikan</label>
            <input type="text" class="form-control" value="{{ $kategoris->point }}" name="point" placeholder="Point yang Diberikan" required>
        </div>
        <div class="form-group">
            <label>Pasal</label>
            <select class="form-control" name="level" required>
                <option value="">Pilih Pasal</option>
                @foreach ($pasals as $pasal)
                    <option value="{{ $pasal->id }}" {{ $kategoris->level == $pasal->id ? 'selected' : '' }}>
                        {{ $pasal->level }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-primary-custom">Simpan</button>
    </form>
</div>
