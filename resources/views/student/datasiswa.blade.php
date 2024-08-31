<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="container">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title text-bold">DATA SISWA SMKN 1 KAWALI</h3> 
                          @if (auth()->user()->role == 'admin')
                          <div class="card-tools">
                              <a href="{{ url('datasiswa/create') }}" class="btn btn-primary" id="tambahDataBtn">Tambah Data</a>
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
                                      <th>Kelas</th>
                                      <th class="col-2">Jurusan</th>
                                      <th>Jenis Kelamin</th>
                                      @if (auth()->check() && (auth()->user()->role == 'admin'))
                                      <th>Action</th>
                                      @endif
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($studentItem as $no => $student)
                                  <tr>
                                      <td>{{ $no+1 }}</td>
                                      <td>{{ $student->nis }}</td>
                                      <td>{{ $student->nama }}</td>
                                      <td>{{ $student->kelas }}</td>
                                      <td>{{ $student->jurusan }}</td>
                                      <td>{{ $student->jk }}</td>
                                      @if (auth()->check() && (auth()->user()->role == 'admin'))
                                      <td>
                                          <a href="#" class="btn btn-primary editBtn" data-id="{{ $student->id }}">
                                              <i class="fa-solid fa-pen-to-square"></i>
                                          </a>
                                          <form action="{{ route('datasiswa.destroy', $student->id) }}" method="POST" class="d-inline deleteForm">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger deleteBtn">
                                                  <i class="fa-solid fa-trash"></i>
                                              </button>
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
  </div>

  <!-- SweetAlert and JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      // Alert for "Tambah Data" button
      document.getElementById('tambahDataBtn').addEventListener('click', function(event) {
          event.preventDefault(); // Prevent the default link behavior
          Swal.fire({
              title: 'Tambah Data',
              text: "Apakah Anda yakin ingin menambah data baru?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Tambah!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = "{{ url('datasiswa/create') }}";
              }
          });
      });

      // Alert for "Edit" button
      document.querySelectorAll('.editBtn').forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent the default link behavior
              const studentId = this.getAttribute('data-id');
              Swal.fire({
                  title: 'Edit Data',
                  text: "Apakah Anda yakin ingin mengedit data ini?",
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Edit!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = `/student/${studentId}/edit`;
                  }
              });
          });
      });

      // Alert for "Delete" button
      document.querySelectorAll('.deleteForm').forEach(form => {
          form.addEventListener('submit', function(event) {
              event.preventDefault(); // Prevent the form from submitting
              Swal.fire({
                  title: 'Hapus Data',
                  text: "Apakah Anda yakin ingin menghapus data ini?",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!',
                  cancelButtonText: 'Batal'
              }).then((result) => {
                  if (result.isConfirmed) {
                      form.submit(); // Submit the form
                  }
              });
          });
      });
  </script>
</x-layout>
