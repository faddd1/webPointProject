<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- @include('page.boost') --}}
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center">
                            <h4 class="card-title text-md" style="margin-top: 5px;">Halo, <span class="text-bold">Ade Farhan Gunawan</span>!</h4>
                            <div class="card-tools">
                                <span class="me-2">Sisa Poin :</span>
                                <a class="btn btn-warning btn-sm" style="color: #fff;">144/200</a>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="mt-2" style="font-size: 15px; display: flex; flex-direction: column;">
                                <p class="mb-2">Nis :<span class="text-bold ms-2">222310217</span></p>
                                <p class="mb-2">Kelas :<span class="text-bold ms-2">12</span></p>
                                <p class="mb-2">Jenis Kelamin :<span class="text-bold ms-2">Laki-Laki</span></p>
                                <p class="mb-2">Jurusan :<span class="text-bold ms-2">PPLG 1</span></p>
                            </div>
                        </div> --}}
                        
                        <div class="card-body">
                            <div class="mt-1" style="font-size: 15px;">
                                <table>
                                    <tr>
                                        <td>NIS</td>
                                        <td>:</td>
                                        <td class="text-bold">222310217</td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td class="text-bold">12</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td class="text-bold">Laki-Laki</td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td class="text-bold">PPLG 1</td>
                                    </tr>
                                </table>
                                {{-- <p class="text-sm">Kamu Telah Melakukan Pelanggaran dan di Laporkan Oleh Pak <span class="text-bold">Ade</span></p> --}}
                            </div>
                        </div>
                        
                        
                    </div>
                        {{-- <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="text-lg">Halo, <span class="text-bold">Ade Farhan Gunawan</span></h4>
                            <div class="card-tools">
                                <span class="me-2">Sisa Poin Anda :</span>
                                <a class="btn btn-warning btn-sm ms-auto" style="color: #fff;">100</a>
                            </div>
                        </div>                                                 --}}
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-md py-2">Pelanggaran Yang Pernah Kamu Lakukan :</h4>
                            {{-- <div class="card-tools">
                                <a href="#" class="btn btn-secondary"> Tidak Melakukan?</a>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">No</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama Pelapor</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama Pelanggaran</th>
                                            <th style="text-align: center; vertical-align: middle;">Jumlah Point</th>
                                            <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">1</td>
                                            <td style="text-align: center; vertical-align: middle;">Ade</td>
                                            <td style="text-align: center; vertical-align: middle;">Bolos</td>
                                            <td style="text-align: center; vertical-align: middle;">22</td>
                                            <td style="text-align: center; vertical-align: middle;">5 Oktober 2024</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">2</td>
                                            <td style="text-align: center; vertical-align: middle;">Ade2</td>
                                            <td style="text-align: center; vertical-align: middle;">Bolos</td>
                                            <td style="text-align: center; vertical-align: middle;">22</td>
                                            <td style="text-align: center; vertical-align: middle;">5 Oktober 2024</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">3</td>
                                            <td style="text-align: center; vertical-align: middle;">Ade3</td>
                                            <td style="text-align: center; vertical-align: middle;">Bolos</td>
                                            <td style="text-align: center; vertical-align: middle;">22</td>
                                            <td style="text-align: center; vertical-align: middle;">5 Oktober 2024</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>