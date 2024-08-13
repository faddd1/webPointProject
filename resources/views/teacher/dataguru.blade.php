<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-bold">DATA GURU SMKN 1 kAWALI</h3> 
                <div class="card-tools">
                  <a href="{{ url('teacher/create') }}" class="btn btn-primary">Tambah Data</a>
                </div>
              </div>
  
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nip</th>
                      <th>Nama Guru</th>
                      <th>Jabatan</th>
                      <th>Jenis Kelamin</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
  
                    @foreach ($teacher as $no=>$teacher)
                        
                  
                    <tr>
                      <td>{{ $no+1 }}</td>
                      <td>{{ $teacher->nip }}</td>
                      <td>{{ $teacher->namaguru }}</td>
                      <td>{{ $teacher->jabatan }}</td>
                      <td>{{ $teacher->jk }}</td>
                      @if (auth()->user()->role == 'admin')
                      <td>
                        <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-primary">
                          <i class="fa-solid fa-pen-to-square "></i>    Edit
                        </a>
                        <form action="{{ route('teacher.destroy', $teacher->id)}}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                      </form>
                      </td>
                      @endif
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
  
  
  </x-layout>