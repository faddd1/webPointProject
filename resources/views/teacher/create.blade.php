<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="conteiner">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('teacher.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>NIP</label>
                                <input type="text" class="form-control" name="nip" placeholder="KETIK NIP" required>
                            </div>
                            <div class="form-group">
                                <label>NAMA GURU</label>
                                <input type="text" class="form-control" name="namaguru" placeholder="KETIK NAMA GURU" required>
                            </div>
                            <div class="form-group">
                                <label>JABATAN</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="KETIK JABATAN" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jk" id="jkLaki" value="Laki-laki" required>
                                        <label class="form-check-label" for="jkLaki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jk" id="jkPerempuan" value="Perempuan" required>
                                        <label class="form-check-label" for="jkPerempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </form>
                    </div>
                </div>
        </div>
    </section>
</x-layout>
