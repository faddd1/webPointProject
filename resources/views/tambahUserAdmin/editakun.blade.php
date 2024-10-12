<form action="{{ route('tambah.update', ['id' => $data->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Admin Id</label>
        <input type="text"  name="nis" value="{{ $data->nis }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="text"  name="password" value="{{ $data->plain_password }}" class="form-control">
    </div>

    <div class="form-group mb-4">
        <label class="form-label d-block">Status</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role" value="Admin" {{ $data->role == 'admin' ? 'checked' : '' }} required>
            <label class="form-check-label" for="role">Admin</label>
        </div>
    </div>


    <button type="submit" class="btn btn-primary btn-block mt-3">Save</button>
</form>