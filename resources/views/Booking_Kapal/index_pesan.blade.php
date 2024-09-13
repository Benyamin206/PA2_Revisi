@extends('layouts.pkBar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tampilkan SweetAlert dengan pesan flash
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@elseif(session('Konfirmasi'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tampilkan SweetAlert dengan pesan flash
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('Konfirmasi') }}',
        });
    </script>
@endif

@php
    $x = 1;
@endphp 
<div class="containerss">
    <table class="table table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pemesan</th>
                <th scope="col">Kapal</th>
                <th scope="col">Waktu Berangkat</th>
                <th scope="col">Lokasi Berangkat</th>
                <th scope="col">Tujuan Rental</th>
                <th scope="col">Harga</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rk as $r)
            <tr>
                <th scope="row">{{$x}}</th>
                <td>{{$r->user->name}}</td>
                <td>{{$r->kapal->nama}}</td>
                <td>{{ \Carbon\Carbon::parse($r->waktu_berangkat)->format('Y-m-d') }}</td>
                <td>{{$r->lokasi_berangkat}}</td>
                <td>{{$r->jenisRentalKapal->jenis}}</td>
                <td>{{ 'Rp ' . number_format($r->harga, 2, ',', '.') }}</td>
                <td>
                    {{$r->status_pembayaran}}
                </td>            
                @if(!$r->bukti_pembayaran)
                <td>Belum diupload</td>
                @else
                <td>
                    <a class="btn btn-primary btn-sm" target="_blank" href="{{ asset('storage/Booking_Kapal_Payment_Receipt/'.$r->bukti_pembayaran) }}">Lihat Bukti Pembayaran</a></td>
                @endif
                <td>
                    @if($r->status_pembayaran == "Belum Dibayar")
                        <form action="{{route('konfirmasi_pembayaran_booking_kapal', $r)}}" method="POST">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success btn-sm" type="submit">Konfirmasi Pembayaran</button>
                        </form>
                    @else
                    <form action="{{route('batal_konfirmasi_pembayaran_booking_kapal', $r)}}" method="POST">
                        @csrf
                        @method('patch')
                        <button class="btn btn-danger btn-sm" type="submit">Batalkan Konfirmasi Pembayaran</button>
                    </form>
                    @endif
                </td>
            </tr>
            @php
                $x++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>

@endsection
