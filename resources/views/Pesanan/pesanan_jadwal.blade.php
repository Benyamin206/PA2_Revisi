@extends('layouts.app')
@section('content')



<div class="container">
  <br><br>
  <a href="{{route('riwayat_jadwal.index')}}" class="btn btn-success">Riwayat Pemesanan</a>
  <br><br> 
    {{-- <center><h2>Pesanan Saya : </h2></center> --}}

    <br>
    {{-- @foreach ($pesanans as $p)
        <h1>{{$p->id}}</h1>
        <p>{{$p->status_pembayaran}}</p>
        <p>{{$p->total_harga}}</p>
        <br><br><br>
    @endforeach --}}
      @php
        $found = false;
      @endphp
 <div class="container">
  <br><br>
 

  <br>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      @foreach ($pesanans as $p)
      @if ($p->jadwal_pulang_id == NULL)
      @php
          $tampilkan = false;
          $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                  $now2 = strtotime($now);
                  $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwal->waktu_berangkat);
                  $waktuBerangkat2 = strtotime($waktuBerangkat);
          if($now2 < $waktuBerangkat2){
              $tampilkan = true;
          }
      @endphp
      @elseif ($p->jadwal_pulang_id != NULL)
      @php
          $tampilkan = false;
          $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                  $now2 = strtotime($now);
                  $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->jadwalPulang->waktu_berangkat);
                  $waktuBerangkat2 = strtotime($waktuBerangkat);
          if($now2 < $waktuBerangkat2){
              $tampilkan = true;
          }
      @endphp
      @endif

          @if ($tampilkan)

          <div class="col">
            <div class="card card-border-primary card-shadow">
                <div class="card-body text-center">
                    <h4 class="card-title">Rute: {{$p->jadwal->rute->lokasi_berangkat}} - {{$p->jadwal->rute->lokasi_tujuan}}</h4>
                    <p class="card-title">{{$p->jadwal->waktu_berangkat}}</p>
                    <h6 class="card-text">Total pembayaran: {{ 'Rp.' . number_format($p->total_harga, 0, ',', '.') }}</h6>

                    @if($p->status_pembayaran == 'Paid' && $p->refund == 0)
                        <a href="{{route('My_tiket', $p->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat Tiket</a>
                        <a href="{{route('form_refund_jadwal', $p)}}" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Refund</a>
                    @elseif ($p->status_pembayaran == 'Paid' && $p->refund == 1)
                        <h4 class="text-danger"><strong>Pesanan Telah Di-Refund</strong></h4>
                        <a class="btn btn-primary" href = "{{route('refund_detail_passenger', $p)}}">Cek Detail Refund</a>
                    @endif
                </div>
            </div>
        </div>              
          @endif
      @endforeach
  </div>
      
      {{-- @if(!$found)
              <div class="col">
        <p>Sedang tidak ada pesanan yang sudah dibayar</p>
      </div>
      @endif --}}

</div>


@endsection
