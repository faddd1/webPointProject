<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Poin Pelanggaran Siswa</title>
    
    <link rel="icon" type="image/png" href="https://1.bp.blogspot.com/-fhQrt5qoZVQ/Vk7JRkLvD4I/AAAAAAAAF-k/ePg_jf3sDwI/s1600/Smk-Negeri-1-Kawali-Logo.png">
    
    <!-- Google Font: Source Sans Pro -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Stylesheets -->
    {{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        body {
            font-size: 14px;
            height: 100vh;
        }
    
        .content-wrapper, .main-footer, .navbar, .sidebar {
            padding: 10px;
        }

        @media (max-width: 767px) {
            /* Sembunyikan elemen tentang dan kontak di perangkat mobile */
            .tentang-section, .kontak-section {
                display: none;

            }

            /* Pastikan elemen sosial media tetap terlihat di mobile */
            .social-section {
            margin: 0 auto; /* Pastikan bagian sosial tetap di tengah */
            text-align: center; /* Menjaga agar sosial media berada di tengah */
        }
        }


    </style>
    
   
    
    
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <x-navbar></x-navbar>

        <x-sidebar></x-sidebar>
        
        <div class="content-wrapper">

            <x-header>{{ $title }}</x-header>
            
            {{ $slot }}
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <footer class="main-footer" style="background-color: #f9f9f; color: #333333; padding: 25px 0 0 5px; font-size: 13px; font-family: 'Poppins', sans-serif;">
    <div class="container">
        <div class="row">
            <!-- Bagian Tentang SMKN 1 Kawali -->
            <div class="col-md-3 mb-3 ml-5 tentang-section">
                <h6 style="font-weight: 600; color: #000;">Tentang SMKN 1 Kawali</h6>
                <p style="font-size: 12px; color: #777; margin-bottom: 10px;">SMKN 1 Kawali menciptakan lulusan yang siap bersaing di dunia industri.</p>
                <strong>&copy; 2024 - 2025 <a href="http://smkn1kawali.sch.id" style="color: #4D869C; text-decoration: none;">SMKN 1 Kawali</a>.</strong>
            </div>

            <!-- Bagian Sosial Media -->
            <div class="col-md-4 text-center mb-3 social-section">
                <h6 style="font-weight: 600; color: #000;">Ikuti Kami</h6>
                <div class="social-icons" style="font-size: 16px; margin-top: 8px;">
                    <a href="https://www.facebook.com/smkn1kawali" target="_blank" style="color: #4D869C; margin: 0 10px; transition: color 0.3s;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.twitter.com/smkn1kawali" target="_blank" style="color: #4D869C; margin: 0 10px; transition: color 0.3s;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/smkn1kawali" target="_blank" style="color: #4D869C; margin: 0 10px; transition: color 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/smkn1kawali" target="_blank" style="color: #4D869C; margin: 0 10px; transition: color 0.3s;">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.linkedin.com/smkn1kawali" target="_blank" style="color: #4D869C; margin: 0 10px; transition: color 0.3s;">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Bagian Kontak dan Alamat -->
            <div class="col-md-2 mb-3 ml-5 kontak-section">
                <h6 style="font-weight: 600; color: #000;">Kontak Kami</h6>
                <ul style="list-style: none; padding: 0; font-size: 12px; color: #777;">
                    <li style="margin-bottom: 5px;"><i class="fas fa-map-marker-alt"></i> Jl. Raya Kawali No.1, Kawali</li>
                    <li style="margin-bottom: 5px;"><i class="fas fa-phone"></i> (0265) 123456</li>
                    <li><i class="fas fa-envelope"></i> info@smkn1kawali.sch.id</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

    
    

    
    
    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
   
      <!-- Bootstrap JS and Popper.js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>