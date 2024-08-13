<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                            <div class="card-header">
                                <div class="card-item d-flex flex-wrap">
                                    <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="jk">
                                        <option>PILIH KELAS</option>
                                        <option value="X">X</option>
                                        <option value="XII">XII</option>
                                        <option value="XIII">XIII</option>
                                    </select>

                                    <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="jk">
                                        <option>PILIH JURUSAN</option>
                                        <option value="TKR">TKR</option>
                                        <option value="TKJ">TKJ</option>
                                        <option value="PPLG">PPLG</option>
                                        <option value="DPIB">DPIB</option>
                                        <option value="MP">MP</option>
                                        <option value="AK">AK</option>
                                        <option value="SK">SK</option>
                                    </select>

                                    <select class="card-item form-control col-md-2 col-6 mb-2 mr-2" name="jurusanberapa">
                                        <option>Kelas berapa</option>
                                        <option value="TKR">1</option>
                                        <option value="TKJ">2</option>
                                        <option value="PPLG">3</option>
                                        
                                    </select>

                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                </div>
                            </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Jumlah Point</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
