@extends('layouts.adminBar2')

@section('content')
<div class="container">
    <center><h4 class="my-4">Muatan</h4></center>
    <div class="d-flex justify-content-between mb-4">
        <form action="{{ route('tambah_muatan') }}">
            <button type="submit" class="btn btn-success">Tambah Muatan</button>
        </form>
    </div>

    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga Per Item</th>
                <th scope="col">Maksimal</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($muatans as $index => $m)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $m->nama }}</td>
                <td>{{ 'Rp ' . number_format($m->harga_per_item, 0, ',', '.') }}</td>
                <td>{{ $m->maksimal }}</td>
                <td>{{ $m->aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('edit_muatan', $m) }}" class="btn btn-warning btn-sm">Edit</a>
                        {{-- Uncomment the form below to enable deletion --}}
                        {{-- <form action="{{ route('hapus_muatan', $m->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
