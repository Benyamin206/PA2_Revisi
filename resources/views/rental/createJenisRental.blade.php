@extends('layouts.pkBar')

@section('content')
<div class="container mt-5">
    <h1>Tambah Jenis Rental Kapal</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rental.storeJenisRental') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Rental Kapal</label>
            <input type="text" class="form-control" id="jenis" name="jenis" value="{{ old('jenis') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
