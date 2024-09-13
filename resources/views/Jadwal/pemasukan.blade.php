@extends('layouts.adminBar2')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Penghasilan per Tanggal Berangkat</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Berangkat</th>
                <th>Total Penghasilan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $income)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($income->date)->format('d-m-Y') }}</td>
                    <td>{{ number_format($income->total_income, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('income.show', ['date' => $income->date]) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
