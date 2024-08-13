<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tambah.update', ['id' => $data->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text"  name="username" value="{{ $data->username }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="text"  name="password" value="{{ $data->plain_password }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="role" value="{{ $data->role }}" required>
                                    <option value="">PIlih Status</option>
                                    <option value="admin"{{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ $data->role == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="petugas" {{ $data->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    <option value="siswa" {{ $data->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                </select>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>