@extends('layouts.adminBar2')
@section('content')



<div class="container mt-5">
    <h1 class="mb-4">Edit Jadwal Harian</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif

    <form action="{{ route('jadwal.harian.update', $jh) }}" method="POST">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="jam_berangkat" class="form-label"><h5>Jam Keberangkatan</h5></label>
            <input type="time" class="form-control" value="{{$jh->jam_berangkat}}" id="jam_berangkat" name="jam_berangkat" required>
        </div>

        <br>
        <div class="mb-3">
            <label for="rute_id" class="form-label"><h5>Rute</h5></label><br>
            <select class="form-control" id="rute_id" name="rute_id" required>
                <option value="{{$jh->rute->id}}">{{$jh->rute->lokasi_berangkat}} ke {{$jh->rute->lokasi_tujuan}}</option>
                @foreach ($rutes as $r)
                    @if ($r->id != $jh->rute->id) 
                    <option value="{{ $r->id }}">{{ $r->lokasi_berangkat }} ke {{ $r->lokasi_tujuan }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <br>
        <input type="hidden" name="kapal_id" value="21">
        <input type="hidden" name="supir_id" value="21">

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
