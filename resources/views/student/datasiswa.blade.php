<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-bold">DATA SISWA SMKN 1 kAWALI</h3> 
              @if (auth()->user()->role == 'admin')
              <div class="card-tools">
                
                <a href="{{ url('student/create') }}" class="btn btn-primary">Tambah Data</a>
              </div>
              @endif
            </div>

            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama Siswa</th>
                    <th>kelas</th>
                    <th>Jenis Kelamin</th>
                    <th class="col-2">Jurusan</th>
                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))             
                    <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>

                  @foreach ($student as $no=>$student)
                      
                
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>{{ $student->jurusan }}</td>
                    <td>{{ $student->jk }}</td>
                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'))    
                    <td>
                      <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square "></i>Edit
                      </a>
                      <form action="{{ route('student.destroy', $student->id)}}" method="POST" class="d-inline">
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