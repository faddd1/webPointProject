<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div class="container">
      <div class="container-fluid">
          <div class="row justify-content-center">
              <div class="col-12">
                  @if (session('success'))
                      <script>
                          Swal.fire({
                              title: "BERHASIL",
                              text: "{{ session('success') }}",
                              icon: "success"
                          });
                      </script>
                  @endif
                  <div class="card">
                      <div class="card-header">
                          <div class="card-tools">
                              @if (auth()->user()->role == 'admin')
                                  <button class="btn btn-sm" style="background-color:#245c70; color:#ffff; margin-top: 5px; margin-right: 10px;" id="tambahHukuman">
                                      <i class="fa-solid fa-circle-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
                                  </button>
                               @endif 
                          </div>
                          <form action="{{ route('hukuman.search') }}" class="form-inline" method="GET">
                              <div class="card-item d-flex">
                                  <div class="input-group">
                                      <input type="search" class="form-control" name="search" placeholder="Cari" value="{{ request()->input('search') }}" id="search-input">
                                      <div class="input-group-append">
                                          <button type="submit" class="btn" style="background-color: #266278; color: #fff;">
                                              <i class="fa-solid fa-magnifying-glass"></i> <!-- Ikon pencarian -->
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                          
                          <style>
                              .input-group {
                                  width: 100%; 
                                  max-width: 200px; 
                              }

                              .input-group .form-control {
                                  border-radius: 0.25rem 0 0 0.25rem; 
                                  flex: 1; 
                                  height: 30px; 
                                  font-size: 0.875rem; 
                              }

                              .input-group .btn {
                                  border-radius: 0 0.25rem 0.25rem 0;
                                  background-color: #266278; 
                                  color: #fff; 
                                  height: 30px; 
                                  padding: 0 10px; 
                              }

                              @media (max-width: 576px) {
                                  .input-group {
                                      flex-direction: row; 
                                      max-width: 180px; 
                                  }
                              }

                              .action-buttons {
                                  display: flex;
                                  justify-content: center;
                                  gap: 5px;
                              }

                              @media (max-width: 576px) {
                                  .action-buttons {
                                      flex-direction: row; 
                                  }
                              }

                              .btn-danger:hover, .btn-primary:hover {
                                  transition: transform 0.5s ease;
                                  transform: translateY(-5px);
                              }
                          </style>
                      </div>
                      
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover table-bordered table-sm" style="background-color: #ffff; font-size: 13px; border-radius: 5px 5px 0 0; overflow: hidden;">
                                  <thead>
                                      <tr style="background-color: #4D869C; color:#ffff;">
                                          <td style="text-align: center; vertical-align: middle;" class="py-2">No</td>
                                          <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Nama Hukuman</td>
                                          <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Poin</td>
                                          {{-- @if (auth()->check() && auth()->user()->role == 'admin') --}}
                                              <td style="text-align: center; vertical-align: middle; white-space: nowrap;">Aksi</td>
                                          {{-- @endif --}}
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($punismen as $no => $item)
                                          <tr>
                                              <td style="text-align: center; vertical-align: middle;">{{$no+1}}</td>
                                              <td style="text-align: center; vertical-align: middle; white-space: nowrap;">{{$item->nama_hukuman}}</td>
                                              <td style="text-align: center; vertical-align: middle; white-space: nowrap;">({{$item->pointAwal}}) Sampai ({{ $item->pointAkhir }})</td>
                                              <td style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                <div class="action-buttons text-center align-middle">
                                                    <button class="btn btn-sm btn-primary editBtn" data-id="{{ $item->id }}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <form action="{{ route('hukuman.destroy', $item->id )}}" class="d-inline col-mb-2 deleteForm" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="card-footer mt-3" style="background: #fff;">                            
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <style>
                                        .pagination .page-link {
                                            color: #245c70; /* Warna teks */
                                            background-color: #f8f9fa; /* Warna latar */
                                            border-color: #dee2e6; /* Warna border */
                                        }

                                        .pagination .page-link:hover {
                                            color: #245c70; 
                                            background-color: #e9ecef; 
                                            border-color: #dee2e6;
                                        }

                                        .pagination .active .page-link {
                                            color: white;
                                            background-color: #245c70;
                                            border-color: #245c70;
                                        }
                                    </style>
                                    {{ $punismen->links('pagination::bootstrap-4') }}
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
                      <h5 class="modal-title" id="dataModalLabel">Tambah Data Pelanggaran</h5>
                      <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"><i class="fa-solid fa-arrow-right"></i></a>
                  </div>
                  <div class="modal-body" id="modalBody">
                      <!-- Konten akan dimuat via JavaScript -->
                  </div>
              </div>
          </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
         document.getElementById('search-input').addEventListener('input', function() {
            if (this.value === '') {
                window.location.href = "{{ url('/hukuman') }}";
            }
        });
          document.addEventListener('DOMContentLoaded', function () {
              document.getElementById('tambahHukuman').addEventListener('click', function (event) {
                  event.preventDefault();
                  fetch('/hukuman/create')
                      .then(response => response.text())
                      .then(html => {
                          document.getElementById('modalBody').innerHTML = html;
                          document.getElementById('dataModalLabel').innerText = 'Tambah Hukuman';
                          const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                          dataModal.show();
                      })
                      .catch(error => console.error('Gagal memuat form tambah:', error));
              });
          });
          document.querySelectorAll('.editBtn').forEach(button => {
           button.addEventListener('click', function () {
             const hukumanId = this.getAttribute('data-id');
             
             fetch(`/hukuman/edit${hukumanId}`)
               .then(response => response.text())
               .then(html => {
                 document.getElementById('modalBody').innerHTML = html;
                 document.getElementById('dataModalLabel').innerText = 'Edit Data Hukuman';
                 const dataModal = new bootstrap.Modal(document.getElementById('dataModal'));
                 dataModal.show();
               })
               .catch(error => console.error('Error loading edit form:', error));
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
  </div>

  <script>
    function test(event, formId){
        event.target.setAttribute('disabled','disabled');
        const a =  document.querySelector(`#${formId}`);
        a.submit();
    } 
</script>
</x-layout>
