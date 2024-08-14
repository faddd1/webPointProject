<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <div class="card-body">
                            <form action="{{ route('tambah.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text"  name="username" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text"  name="password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="role" required>
                                        <option value="">PIlih Status</option>
                                        <option value="admin">Admin</option>
                                        <option value="guru">Guru</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="siswa">Siswa</option>
                                    </select>
                             
                                    <button class="btn btn-primary col-md-10 mt-3 ml-2" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>