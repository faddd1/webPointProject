<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Point Pelanggaran Siswa </title>
    <link rel="icon" type="image/png" href="{{ asset('https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png') }}">   
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css') }}" rel="stylesheet">


    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="#" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <div class="mb-4">
                <img src="{{ asset('assets/img/lala.png') }}" alt="">
            </div>
            {{-- <h1 class="sitename">Bootslander</h1> --}}
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#contact">Kontak</a></li>
                @if (auth()->check())
                    <li>  
                        <a class="dropdown-item" href=" 
                            @if(auth()->user()->role == 'admin')
                                /dashboard/admin
                            @elseif(auth()->user()->role == 'guru')
                                /dashboard/guru
                            @elseif(auth()->user()->role == 'petugas')
                                /dashboard/petugas
                            @elseif(auth()->user()->role == 'siswa')
                                /dashboard/siswa
                            @endif" class="active">
                                Dashboard
                        </a>
                    </li>
                @endif
                @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'guru'  || auth()->user()->role == 'siswa'  || auth()->user()->role == 'petugas'))
                    <li class="nav-item dropdown">
                        <!-- Menampilkan nama pengguna dan dropdown untuk opsi tambahan -->
                        <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                </li>
                            
                            </ul>
                    </li>
                @endif 
                    @guest
                    <li class="nav-item">
                        <a class="btn text-white btn-login" style="padding: 8px 20px; background-color: #4F709C;" href="{{ route('login') }}">Login</a>
                    </li>
                  @endguest                
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">
        <img src="assets/img/bg1.png" alt="" class="hero-bg">

            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-lg-4 order-lg-last hiroImg" data-aos="zoom-out" data-aos-delay="100">
                            <img src="{{ asset('assets/img/apawe.png') }}" class="img-fluid animated mt-5" alt="">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center teksHiro" data-aos="fade-in">
                        <h1>Selamat Datang di Website <span class="text-danger fst-italic">P</span><span class="text-dark fst-italic">P</span><span class="fst-italic" style="color: #f6f23a;">S</span> !</h1>
                        <p class="mt-3">PPS adalah sistem poin pelanggaran siswa untuk SMKN 1 Kawali, yang dibangun untuk mengelola dan melacak tindakan disiplin secara efisien.</p>
                    </div>
                    
                </div>

                </div>
            </div>

        </section>

       
        <section id="about" class="about section mt-5">

        <div class="container py-2" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">
                <div class="hihi justify-content-center">
                    <img src="{{ asset('assets/img/lala.png') }}" alt="" width="200" height="200" >
                </div>
                <div class="content">
                    
                    <h2>Tentang</h2>
                    <h3>PPS </h3>
                </div>
                <div class="content1" style="padding: 20px;">
                    <p>Website <span>Poin Pelanggaran Siswa</span> adalah platform digital yang dirancang untuk memantau dan mencatat pelanggaran yang dilakukan oleh siswa di sekolah. Sistem ini membantu guru dan staf sekolah dalam mencatat perilaku negatif siswa serta memberikan sanksi sesuai dengan kebijakan yang berlaku di sekolah.</p>
                </div>
                
                <div>
                    <div class="row mt-2 gy-4 icon-boxes"  id="icontentang" >
                        <div class="col-md-15" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box">
                                <i class="bi bi-card-checklist"></i>
                            <h3 style="color: #104e67">Pencatatan Pelanggaran</h3>
                            <p>Guru dapat dengan mudah memasukkan pelanggaran yang dilakukan oleh siswa, seperti tidak mengerjakan  tugas atau melanggar aturan sekolah lainnya</p>
                            </div>
                        </div>

                        <div class="col-md-15" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="fa-solid fa-user-pen"></i>
                            <h3 style="color: #104e67">Perhitungan Point</h3>
                            <p>Setiap pelanggaran akan dikonversi menjadi poin tertentu. jika poin pelanggaran siswa melebihi batas yang telah di tentukan, tentukan maka tindakan disipliner akan diambil seperti teguran, peringatan, atau skorsing. </p>
                            </div>
                        </div> 

                        <div class="col-md-15" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="fa-solid fa-file-lines"></i>
                            <h3 style="color: #104e67">Rekapitulasi dan Laporan</h3>
                            <p>Website ini menyediakan laporan lengkap tentang riwayat pelanggaran siswa. Laporan ini dapat diakses oleh guru agar mereka bisa memantau perkembangan perilaku siswa.</p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        </section>

        <section id="contact" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <h2 style="color: #104e67">Kontak</h2>
                <div><span style="color: #104e67">Hubungi</span> <span class="description-title" style="color: #104e67">Kami</span></div>
            </div>

            <div class="container" data-aos="fade" data-aos-delay="100">
            
                <div class="row gy-4">

                <div class="col-lg-4 col-md-6">
                    <div class="info-item d- p-4 rounded shadow-sm" data-aos="fade-up" data-aos-delay="200" style="display: flex; align-items: center;">
                        <a href="https://www.google.com/maps?q=JL+Talagasari,+No.+35,+Kawalimukti,+Kawali,+Kabupaten+Ciamis,+Jawa+Barat+46253" target="_blank" style="color: #104e67; display: flex; align-items: center;">
                            <i class="bi bi-geo-alt flex-shrink-0" style="font-size: 24px; margin-right: 10px;"></i>
                            <div>
                                <h3 style="color: #104e67; margin: 0;">Alamat</h3>
                                <p style="margin: 0;">
                                    JL Talagasari, No. 35, Kawalimukti, Kawali, Kabupaten Ciamis, Jawa Barat 46253
                                </p>
                            </div>
                        </a>
                    </div>
                    

                    <div class="info-item d-flex p-4 rounded shadow-sm" data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;" onclick="window.location.href='tel:+62265791727';">
                        <a href="tel:+62265791727" style="color: #104e67; display: flex; align-items: center;" target="_blank">
                            <i class="bi bi-telephone flex-shrink-0" style="font-size: 24px; margin-right: 10px;"></i>
                                <div>
                                    <h3 style="color: #104e67; margin: 0;">Hubungi</h3>
                                    <p>(0265) 791727</p>
                                </div>                
                        </a>
                    </div>

                    <div class="info-item d-flex p-4 rounded shadow-sm" data-aos="fade-up" data-aos-delay="300" style="display: flex; align-items: center;">
                        <a href="mailto:smkn1kawali@gmail.com" style="color: #104e67; display: flex; align-items: center;" target="_blank">
                            <i class="bi bi-envelope flex-shrink-0" style="font-size: 24px; margin-right: 10px;"></i>
                                <div>
                                    <h3 style="color: #104e67; margin: 0;">Email</h3>
                                    <p>smkn1kawali@gmail.com</p>
                                </div>
                        </a>
                    </div>

                </div>

                <div class="col-lg-8 ">
                    @if(session('success'))
                    <div class="info-item alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form action="{{ route('send.email') }}" method="POST" class="p-4 rounded shadow-lg " data-aos="fade-up" data-aos-delay="200">
                        @csrf
                        <div class="row gy-4">
                            <!-- Floating input for Name -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama" required>
                                    <label for="name">Masukan Nama</label>
                                </div>
                            </div>
                
                            <!-- Floating input for Email -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Masukan Email" required>
                                    <label for="email">Masukan Email</label>
                                </div>
                            </div>
                
                            <!-- Floating input for Subject -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                
                            <!-- Textarea for Message -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="message" id="message" rows="6" placeholder="Message" required style="height: 150px;"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                
                            <div class="col-md-12 formlogin text-center">
                                <button type="submit" class="btn custom-btn  shadow-sm" style="background-color: #4F709C;">Kirim Pesan</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>

    <footer id="footer" class="footer light-background">


        <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">PPS</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <div>
                <h6 class="text-secondary mt-2">Media Sosial :</h6>
            </div>
            <div class="social-links d-flex align-items-center justify-content-center mt-2">
                <a href="https://x.com/smkn1kawali"><i class="bi bi-twitter-x"></i></a>
                <a href="https://web.facebook.com/smkn1kawali"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/smkn1kawali"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/SMKN1KawaliOfficial"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
        </div>

    </footer>

   
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>