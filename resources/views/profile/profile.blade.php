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
                        {{-- <a href="/update" class="btn btn-primary">Edit Profile</a> --}}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title p-1">Profile Information</h3>
                        </div>
                        <div class="card-body">
                         
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->nis }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                            @if((auth()->user()->role == 'siswa' || auth()->user()->role == 'guru' || auth()->user()->role == 'petugas'))
                                <li class="list-group-item"><strong>Kelas:</strong>  {{ Auth::user()->siswa->kelas }} </li>
                                <li class="list-group-item"><strong>Jurusan:</strong> {{ Auth::user()->siswa->jurusan }} </li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong>{{ Auth::user()->siswa->jk }} </li>
                            @endif
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>