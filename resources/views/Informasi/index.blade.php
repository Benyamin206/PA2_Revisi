@extends('layouts.app')

@section('content')

<style>

   /* ... (style sebelumnya) ... */

/* Hero Section */
.hero-section {
  background-color: #e0f2f1; /* Warna latar belakang yang lebih menenangkan (teal muda) */
  color: #333; /* Warna teks yang lebih kontras */
  padding: 50px 30px;  /* Sedikit lebih banyak ruang */
  box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Efek bayangan halus */
}

.hero-section h2 {
  color: #006064; /* Warna heading yang lebih menarik (teal gelap) */
}

.hero-section p {
  font-size: 1.1rem; /* Ukuran teks yang sedikit lebih besar */
}

/* ... (style lainnya) ... */

/* Call to Action */
.call-to-action .container {
  background-color: #00838f; /* Warna latar belakang yang lebih gelap (teal tua) */
}

.call-to-action .cta-btn {
  background-color: #00695c; /* Warna tombol yang lebih gelap (teal yang sangat tua) */
  border: none; /* Hapus border agar terlihat lebih modern */
  box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Efek bayangan */
}

.call-to-action .cta-btn:hover {
  background-color: #004d40; /* Warna tombol saat hover yang lebih gelap */
}

/* ... (style lainnya) ... */


    .hero-section img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .hero-section p {
        font-size: 18px;
        line-height: 1.6;
    }

    .info-heading-container, .ships-heading-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
        margin: 20px 0;
    }

    .info-heading, .ships-heading {
        background-color: #FDC108;
        text-align: center;
        padding: 10px 20px;
        font-size: 24px;
        border-radius: 10px;
    }

    .info-section {
        background-color: #DCF2FF;
        padding: 40px 20px;
        border-radius: 10px;
    }

    .info-section .btn {
        float: right;
        background-color: #D8DCE8;
        border-color: #D8DCE8;
        color: black;
    }

    .ships-section img {
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .footer .social-icons a {
        margin: 0 10px;
        display: inline-block;
    }

    #why-us .icon-box {
        background-color: #51779f;
        color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    #why-us .icon-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    #why-us .icon-box i {
        font-size: 48px;
        color: white;
        margin-bottom: 20px;
    }

    #why-us .icon-box h4 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    #why-us .icon-box p {
        font-size: 16px;
        margin-bottom: 0;
    }

    #why-us .content {
        background-color: #add8e6;
        color: black;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    #why-us .content button {
        background-color: #634c06;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #why-us .content button:hover {
        background-color: #b8a56e;
    }

    #why-us .content p {
        font-size: 18px;
        margin-top: 10px;
    }

    .review-text {
        overflow-wrap: break-word;
    }
</style>

<!-- Information Section -->
<div class="hero-section container my-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('style2/img/ourLokasi.jpg')}}" alt="Kapal">
        </div>
        <div class="col-md-6">
            <h2>Pelabuhan Kapal Tomok Ajibata</h2>
            <br>
            <p>Pelabuhan Kapal Tomok Ajibata, terletak di wilayah Tomok, Kecamatan Simanindo, Kabupaten Samosir, Sumatera Utara, merupakan pusat kegiatan maritim yang diawasi oleh organisasi OPS di bawah kepemimpinan Bapak Hotman Sidabutar. Pelabuhan ini memiliki dua lokasi, yaitu di Tomok dan Ajibata.</p>
            <p>Dengan total 15 kapal aktif, yang mayoritas dimiliki oleh masyarakat lokal, terutama penduduk Tomok. Sebelum berlayar, setiap kapal dari Pelabuhan Tomok Ajibata harus melaporkan keberangkatannya kepada OPS untuk konfirmasi dari Perhubungan. Setiap kapal tidak hanya memiliki satu nahkoda tetapi juga memiliki sekitar empat karyawan yang bertanggung jawab atas tugas administratif seperti mengumpulkan tarif dan menjaga kebersihan kapal. Dengan demikian, pelabuhan ini bukan hanya merupakan titik penting untuk pergerakan kapal di sekitarnya tetapi juga merupakan sumber lapangan kerja bagi beberapa penduduk lokal.</p>
        </div>
    </div>
</div>

<style>
    .play-btn {
      display: inline-block;
      width: 100px;
      height: 100px;
      background: url('https://upload.wikimedia.org/wikipedia/commons/7/7e/YouTube_play_button_icon_%282013-2017%29.svg') no-repeat center center;
      background-size: contain;
      cursor: pointer;
    }
    .video-container {
      position: relative;
      width: 560px;
      margin: auto;
    }
    .cta-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: blue;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <section id="call-to-action" class="call-to-action">
    <div class="container text-center" data-aos="zoom-out">
      <div class="video-container" id="video-container">
        <div class="play-btn" id="play-btn"></div>
      </div>
      <h3>Kapal Tomok-Ajibata</h3>
      <p>Toba Lake</p>
      <a class="cta-btn" href="#" style="background-color: blue; color: white"
        >Lihat Informasi Kapal</a
      >
    </div>
  </section>

  <script>
    document.getElementById('play-btn').addEventListener('click', function() {
      var videoContainer = document.getElementById('video-container');
      var iframe = document.createElement('iframe');
      iframe.width = '560';
      iframe.height = '315';
      iframe.src = 'https://www.youtube.com/embed/VrIZBa4V67M?autoplay=1';
      iframe.title = 'Kapal Tomok-Ajibata';
      iframe.frameBorder = '0';
      iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
      iframe.allowFullscreen = true;

      videoContainer.innerHTML = '';
      videoContainer.appendChild(iframe);
    });
  </script>
  <br /><br /><br />



<br><br>
<section id="why-us" class="why-us">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="content">
                    <button onclick="typeWriter()">Kenapa Harus Tomok-Ajibata?</button>
                    <p id="typing"></p>
                </div>
            </div>
            <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-boxes d-flex flex-column justify-content-center">
                    <div class="row">
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box mt-4 mt-xl-0">
                                <i class="fas fa-ticket-alt"></i>
                                <h4>Pemesanan Tiket melalui Website</h4>
                                <p>Pemesanan dapat dilakukan hanya melalui halaman website.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box mt-4 mt-xl-0">
                                <i class="fas fa-heart"></i>
                                <h4>Melayani dengan Sepenuh Hati</h4>
                                <p>Kru dan petugas kapal akan melayani penumpang dengan sepenuh hati.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box mt-4 mt-xl-0">
                                <i class="fas fa-ship"></i>
                                <h4>Tentang Tomok-Ajibata</h4>
                                <p>Merupakan pusat penyeberangan kapal dengan rute Tomok-Ajibata dan Ajibata-Tomok. Bapak Jokowi pernah menggunakan kapal ini untuk melakukan penyeberangan ke Samosir.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- End .content-->
            </div>
        </div>
    </div>
</section>

<script>
    var i = 0;
    var txt = 'Karena Tomok Ajibata merupakan pelabuhan yang nyaman dan tepat waktu untuk jam keberangkatannya dan juga beroperasi setiap hari dengan jadwal yang sudah diatur sedemikian rupa.';
    var speed = 75;

    function typeWriter() {
        if (i < txt.length) {
            document.getElementById("typing").innerHTML += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
    }
</script>
<br><br>

<!-- Ships Heading -->
{{-- <div class="ships-heading-container">
    <div class="ships-heading">
        Kapal Yang Beroperasi
    </div>
</div> --}}

<!-- Operational Ships Section -->
<section id="portfolio" class="portfolio sections-bg">
    <div class="container" data-aos="fade-up">
      <br />
      <div class="section-header">
        <center><b><h1>KAPAL YANG BEROPERASI</h1></b></center>
      </div>
      <br /><br /><br />
      <div
        class="portfolio-isotope"
        data-portfolio-filter="*"
        data-portfolio-layout="masonry"
        data-portfolio-sort="original-order"
        data-aos="fade-up"
        data-aos-delay="100"
      >
        <div class="row gy-4 portfolio-container">
          <div class="col-xl-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              {{-- <a
                href="img/tio.jpeg" --}}
                <img src="{{asset('style2/img/kapal33.jpg')}}"class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details" --}}
                    Kapal Dosroha 1</a
                  >
                </h4>
                <p>Pemilik : Allason sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-product">
            <div class="portfolio-wrap">
              {{--<a
                href="img/dosroha5.jpeg" --}}
              <img src="{{asset('style2/img/kapal10.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details" --}}
                    Kapal Dosroha 2</a
                  >
                </h4>
                <p>Pemilik: Martoba sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
            <div class="portfolio-wrap">
              {{--<a
                href="img/dosroha1.jpeg"--}}
              <img src="{{asset('style2/img/kapal33.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details" --}}
                    Dosroha 3</a
                  >
                </h4>
                <p>Pemilik:Martoba Sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-books">
            <div class="portfolio-wrap">
             {{-- <a
                href="img/dosroha2.jpeg" --}}
<img src="{{asset('style2/img/kapal1.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details" --}}
                    Dosroha 5</a
                  >
                </h4>
                <p>Pemilik:Pendro sirait</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              {{--<a
                href="img/dosroha3.jpeg"--}}
               <img src="{{asset('style2/img/kapal7.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details" --}}
                  Rodame 1</a>
                </h4>
                <p>Pemilik: Bilson Sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-product">
            <div class="portfolio-wrap">
              {{--<a
                href="img/dosroha2.1.jpeg"--}}
              <img src="{{asset('style2/img/gambar.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details"> --}}
                    Rodame 2</a>
                </h4>
                <p>Pemilik: Bilson Sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-branding">
            <div class="portfolio-wrap">
              {{--<a
                href="img/pulohoras1.jpeg"--}}
             <img src="{{asset('style2/img/kapal26.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details"> --}}
                    Robinsar</a>
                </h4>
                <p>Pemilik: Hotman Sidabutar</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-books">
            <div class="portfolio-wrap">
              {{--<a
                href="img/gloria1.jpeg"--}}
           <img src="{{asset('style2/img/kapal9.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details"> --}}
                    Murni</a>
                </h4>
                <p>Pemilik: Ibu Murni</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <div class="col-xl-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              {{--<a
                href="img/dosroha3.jpeg"--}}
              <img src="{{asset('style2/img/kapal24.jpg')}}" class="img-fluid" alt=""
              /></a>
              <div class="portfolio-info">
                <h4>
                  {{-- <a href="aboutdetail.html" title="More Details"> --}}
                    Tio 1</a>
                </h4>
                <p>Pemilik: Randi Sitio</p>
              </div>
            </div>
          </div>
          <!-- End Portfolio Item -->

          <!-- End Portfolio Item -->


          <!-- End Portfolio Item -->

          <!-- End Portfolio Item -->


          <!-- End Portfolio Item -->

          <!-- End Portfolio Item -->

          <!-- End Portfolio Item -->
        </div>
        <!-- End Portfolio Container -->
      </div>
    </div>
  </section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<br><br><br><br>
@endsection

<style>
     {
  font-family: "Open Sans", sans-serif;
}

/*--------------------------------------------------------------
# Call To Action Section
--------------------------------------------------------------*/
.call-to-action .container {
  background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
  url("{{ asset('style2/img/kapal17.jpg') }}") center center;
  background-size: cover;
  padding: 100px 60px;
  border-radius: 15px;
  overflow: hidden;
}

.call-to-action h3 {
  color: #fff;
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 20px;
}

.call-to-action p {
  color: #fff;
  margin-bottom: 20px;
}

.call-to-action .play-btn {
  width: 94px;
  height: 94px;
  margin-bottom: 20px;
  background: radial-gradient(
    var(--color-primary) 50%,
    rgba(0, 131, 116, 0.4) 52%
  );
  border-radius: 50%;
  display: inline-block;
  position: relative;
  overflow: hidden;
}

.call-to-action .play-btn:before {
  content: "";
  position: absolute;
  width: 120px;
  height: 120px;
  animation-delay: 0s;
  animation: pulsate-btn 2s;
  animation-direction: forwards;
  animation-iteration-count: infinite;
  animation-timing-function: steps;
  opacity: 1;
  border-radius: 50%;
  border: 5px solid rgba(0, 131, 116, 0.7);
  top: -15%;
  left: -15%;
  background: rgba(198, 16, 0, 0);
}

.call-to-action .play-btn:after {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translateX(-40%) translateY(-50%);
  width: 0;
  height: 0;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 15px solid #fff;
  z-index: 100;
  transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

.call-to-action .play-btn:hover:before {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translateX(-40%) translateY(-50%);
  width: 0;
  height: 0;
  border: none;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 15px solid #fff;
  z-index: 200;
  animation: none;
  border-radius: 0;
}

.call-to-action .play-btn:hover:after {
  border-left: 15px solid var(--color-primary);
  transform: scale(20);
}

.call-to-action .cta-btn {
  font-family: var(--font-primary);
  font-weight: 500;
  font-size: 16px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 12px 48px;
  border-radius: 50px;
  transition: 0.5s;
  margin: 10px;
  border: 2px solid #fff;
  color: #fff;
}

.call-to-action .cta-btn:hover {
  background: var(--color-primary);
  border: 2px solid var(--color-primary);
}

@keyframes pulsate-btn {
  0% {
    transform: scale(0.6, 0.6);
    opacity: 1;
  }

  100% {
    transform: scale(1, 1);
    opacity: 0;
  }
}
/*--------------------------------------------------------------
# Portfolio Section
--------------------------------------------------------------*/
.portfolio .portfolio-flters {
  padding: 0 0 20px 0;
  margin: 0 auto;
  list-style: none;
  text-align: center;
}

.portfolio .portfolio-flters li {
  cursor: pointer;
  display: inline-block;
  padding: 0;
  font-size: 18px;
  font-weight: 500;
  margin: 0 10px;
  line-height: 1;
  transition: all 0.3s ease-in-out;
}

.portfolio .portfolio-flters li:hover,
.portfolio .portfolio-flters li.filter-active {
  color: var(--color-primary);
}

.portfolio .portfolio-flters li:first-child {
  margin-left: 0;
}

.portfolio .portfolio-flters li:last-child {
  margin-right: 0;
}

@media (max-width: 575px) {
  .portfolio .portfolio-flters li {
    font-size: 14px;
    margin: 0 5px;
  }
}

.portfolio .portfolio-wrap {
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  height: 100%;
  overflow: hidden;
}

.portfolio .portfolio-wrap img {
  transition: 0.3s;
  position: relative;
  z-index: 1;
}

.portfolio .portfolio-wrap .portfolio-info {
  padding: 25px 20px;
  background-color: #fff;
  position: relative;
  border-top: 1px solid #f3f3f3;
  z-index: 2;
}

.portfolio .portfolio-wrap .portfolio-info h4 {
  font-size: 18px;
  font-weight: 600;
  padding-right: 50px;
}

.portfolio .portfolio-wrap .portfolio-info h4 a {
  color: var(--color-default);
  transition: 0.3s;
}

.portfolio .portfolio-wrap .portfolio-info h4 a:hover {
  color: var(--color-primary);
}

.portfolio .portfolio-wrap .portfolio-info p {
  color: #6c757d;
  font-size: 14px;
  margin-bottom: 0;
  padding-right: 50px;
}

.portfolio .portfolio-wrap:hover img {
  transform: scale(1.1);
}

/*--------------------------------------------------------------
# Portfolio Details Section
--------------------------------------------------------------*/
.portfolio-details .portfolio-details-slider img {
  width: 100%;
}

.portfolio-details
  .portfolio-details-slider
  .swiper-pagination
  .swiper-pagination-bullet {
  width: 12px;
  height: 12px;
  background-color: rgba(255, 255, 255, 0.7);
  opacity: 1;
}

.portfolio-details
  .portfolio-details-slider
  .swiper-pagination
  .swiper-pagination-bullet-active {
  background-color: var(--color-primary);
}

.portfolio-details .swiper-button-prev,
.portfolio-details .swiper-button-next {
  width: 48px;
  height: 48px;
}

.portfolio-details .swiper-button-prev:after,
.portfolio-details .swiper-button-next:after {
  color: rgba(255, 255, 255, 0.8);
  background-color: rgba(0, 0, 0, 0.2);
  font-size: 24px;
  border-radius: 50%;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
}

.portfolio-details .swiper-button-prev:hover:after,
.portfolio-details .swiper-button-next:hover:after {
  background-color: rgba(0, 0, 0, 0.6);
}

@media (max-width: 575px) {
  .portfolio-details .swiper-button-prev,
  .portfolio-details .swiper-button-next {
    display: none;
  }
}

.portfolio-details .portfolio-info h3 {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
}

.portfolio-details .portfolio-info h3:after {
  content: "";
  position: absolute;
  display: block;
  width: 50px;
  height: 3px;
  background: var(--color-primary);
  left: 0;
  bottom: 0;
}

.portfolio-details .portfolio-info ul {
  list-style: none;
  padding: 0;
  font-size: 15px;
}

.portfolio-details .portfolio-info ul li {
  display: flex;
  flex-direction: column;
  padding-bottom: 15px;
  font-size: 16px;
}

.portfolio-details .portfolio-info ul strong {
  text-transform: uppercase;
  font-weight: 400;
  color: #9c9c9c;
  font-size: 12px;
}

.portfolio-details .portfolio-info .btn-visit {
  padding: 8px 40px;
  background: var(--color-primary);
  color: #fff;
  border-radius: 50px;
  transition: 0.3s;
}

.portfolio-details .portfolio-info .btn-visit:hover {
  background: #009d8b;
}

.portfolio-details .portfolio-description h2 {
  font-size: 26px;
  font-weight: 700;
  margin-bottom: 20px;
}

.portfolio-details .portfolio-description p {
  padding: 0;
}

.portfolio-details .portfolio-description .testimonial-item {
  padding: 30px 30px 0 30px;
  position: relative;
  background: white;
  height: 100%;
  margin-bottom: 50px;
}

.portfolio-details .portfolio-description .testimonial-item .testimonial-img {
  width: 90px;
  border-radius: 50px;
  border: 6px solid #fff;
  float: left;
  margin: 0 10px 0 0;
}

.portfolio-details .portfolio-description .testimonial-item h3 {
  font-size: 18px;
  font-weight: bold;
  margin: 15px 0 5px 0;
  padding-top: 20px;
}

.portfolio-details .portfolio-description .testimonial-item h4 {
  font-size: 14px;
  color: #6c757d;
  margin: 0;
}

.portfolio-details .portfolio-description .testimonial-item .quote-icon-left,
.portfolio-details .portfolio-description .testimonial-item .quote-icon-right {
  color: #009d8b;
  font-size: 26px;
  line-height: 0;
}

.portfolio-details .portfolio-description .testimonial-item .quote-icon-left {
  display: inline-block;
  left: -5px;
  position: relative;
}

.portfolio-details .portfolio-description .testimonial-item .quote-icon-right {
  display: inline-block;
  right: -5px;
  position: relative;
  top: 10px;
  transform: scale(-1, -1);
}

.portfolio-details .portfolio-description .testimonial-item p {
  font-style: italic;
  margin: 0 0 15px 0 0 0;
  padding: 0;
}
.portfolio-item {
  margin-bottom: 20px; /* Sesuaikan nilai ini dengan jarak yang diinginkan */
}

</style>