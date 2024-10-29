<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="row">
                <!-- Profile Card -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png" class="card-img-top rounded-circle mx-auto mt-3" alt="Profile Picture" style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #f8f9fa;">
                        <div class="card-body text-center">
                            <h3 class="card-title font-weight-bold">{{ Auth::user()->name}}</h3>
                        </div>
                    </div>
                </div>
                <!-- Profile Info Card -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" style="background-color: #4F709C; color: #fff;">
                            <h3 class="card-title p-1" >Informasi Profil</h3>
                        </div>
                        <style>
                            .col-auto {
                                padding-left: 0;
                                padding-right: 5px; 
                            }
                        </style>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if(auth()->check() && (auth()->user()->role == 'admin'))
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-2"><strong>Admin Id</strong></div>
                                            <div class="col-auto">:</div>
                                            <div class="col">{{ Auth::user()->nis }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-2"><strong>Nama</strong></div>
                                            <div class="col-auto">:</div>
                                            <div class="col">{{ Auth::user()->name ?? 'tidak diketahui' }}</div>
                                        </div>
                                    </li>
                                </ul>
                                @endif

                                @if(auth()->check() && (auth()->user()->role == 'petugas'))
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->nis ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Kelas:</strong>  {{ Auth::user()->petugas->kelas ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jurusan:</strong> {{ Auth::user()->petugas->jurusan ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->petugas->jk ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Nama Organisasi:</strong> {{ Auth::user()->petugas->namao ?? 'tidak diketahui' }}</li>
                                @endif
                                
                                @if(auth()->check() && (auth()->user()->role == 'guru'))
                                    <li class="list-group-item"><strong>Nip:</strong> {{ Auth::user()->nis }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->guru->namaguru ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jabatan:</strong>  {{ Auth::user()->guru->jabatan ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->guru->jk ?? 'tidak diketahui' }}</li>
                                @endif
                                
                                @if(auth()->check() && (auth()->user()->role == 'siswa'))
                                    <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->siswa->nis ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->siswa->nama ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Kelas:</strong>  {{ Auth::user()->siswa->kelas ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jurusan:</strong> {{ Auth::user()->siswa->jurusan ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->siswa->jk ?? 'tidak diketahui' }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
