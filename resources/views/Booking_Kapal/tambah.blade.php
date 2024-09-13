@extends('layouts.pkBar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Form Booking Kapal</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('store_booking') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user" class="form-label">User yang Memesan</label>
                    <select class="form-select form-control" id="user" name="user_id">
                        @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} / {{ $u->email }} / {{ $u->nomor_telepon }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kapal" class="form-label">Pilih Kapal</label>
                    <select class="form-select form-control" id="kapal" name="kapal_id">
                        @foreach($kapals as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis_rental_kapal" class="form-label">Pilih Jenis atau Tujuan Rental Kapal</label>
                    <select class="form-select form-control" id="jenis_rental_kapal" name="jenis_rental_kapal_id">
                        @foreach($tujuans as $t)
                        <option value="{{ $t->id }}">{{ $t->jenis }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Booking</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal">
                </div> --}}
                <div class="mb-3">
                    <label for="lokasi_berangkat" class="form-label">Lokasi Berangkat</label>
                    <input type="text" class="form-control" id="lokasi_berangkat" name="lokasi_berangkat">
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga (Rupiah)</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Rp....">
                </div>
                <input type="hidden" name="pki" value="{{ Auth::id() }}" id="">
                <button type="submit" class="btn btn-primary">Rental Kapal</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#tanggal", {
            minDate: "today",
            dateFormat: "Y-m-d",
        });
    });
</script>

@endsection
