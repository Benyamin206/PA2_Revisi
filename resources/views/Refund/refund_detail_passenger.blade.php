@extends('layouts.app')

@section('content')
<style>
    body{
      /* margin-top:20px; */
background:#87CEFA;

.myFooter{
  display: none;
}

.mfs{
  display: none;
}
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
<br><br>
@php
$totalKurang = $df->pemesanan_jadwal->total_harga - $df->harga;
@endphp
<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xl-7">
        <div class="card">
          <div class="card-body p-5">
            <h2>
              Hai {{$df->pemesanan_jadwal->user->name}},
            </h2>
            <p class="fs-sm">
              {{-- This is the receipt for a payment of <strong>$312.00</strong> (USD) you made to Spacial Themes. --}}
              Ini adalah keterangan dari  <strong>refund jadwal</strong> yang telah anda lakukan

            </p>

            <div class="border-top border-gray-200 pt-4 mt-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-muted mb-2">ID PEMESANAN : </div>
                  <strong>{{$df->pemesanan_jadwal_id}}</strong>
                </div>
                <div class="col-md-6 text-md-end">
                  <div class="text-muted mb-2">Waktu Pemesanan</div>
                  <strong>{{$df->pemesanan_jadwal->ditambahkan_pada}}</strong>
                </div>
              </div>
            </div>

            <div class="border-top border-gray-200 mt-4 py-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-muted mb-2">CLIENT</div>
                  <strong>
                    {{$df->pemesanan_jadwal->user->name}} </strong>
                  <p class="fs-sm">
                    {{$df->pemesanan_jadwal->user->alamat}}                    <br>
                    <a href="#!" class="text-purple">{{$df->pemesanan_jadwal->user->email}}
                    </a>
                  </p>
                </div>
                <div class="col-md-6 text-md-end">
                  <div class="text-muted mb-2">BANK PENGEMBALIAN UANG</div>
                  <strong>
                    {{$df->bank_tujuan}}
                  </strong>
                  <p class="fs-sm"> 
        Nomor Rekening : {{$df->nomor_rekening}}                    <br>
        Nama Penerima : {{$df->nama_penerima}} <br>
                    </p>
                  </p>
                </div>
              </div>
            </div>

            <table class="table border-bottom border-gray-200 mt-3">
              <thead>
                <tr>
                  <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Description</th>
                  <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="px-0">Total harga pemesanan jadwal</td>
                  <td class="text-end px-0"><h6 style="color: blue">{{'Rp ' . number_format($df->pemesanan_jadwal->total_harga, 2, ',', '.');}}</h6></td>
                </tr>
                <tr>
                  <td class="px-0">Total pengurangan refund</td>
                  <td class="text-end px-0"><h6 style="color: red">- {{'Rp ' . number_format($totalKurang, 2, ',', '.');}}</h6></td>
                </tr>
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
                <h5 class="me-3">Total Pengembalian :</h5>
                <h5 class="text-success">{{'Rp ' . number_format($df->harga, 2, ',', '.')}}</h5>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <h5 class="me-3">STATUS :</h5>
                <h5 class="text-success">{{$df->status}}</h5>
              </div>
            </div>
          </div>
          @if ($df->bukti_refund != NULL)
          <a href="{{url('storage/Refund_Payment_Receipt/'. $df->bukti_refund)}}" class="btn btn-dark btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light">
            <span class="svg-icon text-white me-2">
              {{-- <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><title>ionicons-v5-g</title><path d="M336,208V113a80,80,0,0,0-160,0v95" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><rect x="96" y="208" width="320" height="272" rx="48" ry="48" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect></svg> --}}
            </span>
            Cek Bukti Pembayaran  
          </a>
          @endif

        </div>
      </div>
    </div>
  </div>
<br><br>
  @endsection