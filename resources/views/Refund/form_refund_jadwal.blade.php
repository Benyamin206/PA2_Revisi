@extends('layouts.app')

@section('content')
<br><br>
<div class="container">


  

  <div class="container mt-5">
    <h2 class="text-center">Lakukan Pengembalian Dana Tiket Anda disini!</h2>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Syarat dan Ketentuan</h5>
            <p class="card-text">
                <ul>
                    <li>Potongan harga Pengembalian Dana akan semakin besar jika semakin mendekati hari keberangkatan kapal</li>
                    <li>Maksimal waktu melakukan Pengembalian Dana adalah H-1 dari hari keberangkatan kapal</li>
                </ul>
                Persentase Potongan Pengembalian Dana dari Hari keberangkatan:
                <ol>
                    <li>H-1 Potongan 50%</li>
                    <li>H-2 – H-3 40%</li>
                    <li>H-4 – dst. 30%</li>
                </ol>
            </p>
        </div>
    </div>
    <center>   
      <br><br>
      <div class="card mt-4" style="width: 50%">
        <div class="card-body" style="text-align: left; padding-left: 20px;">
          <h5 class="card-title text-center">Ajibata - Tomok</h5>
          <br>
          <p class="card-text">
              <strong>Nama Pemesan:</strong> {{$pj->user->name}} <br><br>  
              <strong>Tanggal Pemesanan:</strong> {{date("j F Y H:i", strtotime($pj->ditambahkan_pada))}} <br><br>
              <strong>Keberangkatan:</strong> {{date("j F Y H:i", strtotime($pj->jadwal->waktu_berangkat))}} <br><br>
              <strong>Waktu Sekarang:</strong> {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',  \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta')))}} <br><br>
              <strong>Selisih hari dengan waktu keberangkatan : </strong> {{$diffInDays}} hari <br><br>
              <strong style="color: blue">Persentase Potongan Refund : </strong> <span style="color: blue">{{$potongan}} %</span> <br><br>
              @php
              function formatRupiah($number){
                  return 'Rp ' . number_format($number, 2, ',', '.');
              }
              $potong = ($pj->total_harga * ($potongan/100));
              $totalRefund = $pj->total_harga - $potong;
              @endphp
              <strong>Total Harga Pemesanan:</strong> {{formatRupiah($pj->total_harga)}} <br><br>
              <strong>Potongan:</strong> {{formatRupiah($potong)}} <br><br>
              <strong style="color: red">Total Harga Pengembalian dana:</strong> <span style="color: red">{{formatRupiah($totalRefund)}}</span> <br><br>
          </p>
          <div class="text-center">
              <a href="#form-r" class="btn btn-primary">Ajukan Pengembalian Dana</a>
          </div>
        </div>
      </div>
    </center>
    
</div>
  <br><br><br><br><br>
  <br><br><br><br><br>


    <center>
          <br><br><br><br><br><br><br><br><br><br><br><br><br>
        {{-- <h1>{{$diffInDays}}</h1> --}}
          <div class="row justify-content-center" >
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="form-r"><center><h5><b>Refund Tiket Jadwal</b></h5></center></div>
                    @if ($errors->any())
                    <div class="alert alert-danger mt-3" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               

                    <div class="card-body" id="form-r">
                        <form method="POST" action="{{ route('store_refund_jadwal') }}">
                            @csrf
                            <div class="row mb-3">
                              <label for="bank_tujuan" class="col-md-4 col-form-label text-md-end">Nama Bank/E-Money Tujuan :  </label>

                              <div class="col-md-6">
                                  <select id="bank_tujuan" class="form-control" name="bank_tujuan" required></select>
                              </div>
                              
                          </div>
                            <div class="row mb-3">
                              <label for="nomor_rekening" class="col-md-4 col-form-label text-md-end">Nomor Rekening :  </label>
  
                              <div class="col-md-6">
                                  <input id="nomor_rekening" type="text" class="form-control" name="nomor_rekening" required>
                              </div>
                          </div>
                          <div class="row mb-3">
                            <label for="nama_penerima" class="col-md-4 col-form-label text-md-end">Nama Penerima :  </label>
                            <div class="col-md-6">
                                <input id="nama_penerima" type="text" class="form-control" name="nama_penerima" required>
                            </div>
                        </div>
                          <input type="hidden" name="pemesanan_jadwal_id" value="{{$pj->id}}" id="">
                          <input type="hidden" name="waktu_berangkat" value="{{$pj->jadwal->waktu_berangkat}}">
                          <center><button type="submit" class="btn btn-primary">Refund</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bankOptions = [
        'Bank Central Asia (BCA)',
        'Bank Rakyat Indonesia (BRI)',
        'Bank Negara Indonesia (BNI)',
        'Bank Mandiri',
        'OVO',
        'GoPay',
        'DANA',
        'LinkAja'
    ];

    const bankTujuanSelect = document.getElementById('bank_tujuan');

    bankOptions.forEach(function(bank) {
        const option = document.createElement('option');
        option.value = bank;
        option.textContent = bank;
        bankTujuanSelect.appendChild(option);
    });
});

</script>
@endsection