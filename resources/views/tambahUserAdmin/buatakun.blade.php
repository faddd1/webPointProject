<style>
    .btn-primary-custom {
        background-color: #4F709C;
        color: #fff;
    }
    .btn-primary-custom:hover {
        color: #fff;
    }
    .form-control-custom {
        border: 1px solid #4F709C;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        transition: border-color 0.3s ease-in-out;
    }
    .form-control-custom:focus {
        border-color: #4D869C;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.2);
    }
    .form-group label {
        font-weight: bold;
        color: #4F709C;
    }
    .form-container {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
</style>
<div class="form-container">
    <form action="{{ route('tambah.store') }}" method="POST">
        @csrf
        <div  class="form-group mb-4">
            <label for="name" class="form-label">Nama :</label>
            <input type="text" id="name" name="name" placeholder="Nama" class="form-control">
        </div>
        <div  class="form-group mb-4">
            <label for="nis" class="form-label">Admin Id :</label>
            <input type="text" id="nis" name="nis" placeholder="Admin Id" class="form-control">
        </div>
        <div  class="form-group mb-4">
            <label for="password" class="form-label">Password :</label>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label class="form-label d-block">Status</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="role" value="Admin" {{ old('role') == 'Admin' ? 'checked' : '' }} required>
                <label class="form-check-label" for="role">Admin</label>
            </div>
        <div class="py-3">
            <button type="submit" class="btn btn-primary-custom btn-block">Simpan</button>
        </div>
    </form>
</div>
