<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Point Pelanggaran Siswa |</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Bootslander
    * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
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
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#team">Tim</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li> @if($role == 'admin')
                        <a href="/dashboard/admin" class="active">Dashboard</a>
                    @elseif($role == 'guru')
                        <a href="/dashboard/guru" class="active">Dashboard</a>
                    @elseif($role == 'petugas')
                        <a href="/dashboard/petugas" class="active">Dashboard</a>
                    @elseif($role == 'siswa')
                        <a href="/dashboard/siswa" class="active">Dashboard</a>
                    @endif
                </li>


                      @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                  @else
                      @if(auth()->check())
                          @php
                              $user = auth()->user();
                          @endphp
                          <li class="nav-item dropdown">
                              <!-- Menampilkan nama pengguna dan dropdown untuk opsi tambahan -->
                              <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  {{ $user->name }}
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
            <div class="col-lg-4  order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('assets/img/apawe.png') }}" class="img-fluid animated" alt="">
            </div>

            <div class="col-lg-6 py-5  d-flex flex-column justify-content-center" data-aos="fade-in">
                <h1>Selamat Datang di Website <span class="text-danger fst-italic">P</span><span class="text-dark fst-italic">P</span><span class="fst-italic" style="color: #f6f23a;">S</span> !</h1>
                <p>PSS adalah Website Poin Pelanggara Siswa untuk digunakan oleh SMKN 1 KAWALI</p>
                </div>
                
            </div>

            </div>
            </div>

        {{-- <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
            </defs>
            <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3"></use>
            </g>
            <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0"></use>
            </g>
            <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9"></use>
            </g>
        </svg> --}}

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">
            <div class="hihi justify-content-center">
                <img src="{{ asset('assets/img/lala.png') }}" alt="" width="200" height="200" >
            </div>
            <div class="content">
                
                <h2>Tentang</h2>
                <h3>PPS </h3>
                <h2></h2>
            </div>
            <div class="content1">
                <p>Website poin pelanggaran siswa adalah platform digital yang dirancang untuk memantau dan mencatat pelanggaran yang dilakukan oleh siswa di sekolah. Sistem ini membantu guru dan staf sekolah dalam mencatat perilaku negatif siswa serta memberikan sanksi sesuai dengan kebijakan yang berlaku di sekolah.</p>
                {{-- <a href="#icontentang" class="read-more"><span>Lanjut</span><i class="bi bi-arrow-right"></i></a> --}}
            </div>

            <div>
                <div class="row gy-4 icon-boxes"  id="icontentang" >
                    {{-- class="col-lg-3 col-md-6 d-flex flex-column align-items-center --}}
                <div class="col-md-15" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box">
                        <i class="bi bi-card-checklist"></i>
                    <h3>Pencatatan Pelanggaran</h3>
                    <p>Guru dapat dengan mudah memasukkan pelanggaran yang dilakukan oleh siswa, seperti tidak mengerjakan  tugas atau melanggar aturan sekolah lainnya</p>
                    </div>
                </div> <!-- End Icon Box -->

                <div class="col-md-15" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box">
                        <i class="fa-solid fa-user-pen"></i>
                    <h3>Perhitungan Point</h3>
                    <p>Setiap pelanggaran akan dikonversi menjadi poin tertentu. jika poin pelanggaran siswa melebihi batas yang telah di tentukan, tentukan maka tindakan disipliner akan diambil seperti teguran, peringatan, atau skorsing. </p>
                    </div>
                </div> <!-- End Icon Box -->

                <div class="col-md-15" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon-box">
                        <i class="fa-solid fa-file-lines"></i>
                    <h3>Rekapitulasi dan Laporan</h3>
                    <p>Website ini menyediakan laporan lengkap tentang riwayat pelanggaran siswa. Laporan ini dapat diakses oleh guru agar mereka bisa memantau perkembangan perilaku siswa.</p>
                    </div>
                </div> <!-- End Icon Box -->

                </div>
            </div>

            </div>
        </div>

        </section><!-- /About Section -->

        


        

        

        

        <!-- Gallery Section -->
        <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Galleri</h2>
            <div class="fs-4"><span>Kenangan pembuat</span> <span class="description-title">Website</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-0">

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-1.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-2.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-3.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-4.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-5.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-6.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="assets/img/gallery/gallery-7.jpg" class="glightbox" data-gallery="images-gallery">
                    <img src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            <div class="col-lg-3 col-md-4">
                <div class="gallery-item">
                <a href="{{ asset('assets/img/gallery/gallery-8.jpg') }}" class="glightbox" data-gallery="images-gallery">
                    <img src="{{ asset('assets/img/gallery/gallery-8.jpg') }}" alt="" class="img-fluid">
                </a>
                </div>
            </div><!-- End Gallery Item -->

            </div>

        </div>

        </section><!-- /Gallery Section -->


        <!-- Team Section -->
        <section id="team" class="team section">

        <!-- Section Title -->
            <div class="hihi justify-content-center">
                <img src="{{ asset('assets/img/lala.png') }}" alt="" width="200" height="200" >
            </div>
        <div class="container1 section-title py-4" data-aos="fade-up">
            <div class="fs-4 py-4"><span>Tim Pembuatan</span>
            <h3>PPS</h3>
            </div>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5 py-4">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Ade Ridwan</h4>
                    <span>Pembimbing Insitut</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-2.jpg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Fadli Alam Akbar</h4>
                    <span>Ketua Tim</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Ade Farhan Gunawan</h4>
                    <span>Projek Manager</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Irma Nuryani</h4>
                    <span>Anggota Tim</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-3.jpg"') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Malva Riski Nur Aulia</h4>
                    <span>Anggota Tim</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                <div class="pic"><img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt=""></div>
                <div class="member-info">
                    <h4>Rahma Fauziah</h4>
                    <span>Anggota Tim</span>
                    <div class="social">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                </div>
            </div><!-- End Team Member -->

            </div>

        </div>

        </section><!-- /Team Section -->


    

        <!-- Contact Section -->
        <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <div><span>Hubungi</span> <span class="description-title">Kami</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade" data-aos-delay="100">
        
            <div class="row gy-4">

            <div class="col-lg-4 col-md-6">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                    <h3>Address</h3>
                    <p>A108 Adam Street, New York, NY 535022</p>
                </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>+1 5589 55488 55</p>
                </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                    <h3>Email Us</h3>
                    <p>info@example.com</p>
                </div>
                </div><!-- End Info Item -->

            </div>

            <div class="col-lg-8">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                <div class="row gy-4">

                    <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required="">
                    </div>

                    <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Masukan Email" required="">
                    </div>

                    <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                    </div>

                    <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>

                    <button type="submit">Send Message</button>
                    </div>

                </div>
                </form>
            </div><!-- End Contact Form -->

            </div>

        </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer light-background">

        {{-- <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
                <span class="sitename">Hubungi Kami</span>
            </a>
            <div class="footer-contact pt-3">
                <p><strong>Alamat:</strong> Jl, Talagasari No.35 Kawalimukti, Kawali Kabupaten Ciamis Jawa Barat 46252</p>
                <p class="mt-3"><strong> Phone:</strong> <span>(0265) 791 727-Central Office
                </span></p>
                <p><strong>Email:</strong> <span>smkn1kawali@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
                <a href="https://x.com/smkn1kawali"><i class="bi bi-twitter-x"></i></a>
                <a href="https://web.facebook.com/smkn1kawali"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/smkn1kawali"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/SMKN1KawaliOfficial"><i class="bi bi-youtube"></i></a>
            </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Terms of service</a></li>
                <li><a href="#">Privacy policy</a></li>
            </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
                <li><a href="#">Web Design</a></li>
                <li><a href="#">Web Development</a></li>
                <li><a href="#">Product Management</a></li>
                <li><a href="#">Marketing</a></li>
                <li><a href="#">Graphic Design</a></li>
            </ul>
            </div>

            <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Tentang SMKN 1 KAWALI</h4>
            <p>SMKN 1 KAWALI merupakan sebuah SMK Negeri di kawasan Ciamis Utara yang mulai berdiri tahun 2005</p>
            
            </div>

        </div>
        </div> --}}

        <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">PPS</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            {{-- Designed by <a href="https://bootstrapmade.com/">Tim13</a> --}}
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

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>