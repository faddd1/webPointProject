<style>
    .btn-primary-custom {
    background-color: #245c70;
    color: #fff;
}
    .btn-primary-custom:hover{
    color: #fff;
}
</style>
<form action="{{ route('tambahPetugas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama :</label>
        <input type="text" id="name" name="name" class="form-control">
    </div>
    <div class="mb-3">
        <label for="nis" class="form-label">Nis :</label>
        <input type="text" id="nis" name="nis" class="form-control">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password :</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-group mb-4">
        <label class="form-label d-block">Status :</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role" value="Petugas" {{ old('role') == 'Petugas' ? 'checked' : '' }} required>
            <label class="form-check-label" for="role">Petugas</label>
        </div>
    </div>
    <div class="py-3">
        <button type="submit" class="btn btn-primary-custom btn-block">Save</button>
    </div>
</form>