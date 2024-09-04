<form action="{{ route('tambah.update', ['id' => $data->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text"  name="nis" value="{{ $data->nis }}" class="form-control">
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

    <button type="submit" class="btn btn-primary btn-block mt-3">Save</button>
</form>