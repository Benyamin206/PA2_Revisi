{{-- Carousel --}}

<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Lilita+One&display=swap');

     .carousel-caption {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: white; /* Warna teks caption */
  padding: 20px; /* Padding untuk caption */
  font-family: 'Lilita One', cursive;
  z-index: 2; /* Ensure the caption is above the overlay */
}

.img-container {
  position: relative;
}

.img-container::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
  z-index: 1; /* Ensure the overlay is above the image but below the caption */
}

.carousel-item img {
  height: 500px;
  width: 100%; /* Mengatur lebar gambar menjadi 100% */
  display: block;
  object-fit: cover; /* Ensure the image covers the container */
  filter: brightness(65%);
}

/* CSS untuk ukuran layar lebih kecil, seperti pada perangkat mobile */
@media (max-width: 768px) {
/* Mengatur tinggi gambar menjadi 300px */
.carousel-item img {
  height: 300px;
  width: 100%;
}
}
  </style>



<div class="carousel-inner">
  <div class="carousel-item active">
    <img src="{{asset('style2/img/kapalbagus.jpg')}}" class="d-block " alt="...">
    <div class="carousel-caption d-none d-md-block">
      <h2>Welcome To Tomok - Ajibata Trip</h2>
      <p>Nikmati Layanan Dari Penyebrangan Kapal Kami</p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="{{asset('style2/img/kapal15.jpg')}}" class="d-block " alt="...">
    <div class="carousel-caption d-none d-md-block">
      <h2>Welcome To Tomok - Ajibata Trip</h2>
      <p>Nikmati Layanan Dari Penyebrangan Kapal Kami</p>
    </div>
  </div>
  <div class="carousel-item">
    <img src="{{asset('style2/img/kapal1.jpg')}}" class="d-block " alt="...">
    <div class="carousel-caption d-none d-md-block">
      <h2>Welcome To Tomok - Ajibata Trip</h2>
      <p>Nikmati Layanan Dari Penyebrangan Kapal Kami</p>
    </div>
  </div>
</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

{{-- Offer --}}

<style>    .offer-container {
  margin-left: 10%;
  position: absolute;
  bottom: -0%; /* Atur posisi vertikal */
  left: 50%; /* Tempatkan ke tengah secara horizontal */
  transform: translateX(-50%);
  z-index: 1;
  width: 80%;
  max-width: 90%; /* Atur lebar maksimum */
  padding: 20px; /* Berikan padding untuk konten di dalamnya */
  background-color: rgba(255, 255, 255, 0.8); /* Atur warna latar belakang */
  border-radius: 10px; /* Atur sudut border */
  /* position: absolute; */
    left: 0; right: 0; transform: translateY(50%); z-index: 1;
}


@media (max-width: 768px) {
/* Mengatur tinggi gambar menjadi 300px */
.offer-container {
  bottom : -55%;
}
/* Mengatur lebar gambar menjadi 100% */
}

</style>


<style>
/* Radio style */
.custom-radio-group {
  display: flex;
  gap: 0; /* No gap between the radio button groups */
}

.custom-radio {
  display: flex;
  align-items: center;
}

.custom-radio input[type="radio"] {
  display: none;
}

.custom-radio label {
  display: flex;
  align-items: center;
  cursor: pointer;
  padding: 5px;
  /* border: 2px solid #ccc; */
  /* border-radius: 5px; */
  /* transition: background-color 0.3s, border-color 0.3s; */
  margin: 0; /* Remove any default margin */
}

.custom-radio label::before {
  content: '';
  display: inline-block;
  width: 20px;
  height: 20px;
  margin-right: 5px;
  border: 2px solid #ccc;
  border-radius: 50%;
  transition: background-color 0.3s, border-color 0.3s;
}

.custom-radio input[type="radio"]:checked + label::before {
  background-color: #007bff;
  border-color: #007bff;
}

.custom-radio input[type="radio"]:checked + label {
  border-color: #007bff;
  background-color: #e7f0ff;
}

.custom-radio label:hover {
  border-color: #007bff;
  background-color: #f1f8ff;
}


.Mcontainer {
  display: flex;
  align-items: flex-start; /* Menyusun elemen di awal pada sumbu silang (vertical) */
  gap: 20px; /* Menambahkan jarak antar elemen */
  width: 100%;
  margin-left: -5px; /* Jika diperlukan, bisa dihapus atau disesuaikan */
}

.input-group {
  display: flex;
  align-items: center;
  padding: 10px;
}

.custom-radio {
  margin-left: 0; /* Pastikan tidak ada margin negatif yang digunakan */
}

@media (max-width: 600px) {
  .container {
      flex-direction: column;
      gap: 10px;
  }
}

</style>



<div class="offer-container card bg-light shadow" style="">
<div class="card-body" id="card-container-body">
    <!-- header -->

    <div class="product-list-text">


        <table cellpadding = "3px">

          <tr>
             <h4><b>Hai </b></h4>
             <h2 class="font-weight-bold">Kamu Mau Ke mana?</h2>
            <td>
              <div class="input-group custom-radio">
                <input type="radio" id="oneWayRadio" name="tripType" aria-label="Radio button for one-way trip" checked> <label for="oneWayRadio">Sekali Jalan</label>
              </div>
            </td>
            <td>
              <div class="input-group custom-radio">
                <input type="radio" id="roundTripRadio" name="tripType" aria-label="Radio button for round trip"> <label for="roundTripRadio">Pulang-Pergi</label>
              </div>
            </td>
          </tr>
        </table>


        {{-- <div class="d-flex align-items-start custom-radio-group"> --}}
          <div class="container d-flex">

        </div>

    </div>


    <!-- One Way Trip Form -->
    <div id="oneWayForm">
        <div class="row">
            <div class="col border border-secondary pt-3 pb-3 pr-0">
                <p class="text-muted mb-2" style="font-size: 14px;">Mau kemana?</p>
                <form action="{{route('filter_jadwal_cari_pergi')}}" method="POST">
                    @csrf
                    <h6 class="text-muted font-weight-bold">
                        <i class="fas fa-ship" style="color: rgb(0, 100, 210)"></i>
                        Pilih Rute
                    </h6>
                    <select name="rute" id="" class="form-control" required>
                        @foreach ($rutes as $r)
                        <option value="{{$r->id}}">{{$r->lokasi_berangkat}} ke {{$r->lokasi_tujuan}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col border border-secondary pt-3 pb-3">
                <p class="text-muted mb-2" style="font-size: 14px;">Berangkat</p>
                <h6 id="departureDate" style="color: rgb(53, 64, 90)" class="font-weight-bold">
                    <i class="fa fa-calendar" aria-hidden="true" style="color: rgb(0, 100, 210)"></i>
                    Pilih tanggal keberangkatan anda
                </h6>
                <input type="date" name="date" id="date" class="form-control" required>
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        var dateInput = document.getElementById('date');
                        var today = new Date();
                        var todayISO = today.toISOString().split('T')[0];
                        dateInput.min = todayISO;
                    });
                </script>
            </div>
        </div>

        <!-- footer card -->
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-warning rounded-pill text-muted text-nowrap mt-3">CARI TIKET</button>
        </div>
        </form>
    </div>

    <!-- Round Trip Form -->
    <div id="roundTripForm" class="trip-form" style="display: none;">
      <div class="row">
          <div class="col border border-secondary pt-3 pb-3 pr-0">
              <p class="text-muted mb-2" style="font-size: 14px;">Mau kemana?</p>
              <form action="{{route('filter_jadwal_pulang_pergi')}}" method="POST">
                  @csrf
                  <h6 class="text-muted font-weight-bold">
                      <i class="fas fa-ship" style="color: rgb(0, 100, 210)"></i>
                      Pilih Rute
                  </h6>
                  <select name="rute" class="form-control" required>
                      @foreach ($rutes as $r)
                      <option value="{{$r->id}}">{{$r->lokasi_berangkat}} ke {{$r->lokasi_tujuan}}</option>
                      @endforeach
                  </select>
          </div>
          <div class="col border border-secondary pt-3 pb-3">
              <p class="text-muted mb-2" style="font-size: 14px;">Berangkat</p>
              <h6 id="departureDate" style="color: rgb(53, 64, 90)" class="font-weight-bold">
                  <i class="fa fa-calendar" aria-hidden="true" style="color: rgb(0, 100, 210)"></i>
                  Pilih tanggal keberangkatan anda
              </h6>
              <input type="date" name="tanggal_pergi" id="departureDateInput" class="form-control" required>
          </div>
          <div class="col border border-secondary pt-3 pb-3">
              <p class="text-muted mb-2" style="font-size: 14px;">Pulang</p>
              <h6 id="returnDate" style="color: rgb(53, 64, 90)" class="font-weight-bold">
                  <i class="fa fa-calendar" aria-hidden="true" style="color: rgb(0, 100, 210)"></i>
                  Pilih tanggal kepulangan anda
              </h6>
              <input type="date" name="tanggal_pulang" id="returnDateInput" class="form-control" required>
          </div>
      </div>
      <div class="d-flex align-items-center">
          <button type="submit" class="btn btn-warning rounded-pill text-muted text-nowrap mt-3">CARI TIKET</button>
      </div>
      </form>
  </div>

</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var departureDateInput = document.getElementById('departureDateInput');
  var returnDateInput = document.getElementById('returnDateInput');

  // Set minimum date for departure date input
  var today = new Date();
  var todayISO = today.toISOString().split('T')[0];
  departureDateInput.min = todayISO;

  // Update minimum date for return date input when departure date changes
  departureDateInput.addEventListener('change', function() {
      returnDateInput.value = ''; // Clear return date value when departure date changes
      returnDateInput.min = departureDateInput.value; // Set minimum return date to the selected departure date
  });

  // Ensure return date cannot be earlier than departure date
  returnDateInput.addEventListener('change', function() {
      if (returnDateInput.value < departureDateInput.value) {
          returnDateInput.value = '';
          alert('Tanggal kepulangan tidak bisa lebih awal dari tanggal keberangkatan.');
      }
  });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var oneWayRadio = document.getElementById('oneWayRadio');
    var roundTripRadio = document.getElementById('roundTripRadio');
    var oneWayForm = document.getElementById('oneWayForm');
    var roundTripForm = document.getElementById('roundTripForm');

    oneWayRadio.addEventListener('change', function() {
        if (oneWayRadio.checked) {
            oneWayForm.style.display = 'block';
            roundTripForm.style.display = 'none';
        }
    });

    roundTripRadio.addEventListener('change', function() {
        if (roundTripRadio.checked) {
            oneWayForm.style.display = 'none';
            roundTripForm.style.display = 'block';
        }
    });
});
</script>


{{-- End Offer --}}

</div>
{{-- End Carousel --}}

<style>
  .pro {
    margin-top: 250px;
  }

  @media (max-width: 768px) {
    .pro {
      margin-top: 400px;
    }
  }

  .left-align {
    margin-right: auto;
  }

  .right-align {
    margin-left: auto;
  }

  .card-img-custom {
    max-width: 100px;
    height: auto;
    display: block;
    margin: 0 auto;
  }
</style>
</head>
<body>
<div class="container">
  <div class="row pro">
    <div class="col-md-6 mb-3">
      <div class="card right-align" style="max-width: 500px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{asset('style2/img/book.webp')}}" class="img-fluid rounded-start card-img-custom" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Simple Order</h5>
              <p class="card-text">Pesan lebih cepat, isi data penumpang dengan sekali klik.</p>
              <p class="card-text"><small class="text-body-secondary">-----</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card left-align" style="max-width: 500px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{asset('style2/img/simple-refund.webp')}}" class="img-fluid rounded-start card-img-custom" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Simple View</h5>
              <p class="card-text">Mudah berinteraksi dengan aplikasi.</p>
              <p class="card-text"><small class="text-body-secondary">-----</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card right-align" style="max-width: 500px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{asset('style2/img/easy-ticket.webp')}}" class="img-fluid rounded-start card-img-custom" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Simple Ship Booking</h5>
              <p class="card-text">Mudah berinteraksi dengan aplikasi.</p>
              <p class="card-text"><small class="text-body-secondary">-----</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card left-align" style="max-width: 500px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{asset('style2/img/simple-reschedule.webp')}}" class="img-fluid rounded-start card-img-custom" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Simple Refund</h5>
              <p class="card-text">Simple Refund tiket tanpa ribet.</p>
              <p class="card-text"><small class="text-body-secondary">-----</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<br><br>
<center>
<h3>Nikmati Liburan Anda dan Keluarga Anda dengan Kapal Booking</h3>
<p>Kami akan memberikan pelayanan terbaik kami dengan menjaga kebersihan dan kenyamanan tamu kami</p>
</center>
<br>
<!-- Page Content -->
<div class="container">


<hr class="mt-2 mb-5">

<div class="row text-center text-lg-start">
  <style>
    .gi{
      text-decoration: none;
    }
  </style>
  <div class="col-lg-3 col-md-4 col-6">
    <a href="#" class="d-block mb-4 h-100 gi" style="">
      <img class="img-fluid img-thumbnail" style="height: 100%" src="{{asset('style2/img/kapal3.jpg')}}" alt="">
      <center><b><h5 style="color:black">Kapal Gloria</h5></b></center>
    </a>

  </div>
  <div class="col-lg-3 col-md-4 col-6">
    <a href="#" class="d-block mb-4 h-100 gi">
      <img class="img-fluid img-thumbnail" style="height: 100%" src="{{asset('style2/img/kapal7.jpg')}}" alt="">
      <center><b><h5 style="color:black">Kapal Tomok</h5></b></center>
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-6">
    <a href="#" class="d-block mb-4 h-100 gi">
      <img class="img-fluid img-thumbnail" style="height: 100%" src="{{asset('style2/img/kapal33.jpg')}}"alt="">
      <center><b><h5 style="color:black">Kapal Dosroha-01</h5></b></center>
    </a>
  </div>
  <div class="col-lg-3 col-md-4 col-6">
    <a href="#" class="d-block mb-4 h-100 gi">
      <img class="img-fluid img-thumbnail" style="height: 100%" src="{{asset('style2/img/kapal19.jpg')}}" alt="">
      <center><b><h5 style="color:black">Kapal Tio-Tour 14</h5></b></center>
    </a>
  </div>

</div>

</div>

<br><br><br><br>



<div class="container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.5349540745933!2d98.85539261030357!3d2.65517125597991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031e9f0f90df587%3A0x7295fc3b35dfa10f!2sJl.%20Pelabuhan%20Tomok%2C%20Simanindo%2C%20Kabupaten%20Samosir%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1712192503621!5m2!1sid!2sid"
width="100%" height="300" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
</iframe>
</div>

<br><br>