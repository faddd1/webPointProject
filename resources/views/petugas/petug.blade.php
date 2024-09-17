<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                    <script>
                      Swal.fire({
                        title: "SUCCESS",
                        text: "{{ session('success') }}",
                        icon: "success"
                        });
                    </script>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                @if (auth()->user()->role == 'admin')
                                <button class="btn btn-primary btn-sm" style="margin-top: 3px;" id="tambahDataBtn"><i class="fa-solid fa-circle-plus"></i> Add</button>
                                @endif
                            </div>
                            <form action="/datapetugas/search" class="form-inline" method="GET">
                                <div class="card-item d-flex">
                                    <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </div>
                            </form>
                        </div>
  
                        
                        <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover table-bordered table-sm">
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
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ ($petugas->currentPage() - 1) * $petugas->perPage() + $loop->iteration }}
                                        </td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->nis }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->namaP }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->kelas }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jk }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->jurusan }}</td>
                                          <td style="text-align: center; vertical-align: middle;">{{ $petugasd->namao }}</td>
                                          @if (auth()->user()->role == 'admin')
                                          <td style="text-align: center; vertical-align: middle; ">
                                              <button class="btn btn-sm btn-primary editBtn" data-id="{{ $petugasd->id }}">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                              </button>
                                              <form action="{{ route('petugas.delete', $petugasd->id) }}" method="POST" class="d-inline deleteForm">
                                                  @csrf
                                                  
                                                  <button type="submit" class="btn btn-sm btn-danger deleteBtn">
                                                      <i class="fa-solid fa-trash"></i>
                                                  </button>
                                              </form>
                                          </td>
                                          @endif
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              <div class="d-flex">
                                <div class="ml-auto">
                                    {{ $petugas->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                          </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Tambah Data Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                    
                </div>
                <div class="modal-body" id="modalBody">
                </div>
            </div>
        </div> 
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
       document.getElementById('search-input').addEventListener('input', function() {
         if (this.value === '') {
           window.location.href = "{{ url('/datapetugas') }}"; 
         }
       });
   
        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById('tambahDataBtn').addEventListener('click', function (event) {
                event.preventDefault();
                fetch('/datapetugas/tambah')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Tambah Data Petugas';
                    const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                    dataModal.show();
                })
                .catch(error => console.error('Error loading create form:', error));
            });
            document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const petugasId = this.getAttribute('data-id'); 
                fetch(`/datapetugas/edit/${petugasId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('dataModalLabel').innerText = 'Edit Data Petugas';
                    const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                    dataModal.show();
                })
                    .catch(error => console.error('Error loading edit form:', error));
                });
            });

                document.querySelectorAll('.deleteForm').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
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
                                form.submit(); 
                            }
                        });
                    });
                });
        });
    </script>
</x-layout>