@extends('layouts.adminBar2')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Penghasilan Pemesanan Jadwal</h2>
    <div class="row mb-4">
        <div class="col-md-3">
            <label for="from_date" class="form-label">Dari Tanggal</label>
            <input type="date" id="from_date" class="form-control" placeholder="Dari Tanggal" value="{{ request('from_date') }}" required>
        </div>
        <div class="col-md-3">
            <label for="to_date" class="form-label">Sampai Tanggal</label>
            <input type="date" id="to_date" class="form-control" placeholder="Sampai Tanggal" value="{{ request('to_date') }}" required>
        </div>
        <div class="col-md-3 align-self-end">
            <button id="filter" class="btn btn-primary">Filter</button>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Penghasilan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pemesananJadwals as $index => $pemesanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($pemesanan->ditambahkan_pada)->format('Y-m-d') }}</td>
                <td>{{ number_format($pemesanan->total_harga, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>Total Penghasilan: <span style="color:green">Rp.{{ number_format($totalIncome, 2) }}</span></h3>
</div>

<script>
    document.getElementById('from_date').addEventListener('change', function() {
        const fromDate = document.getElementById('from_date').value;
        document.getElementById('to_date').min = fromDate;
    });

    document.getElementById('to_date').addEventListener('change', function() {
        const toDate = document.getElementById('to_date').value;
        document.getElementById('from_date').max = toDate;
    });

    document.getElementById('filter').addEventListener('click', function() {
        const fromDate = document.getElementById('from_date').value;
        const toDate = document.getElementById('to_date').value;

        // Cek apakah kedua input tanggal sudah diisi
        if (!fromDate || !toDate) {
            alert('Harap isi kedua tanggal.');
            return;
        }

        // Cek apakah tanggal dari lebih kecil atau sama dengan tanggal sampai
        if (new Date(fromDate) > new Date(toDate)) {
            alert('Tanggal dari harus lebih kecil atau sama dengan tanggal sampai.');
            return;
        }

        let query = '?';

        if (fromDate) {
            query += `from_date=${fromDate}&`;
        }

        if (toDate) {
            query += `to_date=${toDate}`;
        }

        window.location.href = '{{ route('income.index2') }}' + query;
    });
</script>

@endsection
