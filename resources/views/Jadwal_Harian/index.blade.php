@extends('layouts.adminBar2')
@section('content')

<h1>Jadwal Harian</h1>
<br><br>

<h5>Pilih tanggal penerapan jadwal harian</h5><br>

<form action="{{route('terapkan_jadwal_harian')}}" method="POST">
    @csrf
    <input required type="date" name="tanggal_jadwal_harian" id="tanggal_jadwal_harian" min="{{ date('Y-m-d', strtotime('+1 day')) }}"><br><br>
    <button class="btn btn-success" type="submit">Terapkan</button>
</form>

<br><br>
    <a class="btn btn-primary" href="{{route('jadwal.harian.tambah')}}">Tambah Jadwal Harian</a>
<br><br>

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

<table class="table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Jam Berangkat</th>
            <th scope="col">Rute</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody id="jadwal-table">
        <?php $num = 1; ?>
        @foreach($jadwal_harians as $jh)
        <tr class="jadwal-row">
            <th scope="row">{{ $num }}</th>
            <td class="jam-berangkat">{{ $jh->jam_berangkat }}</td>
            <td>{{ $jh->rute->lokasi_berangkat }} - {{ $jh->rute->lokasi_tujuan }}</td>
            <td><a href="{{route('jadwal.harian.edit', $jh)}}" class="btn btn-warning">Edit</a>
                <form action="{{route('jadwal.harian.delete', $jh)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        <?php $num++; ?>
        @endforeach
    </tbody>
</table>
@endsection
