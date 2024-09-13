@extends('layouts.adminBar2')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Penghasilan pada {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Jadwal</th>
                <th>Total Penghasilan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($schedule->waktu_berangkat)->format('d-m-Y H:i') }}</td>
                    <td>{{ number_format($schedule->total_income, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('income.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
