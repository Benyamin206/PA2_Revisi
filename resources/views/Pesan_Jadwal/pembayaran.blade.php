<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Load Snap.js script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-X7iiMI_TmxPz6MiW"></script>
    <!-- Note: Change the URL to https://app.midtrans.com/snap/snap.js for Production environment -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
    <style>
        body{
          /* margin-top:20px; */
    background:#0D7CFF;
    }
    
    .card-footer-btn {
        display: flex;
        align-items: center;
        border-top-left-radius: 0!important;
        border-top-right-radius: 0!important;
    }
    .text-uppercase-bold-sm {
        text-transform: uppercase!important;
        font-weight: 500!important;
        letter-spacing: 2px!important;
        font-size: .85rem!important;
    }
    .hover-lift-light {
        transition: box-shadow .25s ease,transform .25s ease,color .25s ease,background-color .15s ease-in;
    }
    .justify-content-center {
        justify-content: center!important;
    }
    .btn-group-lg>.btn, .btn-lg {
        padding: 0.8rem 1.85rem;
        font-size: 1.1rem;
        border-radius: 0.3rem;
    }
    .btn-dark {
        color: #fff;
        background-color: #1e2e50;
        border-color: #1e2e50;
    }
    
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(30,46,80,.09);
        border-radius: 0.25rem;
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
    
    .p-5 {
        padding: 3rem!important;
    }
    .card-body {
        flex: 1 1 auto;
        padding: 1.5rem 1.5rem;
    }
    
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
    
    .table td, .table th {
        border-bottom: 0;
        border-top: 1px solid #edf2f9;
    }
    .table>:not(caption)>*>* {
        padding: 1rem 1rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }
    .px-0 {
        padding-right: 0!important;
        padding-left: 0!important;
    }
    .table thead th, tbody td, tbody th {
        vertical-align: middle;
    }
    tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
    }
    
    .mt-5 {
        margin-top: 3rem!important;
    }
    
    .icon-circle[class*=text-] [fill]:not([fill=none]), .icon-circle[class*=text-] svg:not([fill=none]), .svg-icon[class*=text-] [fill]:not([fill=none]), .svg-icon[class*=text-] svg:not([fill=none]) {
        fill: currentColor!important;
    }
    .svg-icon>svg {
        width: 1.45rem;
        height: 1.45rem;
    }
    
    </style>
</head>
<body>
    <div class="d-flex align-items-center justify-content-center" style="background-color: #0D7CFF; height: 50px;">
        <p class="text-center text-white my-auto">Cek info terbaru Kapal Tomok Tour <span class="text-warning">tiket Kapal</span> dan <span class="text-warning">jadwal Keberangkatan kapal</span> Tomok Tour Ajibata.</p>
      </div>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#"><img style="max-width: 150px; max-height: 70px;" src="{{asset('style2/img/logoe.png')}}" alt="Logo"></a>

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
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('kapal_booking_available')}}">Rental Kapal</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('informasi_index')}}">Informasi Kapal</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li> --}}
                </ul>
    
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b>Cek Order Jadwal</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('pesanan_jadwal_paid')}}">Sudah Bayar</a></li>
                        <li><a class="dropdown-item" href="{{route('pesanan_jadwal_unpaid')}}">Belum Bayar</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <b>Cek Order Kapal</b>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Sudah Bayar</a></li>
                      <li><a class="dropdown-item" href="#">Belum Bayar</a></li>
                  </ul>
              </li>
              @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><b>LOGOUT</b></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif

                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>  <div class="container mt-6 mb-7">
        <div class="row justify-content-center">
          <div class="col-lg-12 col-xl-7">
            <div class="card">
              <div class="card-body p-5">
                <h2>
                  Hai {{$order->user->name}},
                </h2>
                <p class="fs-sm">
                  {{-- This is the receipt for a payment of <strong>$312.00</strong> (USD) you made to Spacial Themes. --}}
                  Ini adalah detail dari  <strong>pemesanan jadwal</strong> yang telah anda lakukan
                </p>
    
                <div class="border-top border-gray-200 pt-4 mt-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="text-muted mb-2">ID PEMESANAN : </div>
                      <strong>{{$order->id}}</strong>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <div class="text-muted mb-2">Dipesan pada :</div>
                      <strong>{{$order->ditambahkan_pada}}</strong>
                    </div>
                  </div>
                </div>
    
                <div class="border-top border-gray-200 mt-4 py-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="text-muted mb-2">PEMESAN</div>
                      <strong>
                        {{$order->user->name}} </strong>
                      <p class="fs-sm"> 
                        {{$order->user->alamat}}                   <br>
                        <a href="#!" class="text-purple">{{$order->user->email}}
                        </a>
                      </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                      <div class="text-muted mb-2">JADWAL YANG DIPESAN</div>
                      <strong>
                        Rute : {{$order->jadwal->rute->lokasi_berangkat}} - {{$order->jadwal->rute->lokasi_tujuan}}
                        @if($order->jadwal_pulang_id != NULL)
                        <b>(Pulang - Pergi)</b>
                      @endif
                      </strong>
                      <p class="fs-sm"> 
            Keberangkatan : {{$order->jadwal->waktu_berangkat}}            <br>
            @if($order->jadwal_pulang_id != NULL)
            Kepulangan : {{$order->jadwalPulang->waktu_berangkat}}            <br>
            @endif
                        </p>
                      </p>
                    </div>
                  </div>
                </div>
    
                <table class="table border-bottom border-gray-200 mt-3">
                  <thead>
                    <tr>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Deskripsi</th>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Harga Per Item</th>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Jumlah</th>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach($order->detail_pesan_jadwal as $dpj)
                    <tr>{{$dpj->muatan->nama}} => {{$dpj->jumlah}}
                        <td class="text-end px-0"><h6 style="color: blue">{{'Rp ' . number_format(234000, 2, ',', '.');}}</h6></td>
                    </tr>
                    @endforeach --}} 
                    @foreach($order->detail_pesan_jadwal as $dpj)
                    <tr>
                      <td class="px-0">{{$dpj->muatan->nama}}</td>
                      <td class="px-0 ">{{'Rp ' . number_format($dpj->muatan->harga_per_item, 2, ',', '.')}}</td>
                      <td class="px-1000">{{$dpj->jumlah}}</td>
                      <td class="text-end px-0"><h6 style="color: blue">{{'Rp ' . number_format($dpj->jumlah * $dpj->muatan->harga_per_item, 2, ',', '.');}}</h6></td>
                    </tr>
                    @endforeach
                    {{-- <tr>
                      <td class="px-0">Total pengurangan refund</td>
                      <td>2000</td>
                      <td class="text-end px-0"><h6 style="color: red">- {{'Rp ' . number_format(34000, 2, ',', '.');}}</h6></td>
                    </tr> --}}
                  </tbody>
                </table>
    
                <div class="mt-5">
                  {{-- <div class="d-flex justify-content-end">
                    <p class="text-muted me-3">Subtotal:</p>
                    <span>{{'Rp ' . number_format($df->pemesanan_jadwal->total_harga, 2, ',', '.');}}</span>
                  </div>
                  <div class="d-flex justify-content-end">
                    <p class="text-muted me-3">Refund :</p>
                    <span>-{{'Rp ' . number_format($totalKurang, 2, ',', '.');}}</span>
                  </div> --}}
                  <div class="d-flex justify-content-end mt-3">
                    <h5 class="me-3">Total Pembayaran :</h5>
                    <h5 class="text-success">{{'Rp ' . number_format($order->total_harga, 2, ',', '.')}}</h5>
                  </div>
                  <div class="d-flex justify-content-end mt-3">
                    {{-- <h5 class="me-3">STATUS :</h5> --}}
                    {{-- <h5 class="text-success">selesai</h5> --}}
                  </div>
                </div>
              </div>
              <a id="pay-button"  class="btn btn-dark btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light">
                <span class="svg-icon text-white me-2">
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-g</title><path d="M336,208V113a80,80,0,0,0-160,0v95" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><rect x="96" y="208" width="320" height="272" rx="48" ry="48" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect></svg> --}}
                </span>
                BAYAR
              </a>
            </div>
          </div>
        </div>
      </div>
    <br><br><br><br><br><br><br><br>
    <div class="container" style="display: none">
        <h1>Tiket</h1>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Detail Pesanan</h5>
              <p class="card-text">Ayo Lakukan pembayaran segera sebelum terlambat</p>
              <p> {{$order->id}}</p>
              <p>Nama : {{$order->user->name}}</p>
                <p>HP : {{$order->user->nomor_telepon}}</p>
                <p>Alamat : {{$order->user->alamat}}</p>
                <p>Qty : 
                    <ul>
                        @foreach($order->detail_pesan_jadwal as $dpj)
                            <li>{{$dpj->muatan->nama}} => {{$dpj->jumlah}}</li>
                        @endforeach
                    </ul>
                    
                </p>
                <p>Total price : {{ 'Rp.' . number_format($order->total_harga, 0, ',', '.')}}</p>
                {{-- <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button> --}}
                <!-- Include Snap token -->
                <input type="hidden" id="snapToken" value="{{$order->snap_token}}">
            </div>
          </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script type="text/javascript">
              var orderId = '{{$order->id}}'; // Ambil ID pesanan dari data yang ada di view
              
              // Kirim request Ajax ke endpoint backend untuk validasi stok

                          // Stok valid, lanjutkan ke pembayaran
                          var snapToken = $('#snapToken').val(); // Get Snap token from hidden input                       

                          // Trigger Snap popup
                          $('#pay-button').click(function(){
                            snap.pay(snapToken, {
                            onSuccess: function (result) {
                                // Payment success handling
                                window.location.href = 'tiket/{{$order->id}}';
                                console.log(result);
                            },
                            onPending: function (result) {
                                // Payment pending handling
                                alert("Waiting for payment!");
                                console.log(result);
                            },
                            onError: function (result) {
                                // Payment error handling
                                alert("Payment failed!");
                                console.log(result);
                            },
                            onClose: function () {
                                // Popup closed handling
                                alert('You closed the popup without finishing the payment');
                            }
                        });

                        });


                          
                      
  </script>
  
  <div class="container">
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
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

