<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="container mt-5">
       
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="dist/img/user2-160x160.jpg" class="card-img-top" alt="Profile Picture">
                    <div class="card-body text-center">
                        <h5 class="card-title">Fadli Alam Akbar</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Profil Informasi</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="name">NIS</label>
                                <input type="text" class="form-control" id="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">NAMA</label>
                                <input type="text" class="form-control" id="name" value="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="name">KELAS</label>
                                <input type="text" class="form-control" id="name" value="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="name">JURUSAN</label>
                                <input type="text" class="form-control" id="name" value="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="name">JENIS KELAMIN</label>
                                <input type="text" class="form-control" id="name" value="John Doe">
                            </div>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
    </div>
</x-layout>