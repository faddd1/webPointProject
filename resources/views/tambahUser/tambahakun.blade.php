<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-13">
                <div class="card">
                    <div class="card-header">

                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info">Siswa</button>
                            <button type="button" class="btn btn-success">Guru</button>
                            <button type="button" class="btn btn-danger ">Petugas</button>

                        </div>  


                        <div class="card-tools">
                            <a href="{{ url('tambah/user') }}" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach( $data as $no=>$data)
                                        
                                
                                    <tr>
                                        <td>{{ $no+1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->plain_password }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td class="d-inline">
                                            <a href="{{ route('tambah.edit', $data->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square "></i></a>
                                            <form action="{{ route('tambah.destroy', $data->id )}}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
