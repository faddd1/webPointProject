w <x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="conteiner">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Pelanggaran</label>
                                <input type="text" class="form-control" name="pelanggaran" placeholder="Nama Pelanggaran" required>
                            </div>
                            <div class="form-group">
                                <label>Point yang Diberikan</label>
                                <input type="text" class="form-control" name="point" placeholder="Point yang Diberikan" required>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level" required>
                                    <option value="">Pilih Level</option>
                                    <option value="ringan">Ringan</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="berat">Berat</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </form>
                    </div>
                </div>
        </div>
    </section>
</x-layout>
