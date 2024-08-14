<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="conteiner">
        <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('student.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>NIS</label>
                                <input type="text" class="form-control" name="nis" placeholder="Enter NIS" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input type="text" class="form-control" name="nama" placeholder="Enter student name" required>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" class="form-control" name="kelas" placeholder="Enter class" required>
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
                            <div class="form-group">
                                <label>Jurusan</label>
                                <input type="text" class="form-control" name="jurusan" placeholder="Enter major" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </form>
                    </div>
                </div>
        </div>
    </section>
</x-layout>
