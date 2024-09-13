@extends('layouts.pkBar')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Request Tambah Kapal</h1>

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

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Kapal</th>
                    <th>Deskripsi</th>
                    <th>Nama Pemilik Kapal</th>
                    <th>Nomor HP Pemilik Kapal</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="kapalTable">
                @foreach ($kapals as $k)
                <tr class="kapal-row" data-status="{{ $k->diizinkan ? 'diizinkan' : 'belum-diizinkan' }}">
                    <td>{{ $k->nama }}</td>
                    <td>{{$k->deskripsi}}</td>
                    <td>{{ $k->user->name }}</td>
                    <td>+{{ $k->user->nomor_telepon }}</td>
                    <td>
                        <img src="{{ asset('storage/Kapal_Image/'.$k->gambar) }}" alt="{{ $k->nama }}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        @if($k->diizinkan == 0)
                            <form action="{{ route('kapal.approve', $k) }}" method="POST">
                                @csrf
                                @method('patch')
                                <button class="btn btn-success">Izinkan</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                <!-- Pesan yang muncul ketika tidak ada data yang cocok -->
                <tr id="noData" style="display: none;">
                    <td colspan="5" class="text-center text-danger"><h3>Sedang tidak ada permintaan izin penambahan kapal.</h3></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kapalTable = document.getElementById('kapalTable');
    const rows = kapalTable.querySelectorAll('.kapal-row');
    const noData = document.getElementById('noData');

    if (rows.length === 0) {
        noData.style.display = '';
    } else {
        noData.style.display = 'none';
    }
});
</script>

@endsection
