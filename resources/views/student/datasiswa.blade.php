<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">DATA SISWA SMKN 1 KAWALI</h3>
                            @if (auth()->user()->role == 'admin')
                            <div class="card-tools">
                                <button class="btn btn-primary" id="tambahDataBtn">Tambah Data</button>
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
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $student->nis }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $student->kelas }}</td>
                                        <td>{{ $student->jurusan }}</td>
                                        <td>{{ $student->jk }}</td>
                                        @if (auth()->check() && (auth()->user()->role == 'admin'))
                                        <td>
                                            <button class="btn btn-primary editBtn" data-id="{{ $student->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <form action="{{ route('datasiswa.destroy', $student->id) }}" class="d-inline deleteForm" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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

    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> <!-- Or use an icon -->
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Content will be loaded here via JavaScript -->
                </div>
            </div>
        </div>
    </div>


  <!-- SweetAlert and JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts for handling modal actions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show modal for adding data
            document.getElementById('tambahDataBtn').addEventListener('click', function () {
            event.preventDefault(); // Prevent the default link behavior
          Swal.fire({
              title: 'Tambah Data',
              text: "Apakah Anda yakin ingin menambah data baru?",
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Tambah!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                fetch('/datasiswa/create') // Adjust to the correct route that returns the form
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html; // Load create form
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Siswa';
                    new bootstrap.Modal(document.getElementById('dataModal')).show();
                })
                .catch(error => console.error('Error loading create form:', error));
              }
          });

        });



            // Show modal for editing data
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function () {
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
                            fetch(`/datasiswa/edit/${studentId}`) // Fetch the edit form for the specific student
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html; // Load edit form
                                document.getElementById('dataModalLabel').innerText = 'Edit Data Siswa';
                                new bootstrap.Modal(document.getElementById('dataModal')).show();
                            })
                            .catch(error => console.error('Error loading edit form:', error));
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
        });
    </script>

    {{-- <script>
      // Alert for "Tambah Data" button
      document.getElementById('tambahDataBtn').addEventListener('click', function(event) {
          event.preventDefault(); // Prevent the default link behavior
          Swal.fire({
              title: 'Tambah Data',
              text: "Apakah Anda yakin ingin menambah data baru?",
              icon: 'question',
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

    
  </script> --}}
</x-layout>
