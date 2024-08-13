<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container-fluid">
        <div class="container mt-5">
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="dist/img/user2-160x160.jpg" class="card-img-top" alt="Profile Picture">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        </div>
                        <a href="/update" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile Information</h3>
                        </div>
                        <div class="card-body">
                         
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nis:</strong> {{ Auth::user()->username }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                                {{-- <li class="list-group-item"><strong>Kelas:</strong> XIII </li>
                                <li class="list-group-item"><strong>Jurusan:</strong> PPLG</li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong>Laki - laki</li> --}}
                     
                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>