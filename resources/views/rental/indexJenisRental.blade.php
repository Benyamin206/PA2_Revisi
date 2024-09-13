@extends('layouts.pkBar')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Jenis Rental Kapal</h1>
        <a href="{{ route('rental.createJenisRental') }}" class="btn btn-primary">Tambah Jenis Rental</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Jenis Rental Kapal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisRentals as $index => $jenis)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jenis->jenis }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
