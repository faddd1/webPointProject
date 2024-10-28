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
        border-color: #4F709C;
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
    <form  id="formPasal" action="{{ route('kategori.createPasal') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Pasal</label>
            <input type="text" class="form-control" name="level" placeholder="Nama Pasal" required>
        </div>
        <div class="form-group">
            <label>Jenis Pasal</label>
            <input type="text" class="form-control" name="jenis" placeholder="Jenis Pasal" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
        </div>
        
        <button type="submit" class="btn btn-block btn-primary-custom" id="submitButton" id="submitButton" onclick="test(event, 'formPasal')">Tambah</button>
    </form>
</div>

<script>
    function test(event, formId){
        event.target.setAttribute('disabled','disabled');
        const a =  document.querySelector(`#${formId}`);
        a.submit();
    } 
  </script>


