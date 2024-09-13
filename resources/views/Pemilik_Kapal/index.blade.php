@extends('layouts.adminBar2')

@section('content')
<div class="">
    <center><h4>List Pemilik Kapal</h4></center>
    <br><br>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Display SweetAlert with flash message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <div class="table-responsive mt-4">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Jenis Kelamin</th>
                    {{-- <th scope="col">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                @foreach($pk as $p)
                <tr>
                    <th scope="row">{{ $num }}</th>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->nomor_telepon }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    {{-- <td>
                        <div class="d-flex gap-2">
                            <form action="{{ route('hapus_pemilik_kapal', $p->id) }}" method="POST" onsubmit="return confirmDeletion(event, '{{ $p->name }}')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td> --}}
                </tr>
                <?php $num++; ?>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDeletion(event, name) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus pemilik kapal bernama ${name}. Tindakan ini tidak dapat dibatalkan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }
    </script>
</div>
@endsection
