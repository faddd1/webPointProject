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
                    <div class="card shadow-sm">
                        <div class="card-header text-white"  style="background-color: #4D869C; ">
                            <h3 class="card-title p-1">Informasi Profil</h3>
                        </div>
                        <div class="card-body bg-light">
                            <ul class="list-group list-group-flush">
                                @if(auth()->check() && (auth()->user()->role == 'admin'))
                                    <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->nis }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->name ?? 'tidak diketahui' }}</li>
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
