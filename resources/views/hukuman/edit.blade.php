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
    <form action="{{ route('hukuman.update', $punismen->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Hukuman</label>
            <input type="text" class="form-control form-control-custom" value="{{ $punismen->nama_hukuman }}" name="nama_hukuman" placeholder="Nama hukuman" required>
        </div>
        
        <div class="form-group">
            <label>Poin Awal</label>
            <input type="text" class="form-control form-control-custom" value="{{ $punismen->pointAwal }}"   name="pointAwal" placeholder="Poin Awal" required>
        </div>

        <div class="form-group">
            <label>Poin Akhir</label>
            <input type="text" class="form-control form-control-custom" value="{{ $punismen->pointAkhir }}" name="pointAkhir" placeholder="Poin Akhir" required>
        </div>

        <button type="submit" class="btn btn-block btn-primary-custom">Tambah</button>
    </form>
</div>

<script>
    // Function to ensure that values are always negative
    document.querySelectorAll('input[name="pointAwal"], input[name="pointAkhir"]').forEach(input => {
        input.addEventListener('input', function() {
            // Ensure value is always negative
            let value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            this.value = value ? `-${value}` : ''; // Prepend minus sign to the value
        });
    });
</script>
