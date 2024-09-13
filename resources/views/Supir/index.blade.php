@extends('layouts.adminBar2')

@section('content')
<center><h4 class="my-4">NAHKODA</h4></center>

<div class="container mb-4">
   <form action="{{route('tambah_supir')}}">
    <button type="submit" class="btn btn-success">Tambah Nahkoda</button>
   </form>
</div>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
        });
    </script>
@elseif(session('delete'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Menghapus Nahkoda!',
            text: '{{ session('delete') }}',
        });
    </script>
@endif

<table class="table table-striped table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Nomor HP</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        <?php $num = 1; ?>
        @foreach($supirs as $s)
        <tr>
            <th scope="row">{{$num}}</th>
            <td>{{$s->name}}</td>
            <td>{{$s->alamat}}</td>
            <td>{{$s->nomor_hp}}</td>
            <td>{{$s->jenis_kelamin}}</td>
            <td>{{$s->aktif ? "Aktif" : "Tidak Aktif"}}</td>
            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('edit_supir', $s) }}" class="btn btn-warning">Edit</a>
                    {{-- <form action="{{ route('hapus_supir', $s->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form> --}}
                </div>
            </td>
          </tr>
          <?php $num++; ?>
        @endforeach
    </tbody>
</table>

@include('sweetalert::alert')
@endsection
