<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajibata-Tomok Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- Add Bootstrap Icons CSS -->
    <style>
        .fa-whatsapp,
        .fa-envelope {
            font-size: 1.5rem; /* Adjust the size as needed */
            color: black
        }

        .contact-info {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .contact-info i {
            font-size: 2rem; /* Adjust icon size */
            margin-right: 0.5rem;
        }

        .contact-info div {
            line-height: 1.2;
        }

        .contact-info h6 {
            margin: 0;
        }

        .social-icons a {
            color: black;
            margin: 0 10px;
            font-size: 2rem;
        }
        .social-icons a:hover {
            color: blue;
        }

        /* .contact-info a:hover {
            /* color: #0D7CFF
        } */

        footer {
            background-color: white;
            padding: 2rem 0;
        }

        .footer-logo {
            width: 100%;
            max-width: 200px;
            margin-bottom: 1rem;
        }

        .footer-title {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .contact-info,
            .social-icons {
                justify-content: center;
            }
        }
    </style>
  </head>
  <body>
    <div class="d-flex align-items-center justify-content-center" style="background-color: #0D7CFF; height: 50px;">
        <p class="text-center text-white my-auto">Cek info terbaru <span class="text-warning"><a style="text-decoration: none;" class="text-warning" href="jadwal/index_pesan">jadwal Keberangkatan kapal</a></span> Tomok Tour Ajibata.</p>
      </div>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img style="max-width: 150px; max-height: 70px;" src="{{ asset('style2/img/logoe-removebg-preview.png') }}" alt="Logo"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index_jadwal_penumpang')}}">Tiket Kapal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('kapal_booking_available')}}">Rental Kapal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('informasi_index')}}">Informasi Kapal</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>Cek Order Jadwal</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('pesanan_jadwal_paid')}}">Sudah Bayar</a></li>
                            <li><a class="dropdown-item" href="{{route('pesanan_jadwal_unpaid')}}">Belum Bayar</a></li>
                        </ul>
                      </li>
    
                    {{-- <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <b>Cek Order Kapal</b>
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Sudah Bayar</a></li>
                          <li><a class="dropdown-item" href="#">Belum Bayar</a></li>
                      </ul>
                  </li> --}}
                  {{-- <li class="nav-item"><a class="nav-link" href="{{route('index_rental_user')}}"><b>Cek Booking Kapal</b></a></li> --}}
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Cek Rental Kapal</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('index_rental_user')}}">Sudah Bayar</a></li>
                        <li><a class="dropdown-item" href="{{route('index_rental_user_unpaid')}}">Belum Bayar</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>{{Auth::user()->name}}</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a></li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>

                    </ul>
                  </li>
                    
              
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><b>LOGOUT</b></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li> --}}

                @elseif(!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"
                    ><b>LOGIN</b></a>
                    
                </li>  
                @endif

                </ul>
            </div>
        </div>
    </nav>


    @yield('content')

      {{-- Content :  --}}

      {{-- End Content --}}


      {{-- <div class="container">
        <footer class="py-3 my-4">
          <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
          </ul>
          <p class="text-center text-body-secondary">&copy; 2024 Company, Inc</p>
        </footer>
      </div> --}}
      <!-- Remove the container if you want to extend the Footer to full width. -->
      <div class="container">
        <footer class="text-dark text-center text-lg-start">
            <div class="container p-4">
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                        <img src="{{ asset('style/images/LogoOur.jpg')}}" class="footer-logo" alt="Logo">
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="footer-title">KONTAK KAMI</h5>
                        <div class="contact-info">
                            <a href="https://wa.me/082276588347" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <div>
                                <h6>WhatsApp</h6>
                            </div>
                        </div>
                        <div class="contact-info">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h6>Email</h6>
                                <h6>ajibatatomoktiket@gmail.com</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="footer-title">MEDIA SOSIAL</h5>
                        <div class="social-icons">
                            <a href="https://www.facebook.com" target="_blank" class="social-icon">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="https://www.twitter.com" target="_blank" class="social-icon">
                                <i class="bi bi-twitter-x"></i> <!-- Bootstrap Icons X -->
                            </a>
                            <a href="https://www.youtube.com" target="_blank" class="social-icon">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="https://www.instagram.com" target="_blank" class="social-icon">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.tiktok.com" target="_blank" class="social-icon">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<style>
    .social-icon{
        text-decoration: none;
    }
</style>