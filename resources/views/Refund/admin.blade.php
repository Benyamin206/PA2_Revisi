@extends('layouts.adminBar2')

@php
  $x = 1;
@endphp

@section('content')
<style>
  /* Add any necessary styles here */
</style>

<div class="containes">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Refund</h1>
    {{-- <a href="{{ route('index_rute') }}" class="btn btn-secondary">Kembali ke Index Rute</a> --}}
  </div>
  
  <div class="table-responsive">
    <table class="table table-striped ">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID Pemesanan Jadwal</th>
          <th scope="col">Bank Tujuan</th>
          <th scope="col">Nomor Rekening</th>
          <th scope="col">Nama Penerima</th>
          <th scope="col">Total Pengembalian</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
          <th scope="col">Konfirmasi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($ar as $a)
          <tr>
            <th scope="row">{{ $x }}</th>
            <td>{{ $a->pemesanan_jadwal_id }}</td>
            <td>{{ $a->bank_tujuan }}</td>
            <td>{{ $a->nomor_rekening }}</td>
            <td>{{ $a->nama_penerima }}</td>
            <td>{{ 'Rp ' . number_format($a->harga, 2, ',', '.') }}</td>
            <td>{{ $a->status }}</td>
            <td>
              @if(!$a->bukti_refund)
                <form action="{{ route('store_payment_receipt', $a) }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-start">
                  @csrf
                  @method('patch')
                  <input type="file" name="gambar" class="form-control mb-2" required>
                  <button class="btn btn-primary" type="submit">Upload Bukti Pembayaran</button>
                </form>
                <br><br>
              @else
                <a class="btn btn-success" target="_blank" href="{{ url('storage/Refund_Payment_Receipt/'.$a->bukti_refund) }}">Cek Bukti Pembayaran</a>
                <br><br>
                {{-- Modifikasi button edit ini menjadi --}}
                <button class="btn btn-info" onclick="toggleForm({{ $x }})">Edit Bukti Pembayaran</button>
                <br><br>
                <div id="editForm-{{ $x }}" style="display: none;">
                  <form action="{{route('update_payment_refund', $a)}}" method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-start">
                    @csrf
                    @method('patch')
                    <input type="file" name="gambar" id="payment_baru" class="form-control mb-2">
                    <button class="btn btn-warning" type="submit">Upload Bukti Pembayaran</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleForm({{ $x }})">Batal</button>
                  </form>
                </div>
              @endif
            </td>
            <td>
              @if ($a->status == 'Sedang Diproses')
              <form action="{{route('konfirmasi_pembayaran_refund', $a)}}" method="POST">
                @csrf
                @method('patch')
                @if($a->bukti_refund)
                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                @else
                <p style="color: red">Upload bukti pembayaran untuk melakukan konfirmasi pembayaran</p>
                @endif
                
              </form>      
              @elseif ($a->status == 'Sudah Dibayar')
              <form action="{{route('batal_konfirmasi_pembayaran_refund', $a)}}" method="POST">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-danger">Batal Konfirmasi Pembayaran</button>
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
</div>

<script>
  function toggleForm(id) {
    const form = document.getElementById(`editForm-${id}`);
    if (form.style.display === 'none') {
      form.style.display = 'block';
    } else {
      form.style.display = 'none';
    }
  }
</script>

@endsection
