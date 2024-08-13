<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
  
    <section class="container">
        <div class="container-fluid">
                  <!-- Form Pelaporan Pelanggaran -->
                  <div id="reportForm" class="d-none">
                      <h3 class="mb-4">Detail Pelanggaran</h3>
                      <div class="mb-3">
                          <label for="selectedStudent" class="form-label">Siswa:</label>
                          <input type="text" class="form-control" id="selectedStudent" readonly>
                      </div>
                      <div class="mb-3">
                          <label for="violation" class="form-label">Pilih Pelanggaran:</label>
                          <select class="form-select" id="violation">
                              <option selected>Pilih pelanggaran...</option>
                              <option value="Terlambat">Terlambat - 5 poin</option>
                              <option value="Tidak memakai seragam">Tidak memakai seragam - 10 poin</option>
                              <option value="Membawa barang terlarang">Membawa barang terlarang - 20 poin</option>
                              <option value="Bolos">Bolos - 15 poin</option>
                              <!-- Tambahkan pelanggaran lainnya sesuai kebutuhan -->
                          </select>
                      </div>
                      
                      <!-- Tombol Kirim Laporan -->
                      <button class="btn btn-primary" id="submitReport">Kirim Laporan</button>
                  </div>
              </div>
        </div>
    </section>
  </x-layout>
  