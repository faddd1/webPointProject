<head>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<div class="form-container">
    <form id="formHukuman" action="{{ route('hukuman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Hukuman</label>
            <input type="text" class="form-control form-control-custom" name="nama_hukuman" placeholder="Nama hukuman" required>
        </div>
        
        <div class="form-group">
            <label>Poin Awal</label>
            <input type="text" class="form-control form-control-custom" name="pointAwal" placeholder="Poin Awal" required>
        </div>

            <div class="form-group">
                <label>Poin Akhir</label>
                <input type="text" class="form-control form-control-custom" name="pointAkhir" placeholder="Poin Akhir" required>
            </div>
        <button type="submit" class="btn btn-block btn-primary-custom" onclick="test(event, 'formHukuman')">Tambah</button>
</div>

<script>
    document.querySelectorAll('input[name="pointAwal"], input[name="pointAkhir"]').forEach(input => {
        input.addEventListener('input', function() {
            // Ensure value is always negative
            let value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            this.value = value ? `-${value}` : ''; // Prepend minus sign to the value
        });
    });
</script>
