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

                                            <form action="{{ route('datasiswa.destroy', $student->id) }}" class="d-inline" method="POST">
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

    <!-- Scripts for handling modal actions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show modal for adding data
            document.getElementById('tambahDataBtn').addEventListener('click', function () {
                fetch('/datasiswa/create') // Adjust to the correct route that returns the form
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalBody').innerHTML = html; // Load create form
                        document.getElementById('dataModalLabel').innerText = 'Tambah Data Siswa';
                        new bootstrap.Modal(document.getElementById('dataModal')).show();
                    })
                    .catch(error => console.error('Error loading create form:', error));
            });

            // Show modal for editing data
            document.querySelectorAll('.editBtn').forEach(button => {
                button.addEventListener('click', function () {
                    const studentId = this.getAttribute('data-id');
                    fetch(`/datasiswa/edit/${studentId}`) // Fetch the edit form for the specific student
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('modalBody').innerHTML = html; // Load edit form
                            document.getElementById('dataModalLabel').innerText = 'Edit Data Siswa';
                            new bootstrap.Modal(document.getElementById('dataModal')).show();
                        })
                        .catch(error => console.error('Error loading edit form:', error));
                });
            });
        });
    </script>
</x-layout>
