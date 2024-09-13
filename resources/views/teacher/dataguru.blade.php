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
                          <form action="/teacher/search" class="form-inline" method="GET">
                            <div class="card-item d-flex">
                                <input type="search" class="form-control col-md-11 col-14 mb-14 mr-2" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                <button type="submit" class="btn btn-primary mb-2">Cari</button>
                            </div>
                        </form>
                      </div>

                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle;">No</th>
                                        <th style="text-align: center; vertical-align: middle;">NIP</th>
                                        <th style="text-align: center; vertical-align: middle;">Nama Guru</th>
                                        <th style="text-align: center; vertical-align: middle;">Jabatan</th>
                                        <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                        @if (auth()->user()->role == 'admin')
                                        <th style="text-align: center; vertical-align: middle;">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teacher as  $teachers)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">
                                            {{ ($teacher->currentPage() - 1) * $teacher->perPage() + $loop->iteration }}
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $teachers->nis }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $teachers->namaguru }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $teachers->jabatan }}</td>
                                        <td style="text-align: center; vertical-align: middle;">{{ $teachers->jk }}</td>
                                        @if (auth()->user()->role == 'admin')
                                        <td style="text-align: center; vertical-align: middle;">
                                            <button class="btn btn-primary editBtn btn-sm" data-id="{{ $teachers->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('destroy.guru', $teachers->id) }}" method="POST" class="d-inline deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm deleteBtn">
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
                                    {{ $teacher->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
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
@include('teacher.confirgurujs')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Scripts for handling modal actions -->
  <script>
    document.getElementById('search-input').addEventListener('input', function() {
      if (this.value === '') {
        window.location.href = "{{ url('/teacher') }}"; // Kembali ke data semula
      }
    });
</script>
</x-layout>
