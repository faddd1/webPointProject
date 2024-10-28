<head>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<div class="hukuman edit">
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
        <button type="submit" class="btn btn-block btn-primary-custom">Simpan</button>
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
