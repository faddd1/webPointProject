<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="container-fluid">
      <div class="col-12">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title text-bold">DATA GURU SMKN 1 KAWALI</h3> 
                          <div class="card-tools">
                              @if (auth()->user()->role == 'admin')
                              <a href="{{ url('teacher/create') }}" class="btn btn-primary" id="tambahDataBtn">Tambah Data</a>
                              @endif
                          </div>
                      </div>

                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>NIP</th>
                                      <th>Nama Guru</th>
                                      <th>Jabatan</th>
                                      <th>Jenis Kelamin</th>
                                      @if (auth()->user()->role == 'admin')
                                      <th>Action</th>
                                      @endif
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($teacher as $no => $teacher)
                                  <tr>
                                      <td>{{ $no+1 }}</td>
                                      <td>{{ $teacher->nip }}</td>
                                      <td>{{ $teacher->namaguru }}</td>
                                      <td>{{ $teacher->jabatan }}</td>
                                      <td>{{ $teacher->jk }}</td>
                                      @if (auth()->user()->role == 'admin')
                                      <td>
                                          <a href="#" class="btn btn-primary editBtn" data-id="{{ $teacher->id }}">
                                              <i class="fa-solid fa-pen-to-square"></i>
                                          </a>
                                          <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" class="d-inline deleteForm">
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
                  window.location.href = "{{ url('teacher/create') }}";
              }
          });
      });

      // Alert for "Edit" button
      document.querySelectorAll('.editBtn').forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent the default link behavior
              const teacherId = this.getAttribute('data-id');
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
                      window.location.href = `/teacher/${teacherId}/edit`;
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
