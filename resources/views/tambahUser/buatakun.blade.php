<form action="{{ route('tambah.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama :</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username :</label>
        <input type="text" id="username" name="username" class="form-control">
        @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
            </div>
        @endif
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password :</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Status :</label>
        <select class="form-control" name="role">
            <option value="">PIlih Status</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="petugas">Petugas</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>
    <div class="py-3">
        <button type="submit" class="btn btn-primary btn-block">Save</button>
    </div>
</form>