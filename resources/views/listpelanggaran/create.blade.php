<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="conteiner">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('listpelanggaran.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" name="nis" placeholder="NIS" required>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Siswa" required>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control" name="kelas" placeholder="Kelas" required>
                            </div>
                            <div class="form-group">
                                <label>Pelapor</label>
                                <input type="text" class="form-control" name="pelapor" placeholder="Nama Pelapor" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" class="form-control" name="tanggal" placeholder="Tanggal" required>
                            </div>
                            <div class="form-group">
                                <label>Point yang Diberikan</label>
                                <input type="text" class="form-control" name="point" placeholder="Point yang Diberikan" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </form>
                    </div>
                </div>
        </div>
    </section>
</x-layout>
