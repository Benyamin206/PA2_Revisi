@extends('layouts.app')
@section('content')


<br><br>
<div class="container">
<center>    <h2>PesananYang Belum Dibayar : </h2></center>
    <br><br><br>
    {{-- @foreach ($pesanans as $p)
        <h1>{{$p->id}}</h1>
        <p>{{$p->status_pembayaran}}</p>
        <p>{{$p->total_harga}}</p>
        <br><br><br>
    @endforeach --}}

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @php
            $found = false; // Inisialisasi variabel penanda
        @endphp
        @foreach ($pesanans as $p)
            @php
                $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                $ditambahkanTime = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $p->ditambahkan_pada);
                $selisihWaktu = strtotime($now) - strtotime($ditambahkanTime);
            @endphp
            @if($selisihWaktu < 600)
            {{-- @if($selisihWaktu < 86400) --}}

                @php
                    $found = true; // Set variabel penanda menjadi true jika ada pesanan yang memenuhi kondisi
                @endphp
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rute : {{$p->jadwal->rute->lokasi_berangkat}} - {{$p->jadwal->rute->lokasi_tujuan}}</h4>
                            <p class="card-title">{{$p->jadwal->waktu_berangkat}}</p>
                            <h6 class="card-text">Total pembayaran : {{ 'Rp.' . number_format($p->total_harga, 0, ',', '.')}}</h6>             
                            <a href="{{route('bayar_jadwal',$p->id)}}" class="btn btn-primary">Lakukan pembayaran</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    
        {{-- Menampilkan keterangan jika tidak ada pesanan --}}
        @if (!$found)
            <div class="col">
                <p>Tidak ada pesanan yang belum dibayar atau anda belum memesan.</p>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>
        @endif
    </div>
    
      

</div>

<br>
@endsection

