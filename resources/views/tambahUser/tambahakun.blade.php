<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-13">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">

                        <div class="btn-group col-sm-5" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info">Siswa</button>
                            <button type="button" class="btn btn-success">Guru</button>
                            <button type="button" class="btn btn-danger ">Petugas</button>

                        </div>  

                        <div class="card-tools">
                            <button class="btn btn-primary btn-md" id="tambahDataBtn"><i class="fa-solid fa-user-plus"></i> Tambah Akun</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center; vertical-align: middle;">Nama</th>
                                        <th style="text-align: center; vertical-align: middle;">Username</th>
                                        <th style="text-align: center; vertical-align: middle;">Password</th>
                                        <th style="text-align: center; vertical-align: middle;">Role</th>
                                        <th style="text-align: center; vertical-align: middle;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach( $data as $no=>$data)
                                        
                                
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{ $no+1 }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $data->name }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $data->username }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $data->plain_password }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $data->role }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button data-id="{{ $data->id }}" class="btn btn-info editBtn"><i class="fa-solid fa-pen-to-square "></i></button>
                                            <form action="{{ route('tambah.destroy', $data->id )}}" class="d-inline col-mb-2 deleteForm">
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

<!--add dan edit-->
    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="dataModalLabel"></h5>
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

    <!--js-->
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
                fetch('tambah/user') // Adjust to the correct route that returns the form
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html; // Load create form
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Akun';
                    new bootstrap.Modal(document.getElementById('dataModal')).show();
                })
                .catch(error => console.error('Error loading create form:', error));
                }
            });

        });



            // Show modal for editing data
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Edit Data',
                        text: "Apakah Anda yakin ingin mengedit data ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Edit!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`tambah/edit${userId}`) // Fetch the edit form for the specific student
                            .then(response => response.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html; // Load edit form
                                document.getElementById('dataModalLabel').innerText = 'Edit Data Akun';
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
                            icon: 'question',
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
