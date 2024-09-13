@extends('layouts.pkBar')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Izin Kapal</h1>

    <div class="mb-4">
        <label for="filterStatus" class="form-label"><h5>Filter Status Perizinan:</h5></label>
        <select id="filterStatus" class="form-control">
            <option value="all">Semua</option>
            <option value="diizinkan">Telah Diizinkan</option>
            <option value="belum-diizinkan">Menunggu Izin</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Kapal</th>
                    <th>Gambar</th>
                    <th>Status Perizinan</th>
                </tr>
            </thead>
            <tbody id="kapalTable">
                @foreach ($kapals as $k)
                <tr class="kapal-row" data-status="{{ $k->diizinkan ? 'diizinkan' : 'belum-diizinkan' }}">
                    <td>{{ $k->nama }}</td>
                    <td>
                        <img src="{{ asset('storage/Kapal_Image/'.$k->gambar) }}" alt="{{ $k->nama }}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        @if($k->diizinkan == 1)
                        <span class="badge bg-success text-light">Telah Diizinkan Oleh Admin</span>
                        @elseif ($k->diizinkan == 0)
                        <span class="badge bg-warning text-dark">Menunggu Izin Dari Admin</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                <!-- Pesan yang muncul ketika tidak ada data yang cocok -->
                <tr id="noData" style="display: none;">
                    <td colspan="3" class="text-center">Tidak ada data yang cocok dengan filter perizinan.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterStatus = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('.kapal-row');
    const noData = document.getElementById('noData');

    filterStatus.addEventListener('change', function() {
        const filterValue = this.value;
        let hasVisibleRow = false;

        rows.forEach(row => {
            if (filterValue === 'all') {
                row.style.display = '';
                hasVisibleRow = true;
            } else if (filterValue === 'diizinkan' && row.dataset.status === 'diizinkan') {
                row.style.display = '';
                hasVisibleRow = true;
            } else if (filterValue === 'belum-diizinkan' && row.dataset.status === 'belum-diizinkan') {
                row.style.display = '';
                hasVisibleRow = true;
            } else {
                row.style.display = 'none';
            }
        });

        noData.style.display = hasVisibleRow ? 'none' : '';
    });

    // Trigger the change event to handle the initial state
    filterStatus.dispatchEvent(new Event('change'));
});
</script>

@endsection
