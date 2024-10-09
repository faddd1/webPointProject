<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="dist/img/user2-160x160.jpg" class="card-img-top" alt="Profile Picture">
                        <div class="card-body text-center" >
                            <h3 class="card-title" >{{ Auth::user()->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title p-1">Informasi Profil</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @if(auth()->check() && (auth()->user()->role == 'admin'))
                                    <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->nis }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->name ?? 'tidak diketahui' }}</li>
                                @endif

                                @if(auth()->check() && (auth()->user()->role == 'petugas'))

                                <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->nis ?? 'tidak diketahui' }}</li>
                                <li class="list-group-item"><strong>Kelas:</strong>  {{ Auth::user()->petugas->kelas ?? 'tidak diketahui' }} </li>
                                <li class="list-group-item"><strong>Jurusan:</strong> {{ Auth::user()->petugas->jurusan ?? 'tidak diketahui' }} </li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->petugas->jk ?? 'tidak diketahui' }} </li>
                                <li class="list-group-item"><strong>Nama Organisasi:</strong> {{ Auth::user()->petugas->namao ?? 'tidak diketahui' }} </li>
                                @endif
                                @if(auth()->check() && (auth()->user()->role == 'guru'))
                                <li class="list-group-item"><strong>Nip:</strong> {{ Auth::user()->nis}}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->guru->namaguru ?? 'tidak diketahui' }}</li>
                                <li class="list-group-item"><strong>Jabatan:</strong>  {{ Auth::user()->guru->jabatan ?? 'tidak diketahui' }} </li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->guru->jk ?? 'tidak diketahui' }} </li>
                                @endif
                                @if(auth()->check() && (auth()->user()->role == 'siswa'))
                                    <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->siswa->nis ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->siswa->nama ?? 'tidak diketahui' }}</li>
                                    <li class="list-group-item"><strong>Kelas:</strong>  {{ Auth::user()->siswa->kelas ?? 'tidak diketahui' }} </li>
                                    <li class="list-group-item"><strong>Jurusan:</strong> {{ Auth::user()->siswa->jurusan ?? 'tidak diketahui' }} </li>
                                    <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ Auth::user()->siswa->jk ?? 'tidak diketahui' }} </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
