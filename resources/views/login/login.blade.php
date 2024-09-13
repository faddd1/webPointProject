<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/png" href="{{ asset('https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png') }}">   
    <link rel="preconnect" href="{{ asset('https://fonts.googleapis.com') }}">
    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com') }}" crossorigin>
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css') }}">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">  
    </head>
    <body>
        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
    
            <a href="#" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <div class="mb-4">
                    <img src="assets/img/lala.png" alt="">
                </div>
                <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                {{-- <h1 class="sitename">Bootslander</h1> --}}
            </a>
        </div>
    </header>
        {{-- <nav class="navbar">
            <div class="navbar-logo">
                <img src="aseets/img/lala.png"  alt=""> 
            </div>       
        </nav> --}}
        <div class="login-container mb-4">
            <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-center">
    
                <a href="#" class="logo d-flex align-items-center">
                    <div class="mt-3 mb-3">
                        <img src="assets/img/lala.png" alt="">
                    </div>
                </a>
            </div>
            @if(session('error'))
            <script>
                const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: " {{ session('error')}}"
                        });
            </script>
            @endif
                <form class="was-validated" action="" method="POST">
                    @csrf
                        <div>
                            
                            <label for="nis" class="form-label">NIP/NIS :</label>
                            <input type="text" class="form-control" value="{{ old('nis') }}" name="nis"  placeholder="Nip atau Nis" required>
                            <div class="invalid-feedback">
                                Masukan Nip atau Nis.
                            </div>
                        </div>
                    <div>
                        <label for="password" class="form-label">Password :</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Masukan Password. 
                        </div>
                        <div class="d-grid gap-2" style="margin-top: 1rem;">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </div>
                </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    </body>
</html>



{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-form">
            <h2 class="text-center">Login</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" value="{{ old('username') }}" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('.login-form');
    loginForm.classList.add('animate__animated', 'animate__fadeIn');
    });

    </script>
</body>
</html> --}}
