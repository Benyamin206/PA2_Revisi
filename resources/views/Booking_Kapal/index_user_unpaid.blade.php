@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('content')
<div class="container">
    @php
$m = true;
@endphp

<a href="{{route('user.history_booking')}}" class="btn btn-success">Riwayat Pemesanan</a>
<br><br><br>

@php
    $x = 1;
@endphp 
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        {{-- <th scope="col">Pemesan</th> --}}
        <th scope="col">Kapal</th>
        <th scope="col">Waktu Berangkat</th>
        <th scope="col">Status Pembayaran</th>
        <th scope="col">Bukti Pembayaran</th>
        <th scope="col">Harga</th>
        {{-- <th scope="col">Aksi</th> --}}
      </tr>
    </thead>
   
    <tbody>
        @foreach($rk as $r)
        <tr>
            <th scope="row">{{$x}}</th>
            {{-- <td>{{$r->user->name}}</td> --}}
            <td>{{$r->kapal->nama}}</td>
            <td>{{ \Carbon\Carbon::parse($r->waktu_berangkat)->format('d-m-Y') }}</td>
            <td>
                @if($r->bukti_pembayaran && $r->status_pembayaran == "Belum Dibayar")
                    <p class="text-primary"><b>Menunggu Verifikasi</b></p>
                @else
                    @if($r->status_pembayaran == "Sudah Dibayar")
                    <p class="text-success"><b>Sudah Dibayar</b></p>
                    @else
                    <p class="text-danger"><b>Belum bayar</b></p>
                    @endif
                @endif
            </td>            
            <td>
                @if(!$r->bukti_pembayaran)
                    <form action="{{route('upload_bukti_pembayaran_rental', $r)}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('patch')
                        <input type="file" name="gambar" id="" class="form-control" required><br>
                        <button class="btn btn-primary">Upload</button>
                    </form>
                @elseif($r->bukti_pembayaran)
                <a class="btn btn-success" href="{{ url('storage/Booking_Kapal_Payment_Receipt/'.$r->bukti_pembayaran) }}">Lihat Bukti Pembayaran</a>    
                @endif

            </td>
            <td class="harga" data-harga="{{$r->harga}}">Rp.{{$r->harga}}</td>
          </tr>
          @php
            $x++;
          @endphp
        @endforeach
    </tbody>
  </table>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>

@endsection

<script>
    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    document.addEventListener('DOMContentLoaded', function () {
        var hargaElements = document.querySelectorAll('.harga');
        hargaElements.forEach(function (element) {
            var hargaValue = element.getAttribute('data-harga');
            element.textContent = formatRupiah(hargaValue, 'Rp.');
        });
    });
</script>
