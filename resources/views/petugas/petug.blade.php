<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="col-12">
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
                            <h3 class="card-title text-bold" style="margin-top: 7px;">Data Petugas</h3> 
                            <div class="card-tools">
                                @if (auth()->user()->role == 'admin')
                                <button class="btn btn-primary btn-md" id="tambahDataBtn"><i class="fa-solid fa-circle-plus"></i> Tambah Data</button>
                                @endif
                            </div>
                        </div>
  
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover table-bordered">
                                  <thead>
                                      <tr>
                                          <th style="text-align: center; vertical-align: middle;">No</th>
                                          <th style="text-align: center; vertical-align: middle;">NIS</th>
                                          <th style="text-align: center; vertical-align: middle;">Nama</th>
                                          <th style="text-align: center; vertical-align: middle;">Kelas</th>
                                          <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                          <th style="text-align: center; vertical-align: middle;">Jurusan</th>
                                          <th style="text-align: center; vertical-align: middle;">Organisasi</th>
                                          @if (auth()->user()->role == 'admin')
                                          <th style="text-align: center; vertical-align: middle;">Action</th>
                                          @endif
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($petugas as $no => $petugasd)
                                      <tr>
                                          <td style="text-align: center; vertical-align: middle;">{{ $no+1 }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->nis }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->namaP }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->kelas }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jk }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jurusan }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->namao }}</td>
                                          @if (auth()->user()->role == 'admin')
                                          <td style="text-align: center; vertical-align: middle;">
                                              <button class="btn btn-primary editBtn" data-id="{{ $petugasd->id }}">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                              </button>
                                              <form action="{{ route('petugas.delete', $petugasd->id) }}" method="POST" class="d-inline deleteForm">
                                                  @csrf
                                                  
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
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Petugas</h5>
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
                fetch('/datapetugas/tambah') // Adjust to the correct route that returns the form
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html; // Load create form
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Petugas';
                    new bootstrap.Modal(document.getElementById('dataModal')).show();
                })
                .catch(error => console.error('Error loading create form:', error));
                }
                });

            });



            // Show modal for editing data
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const petugasId = this.getAttribute('data-id');
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
                            fetch(`/datapetugas/edit/${petugasId}`) // Fetch the edit form for the specific student
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html; // Load edit form
                                document.getElementById('dataModalLabel').innerText = 'Edit Data Petugas';
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
</x-layout>