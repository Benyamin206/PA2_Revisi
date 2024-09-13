@extends('layouts.adminBar2')

@section('content')

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@elseif (session('delete'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Menghapus Nahkoda!',
            text: '{{ session('success') }}',
        });
    </script>
@endif

<center><h4>Rute</h4></center>
<div class="container mt-4">
    <div class="d-flex justify-content-start mb-4">
        <form action="{{ route('tambah_rute') }}">
            <button type="submit" class="btn btn-success">Tambah Rute</button>
        </form>
    </div>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Lokasi Berangkat</th>
                <th scope="col">Lokasi Tujuan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $num = 1; ?>
            @foreach($rutes as $r)
            <tr>
                <th scope="row">{{ $num }}</th>
                <td>{{ $r->lokasi_berangkat }}</td>
                <td>{{ $r->lokasi_tujuan }}</td>
                <td>{{ $r->aktif ? 'Aktif' : 'Tidak Aktif' }}</td>
                <td>
                    <form action="{{ route('edit_rute', $r->id) }}">
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
            </tr>
            <?php $num++; ?>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
