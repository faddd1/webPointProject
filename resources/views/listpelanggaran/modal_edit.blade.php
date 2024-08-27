<div class="modal fade" id="showDataModal" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Detail Data Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div id="dataDetail"><div>
                    <p><strong>NIS:</strong> {{ $pelanggaran->nis }}</p>
                    <p><strong>Nama:</strong> {{ $pelanggaran->nama }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $pelanggaran->jk }}</p>
                    <p><strong>Kelas:</strong> {{ $pelanggaran->kelas }}</p>
                    <p><strong>Jenis Pelanggaran:</strong> {{ $pelanggaran->jenis }}</p>
                    <p><strong>Point:</strong> {{ $pelanggaran->point }}</p>
                    <p><strong>Pelapor:</strong> {{ $pelanggaran->pelapor }}</p>
                    <p><strong>Tanggal:</strong> {{ $pelanggaran->tanggal }}</p>
                    <p><strong>Bukti:</strong> <a href="{{ asset('storage/' . $pelanggaran->bukti) }}" target="_blank">Lihat Bukti</a></p>
</div>
</div>
            </div>
        </div>
    </div>
</div>