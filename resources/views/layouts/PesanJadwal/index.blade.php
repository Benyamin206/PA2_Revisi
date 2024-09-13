<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ajibata Tomok Tour</title>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <!-- google font -->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evSXbVzTVFTJwvtQveSZDouY4ejLMOs+kJgjzfnPGQOIlzU74wON1DfpHrC6DZu" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap"
            rel="stylesheet" />

        <!-- css -->
        <link href="{{ URL::asset('css/style.css'); }}" rel="stylesheet">

        <!-- font awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
            crossorigin="anonymous" />
    </head>



            <style>
                /* CSS untuk mengecilkan gambar */
                #navbar-bottom .navbar-brand img {
                    max-height: 65px;
                }

                #carouselExampleIndicators img {
                    max-height: 400px; /* Atur tinggi maksimum gambar */
                    width: 100%; /* Mengisi lebar carousel */
                    object-fit: cover; /* Memastikan gambar mengisi seluruh area carousel */
                }

                .ship-name {
                    font-weight: bold; /* Membuat teks menjadi tebal (bold) */
                    font-size: 18px; /* Menentukan ukuran teks */
                    color: #333; /* Menentukan warna teks */
                    margin-top: 10px; /* Menambahkan margin atas */
                }

                <style>
    .carousel-item::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Atur transparansi dan warna latar belakang */
    }

    .carousel-caption {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 15px; /* Atur jarak dari tepi kanan */
        left: auto; /* Pastikan tidak ada jarak dari tepi kiri */
        text-align: right; /* Mengatur teks ke kanan */
        padding: 15px; /* Atur ruang di sekitar teks */
        color: #000000; /* Warna teks */
    }

    .carousel-caption h1, .carousel-caption p {
        color: #ffffff; /* Warna teks hitam */
        font-weight: bold; /* Membuat teks menjadi tebal */
        font-family: 'Lilita One', cursive; /* Mengatur jenis font */
    }

    .carousel-caption h1 {
        margin-bottom: 10px; /* Atur jarak bawah untuk judul */
    }

    .carousel-caption p {
        margin-bottom: 20px; /* Atur jarak bawah untuk paragraf */
    }
</style>

            </style>

            <body>
                <!-- navbar covid -->
                <div class="d-flex justify-content-center align-items-center" id="covid-navbar">
                    <p class="m-0">
                        Cek info terbaru Kapal Tomok Tour
                        <a href="https://www.tiket.com/info/tiket-clean">tiket Kapal </a>dan
                        <a href="jadwal.html">  jadwal Keberangkatan kapal</a>
                        Tomok Tour Ajibata.
                    </p>
                </div>
                <!-- //navbar covid -->

                <!-- navbar top -->
                {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar-top">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="booktiket.html">Booking Tiket Anda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Promo</a>
                            </li>
                        </ul>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="image/bendera.jpg" alt= />
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item font-weight-bold" type="button">
                                    <img src="{{ asset('/image/bendera.jpg') }}" alt="" srcset="" class="mr-2" />Bahasa
                                    Indonesia
                                </button>
                                <button class="dropdown-item" type="button">
                                    <img src="{{ asset('/image/bendera amerika.png') }}" alt="" srcset="" class="mr-2" />English
                                </button>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent btn-sm dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                IDR
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item font-weight-bold" type="button">
                                    IDR - Rupiah Indonesia
                                </button>
                            </div>
                        </div>
                    </div>
                </nav> --}}
                <!-- //navbar top -->

                <!-- navbar bottom -->
                <nav class="navbar navbar-expand-lg navbar-light" id="navbar-bottom">
                    <a class="navbar-brand pl-2" href="#">
                        <img src="{{asset('image/logoe.png')}}" style="max-width: 200px;">
                    </a>

                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav mr-auto">
                            <a class="nav-item nav-link" href="/home">Home</a>
                            <a class="nav-item nav-link" href="{{route('index_jadwal_penumpang')}}">Tiket Jadwal</a>
                            <a class="nav-item nav-link" href="#">Booking Kapal</a>
                            <a class="nav-item nav-link" href="informasi">Informasi kapal</a>
                            <a class="nav-item nav-link" href="jadwal">Jadwal Keberangkatan</a>
                            <a class="nav-item nav-link" href="#">Kontak</a>

                        </div>

                        <div class="navbar-nav d-flex align-items-baseline">
                            <div class="dropdown">
                                <a class="nav-item nav-link font-weight-bold text-dark nav-link dropdown-toggle" role="button" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cek Order</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ route('pesanan_jadwal_paid') }}">Sudah Bayar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pesanan_jadwal_unpaid') }}">Belum Bayar</a></li>
                                </ul>
                            </div>
                            
                            @if(!Auth::check())
                                <a class="nav-item nav-link font-weight-bold text-dark mr-3" href="login">Login</a>
                                <a class="nav-item nav-link font-weight-bold text-dark mr-3" href="register">Daftar</a>
                            @endif

                            
                            
                            <a class="nav-item nav-link font-weight-bold text-dark mr-3" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        
                        
                    </div>
                </nav>
                <!-- //navbar bottom -->


                @yield('content')





                <!-- feature box -->
                <div class="feature-box mx-auto border-bottom" style="width: 1180px;">
                    <div class="row mb-4">
                        <div class="col d-flex align-items-center p-0">
                            <img src="{{ asset('/image/book.webp') }}"alt="" width="100" height="86">
                            <div class="text">
                                <h5 class="font-weight-bold mb-0">Simple Profile</h5>
                                <p class="text-muted">Pesan lebih cepat, isi data penumpang dengan sekali klik.
                                </p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-center p-0">
                            <img src=   "{{ asset('/image/simple-reschedule.webp') }}"alt="" width="82" height="63">
                            <div class="text">
                                <h5 class="font-weight-bold mb-0">Simple Reschedule</h5>
                                <p class="text-muted">Memudahkan kamu mengatur ulang penerbangan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col d-flex align-items-center p-0">
                            <img src="{{ asset('/image/easy-ticket.webp') }}"  alt="" width="100" height="86">
                            <div class="text">
                                <h5 class="font-weight-bold mb-0">Simple Booking Process</h5>
                                <p class="text-muted">Pemesanan tanpa ribet di mana pun dan kapan pun.
                                </p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-center p-0">
                            <a href="refund" class="text-decoration-none text-dark"> <!-- Tambahkan atribut href untuk menuju halaman refund -->
                                <img src="{{ asset('/image/simple-refund.webp') }}" alt="" width="82" height="63">

                                <div class="text ml-2">
                                    <h5 class="font-weight-bold mb-0">Simple Refund</h5>
                                    <p class="text-muted">Simple Refund
                                        Refund tiket tanpa ribet dari aplikasi maupun website.
                                    </p>
                                </div>
                            </a>
                        </div>

                <!-- //feature box -->

                <!-- feature container -->
                <div class="feature-container mx-auto mt-5 border-bottom">
                    <h3 class="font-weight-bold text-center mb-4">Nikmati Liburan Anda dengan Kapal Tomok Tour</h3>
                    <h6 class="font-weight-bold text-center">Kami akan memberikan pelayanan terbaik kami, dengan menjaga kebersihan dan kenyamanan tamu kami.</h6>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="text-center">
                            <img src="{{ asset('/image/tomok.jpeg') }}" alt="" width="280" height="170" class="rounded shadow">
                            <p class="ship-name">Kapal Star</p>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('/image/kapalbagus.jpeg') }}" alt="" width="280" height="170" class="rounded shadow">
                            <p class="ship-name">Kapal Rodame</p>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('/image/dame.jpeg') }}" alt="" width="280" height="170" class="rounded shadow">
                            <p class="ship-name">Kapal Exis</p>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('/image/kapal.jpeg') }}" alt="" width="280" height="170" class="rounded shadow">
                            <p class="ship-name">Kapal Tomok</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-5">
                        <button type="button" class="btn btn-outline-warning">Info Selengkapnya</button>
                    </div>
                </div>

                <!-- //feature container -->

                <!-- simple tiket -->
                <div class="simple-tiket pt-5">
                    <h2 class="text-center font-weight-bold">Kemudahan itu ada Di Tomok Tour Trip!</h2>
                    <div class="container mb-5">
                        <div class="card mx-auto mt-5" style="width: 1180px;">
                            <div class="card-body">
                                <div class="row mt-3 mb-5">
                                    <div class="col">
                                        <img src="{{ asset('/image/easy-ticket.webp') }}" alt="" width="100" height="82" class=" d-flex mx-auto">
                                        <h5 class=" text-center font-weight-bold mt-4 mb-2">Mudahnya Pesan Tiket </h5>
                                        <p class="text-center text-muted">Pesan tiket Secara Onlien maka kami akan proses Transaksi anda.</p>
                                    </div>
                                    <div class="col">
                                        <img src="{{ asset('/image/various-products.webp') }}" alt="" width="100" height="82" class="d-flex mx-auto">
                                        <h5 class="text-center font-weight-bold mt-4 mb-2">Banyak Pilihan Kapal sesuai Keinginan Anda</h5>
                                        <p class="text-center text-muted">Ada banyak pilihan maskapai dengan rute terlengkap
                                        .</p>
                                    </div>
                                    <div class="col">
                                        <img src="{{ asset('/image/payment-method.webp') }}"alt="" width="100" height="82" class="d-flex mx-auto">
                                        <h5 class="text-center font-weight-bold mt-4 mb-2"> Cara Pembayaran</h5>
                                        <p class="text-center text-muted">Saat ingin memesan tiket anda dapat langsung melanjutkan proses pembayaran dengan melakukan transfer. Prosesnya mudah dan simpel!</p>
                                    </div>
                                </div>
                                    <div class="col">
                                        <img src="{{ asset('/image/customer-service.webp') }}" alt="" width="100" height="82" class=" d-flex mx-auto">
                                        <h5 class=" text-center font-weight-bold mt-4 mb-2">Customer Care
                                        </h5>
                                        <p class="text-center text-muted">Kami akan melakukan pelayanan terbaik bagi Tamu kami, agar enjoy di dalam perjalanan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img-footer mx-auto">
                        <img src="{{ asset('/image/logoe.png') }}" alt="" width="380" height="300">
                    </div>
                    <h2 class="text-center font-weight-bold mt-5 pb-5">mau ke mana? Tomok Tour Jalan Nya!</h2>
                </div>
                <!-- //simple tiket -->
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.5349540745933!2d98.85539261030357!3d2.65517125597991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031e9f0f90df587%3A0x7295fc3b35dfa10f!2sJl.%20Pelabuhan%20Tomok%2C%20Simanindo%2C%20Kabupaten%20Samosir%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1712192503621!5m2!1sid!2sid"
                      width="1200" height="450" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>    <!-- footer -->
                <div class="footer">
                    <!-- footer top -->
                    <div class="footer-top d-flex justify-content-center mx-auto p-5 row">
                        <div class="footer-content">
                            <div class="footer-content-items d-flex align-items-center mt-3">
                                <img src="{{ asset('/image/message.webp') }}" alt="message" width="50" height="40" />
                                <div class="footer-text">
                                    <span class="span-gray d-block ml-3">Whatsapp</span>
                                    <span class="ml-3">082276588347</span>
                                </div>
                            </div>

                            <div class="footer-content-items d-flex align-items-center mt-3">
                                <img src="{{ asset('/image/email.webp') }}" alt="" width="50" height="40" />
                                <div class="footer-text">
                                    <span class="span-gray d-block ml-3">Email</span>
                                    <span class="ml-3">TomokTour@gmail.com</span>
                                </div>
                            </div>

                            <div class="footer-content-items d-flex align-items-center mt-3">
                                <img src="{{ asset('/image/call.png') }}" alt="" width="50" height="40" />
                                <div class="footer-text">
                                    <span class="span-gray d-block ml-3">Call Center</span>
                                    <span class="ml-3">
                                        0804 1500 878 (Samosir)
                                    </span>
                                    <br>
                                    <span class="ml-3">+6221 3973 0888</span>
                                </div>
                            </div>
                        </div>

                        <div class="footer-list col">
                            <h6 class="font-weight-bold mb-4 text-dark">Perusahaan</h6>
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Blog</a></li>
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Karir</a></li>
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Corporate</a></li>
                            </ul>
                        </div>

                        <div class="footer-list col">
                            <h6 class="font-weight-bold mb-4 text-dark">Produk</h6>
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Tiket Kapal</a></li>
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Samosir Island</a></li>
                            </ul>
                        </div>

                        <div class="footer-list col">
                            <h6 class="font-weight-bold mb-4 text-dark">Dukungan</h6>
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Kebijakan Privasi</a></li>
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Syarat & Ketentuan</a></li>
                                <li class="nav-item"><a class="nav-link pb-0" href="#">Ayo Booking Tiket Anda</a></li>
                            </ul>
                        </div>

                        <div class="footer-list col">
                            <h6 class="font-weight-bold mb-4 text-dark">Download TomokTourTrip</h6>
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link pb-0" href="#"><img src="{{ asset('/image/playstore.webp') }}" alt="" /></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pb-0" href="#"><img src="{{ asset('/image/appstore.webp') }}" alt="" srcset="" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--//footer top -->

                    <!-- footer midle -->
                    <div class="footer-middel d-flex justify-content-center align-items-start p-5 row mx-auto">
                        <div class="wonderfull-indonesia d-flex col p-0">
                            <img src="{{ asset('/image/wonderfulIndonesia.webp') }}" alt="wi" width="148">
                            <span class="ml-2">
                                Official Partner <br>
                                Kementerian Pariwisata <br>
                                Republik Indonesia <br>
                            </span>
                        </div>

                        <div class="footer-middle-items d-inline col p-0">
                            <h3 class="font-weight-bold mb-3">Keamanan Transaksi Anda</h3>
                            <img height="27" class="mr-3 mb-3" src="{{ asset('/image/verified-visa.webp') }}" alt="Visa">
                            <img height="27" class="mr-3 mb-3" src="{{ asset('/image/master-card.webp') }}" alt="MasterCard">
                            <img height="27" class="mr-3 mb-3" src="{{ asset('/image/geoTrust.webp') }}" alt="GeoTrust">
                            <br>
                            <img height="27" class="mr-3 mb-3" id="jcb-secure" src="{{ asset('/image/jcb-secure.webp') }}" alt="jcb secure">
                            {{-- <img height="27" class="mr-3 mb-3" src="{{ asset('/image/master-card.webp') }}" alt="GeoTrust"> --}}

                            <img height="27" class="mr-3 mb-3" src="{{ asset('/image/superbrand.webp') }}" alt="Superbrand" class="super-brand">
                        </div>

                        <div class="footer-middle-items d-inline col p-0">
                            <h3 class="font-weight-bold mb-3">Penghargaan</h3>
                            <img height="30" class="mr-3" src="{{ asset('/image/iata.webp') }}" alt="Iata" class="iata">
                            <img height="30" class="mr-3" src="{{ asset('/image/topBrand.webp') }}" alt="TopBrand" class="top-brand">
                            <img height="30" src="{{ asset('/image/superbrand.webp') }}" alt="Superbrand" class="super-brand">
                        </div>

                        <div class="footer-middle-items d-inline col p-0">
                            <h3 class="font-weight-bold mb-3">Follow Us</h3>
                            <a href="#"><i class="fab fa-facebook-square mr-2 mb-2"></i></a>
                            <a href="#"><i class="fab fa-twitter-square mr-2 mb-2"></i></a>
                            <a href="#"><i class="fab fa-linkedin mr-2 mb-2"></i></a>
                            <a href="#"><i class="fab fa-youtube mr-2 mb-2"></i></a>
                            <br>
                            <a href="#"><i class="fab fa-instagram mr-2 mb-2"></i></a>
                            <a href="#"><i class="fab fa-tiktok mr-2 mb-2"></i></a>
                        </div>

                    </div>
                    <!-- //footer midle -->

                    <!-- footer bottom -->
                    <div class="footer-buttom d-flex justify-content-center border-top pt-3">
                        <p class="text-center"><img src="img/logoe.png" alt="" width="145"> © 2020-2024 Tomok Tour Trip Ajibata
                            . All Rights Reserved</p>
                    </div>
                    <!-- //footer bottom -->

                </div>
                <!-- //footer -->

                <!-- help center -->

                <!-- //help center -->





                    <!-- //harga mobile -->

                    <!-- jumbotron carausel 2 -->

                    <!-- jumbotron carausel 2 -->


                </div>
                <!-- //mobile view -->
                <button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"></button>

                <script>
                  // Function to scroll to the top of the page smoothly
                  function scrollToTop() {
                    window.scrollTo({
                      top: 0,
                      behavior: 'smooth'
                    });
                  }

                  // Function to show/hide scroll-to-top button based on scroll position
                  window.onscroll = function() {
                    scrollFunction()
                  };

                  function scrollFunction() {
                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                      document.getElementById("scrollToTopBtn").style.display = "block";
                    } else {
                      document.getElementById("scrollToTopBtn").style.display = "none";
                    }
                  }
                </script>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                    crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
                    crossorigin="anonymous"></script>
                    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script> --}}

            </body>

            </html>