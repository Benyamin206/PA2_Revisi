@extends('layouts.app')
<style>
    .input-group {
        display: flex;
    }
    .input-group .form-control {
        flex: 1;
        text-align: center;
    }
    .input-group .btn {
        background-color: #007bff;
        color: white;
    }
</style>

@section('content')
{{-- <a href="/home">Dashboard</a> --}}

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <form id="jadwalForm" action="{{route('form_informasi_muatan')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Form Pemesanan Tiket Pergi</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-4">Rute: {{$jadwalPergi->rute->lokasi_berangkat}} - {{$jadwalPergi->rute->lokasi_tujuan}}</h5>
                        @foreach($muatans as $muatan)
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label for="muatan_pergi_{{ $muatan->id }}" class="form-label"><b> {{ $muatan->nama }} ({{ 'Rp.' . number_format($muatan->harga_per_item, 0, ',', '.') }})</b></label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-decrement">-</button>
                                    <input type="number" name="muatan_pergi[{{ $muatan->id }}]" class="form-control" id="muatan_pergi_{{ $muatan->id }}" value="{{ old('muatan_pergi.' . $muatan->id, 0) }}">
                                    <button type="button" class="btn btn-increment">+</button>
                                </div>
                                @error('muatan_pergi.' . $muatan->id)
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($muatan->id == 1 || $muatan->id == 2)
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Kursi Tersedia: {{ $stokMuatanPergi[$muatan->id] }}</b></p>
                            </div>
                            @elseif ($muatan->id == 3)
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Bayi dapat dipangku</b></p>
                            </div> 
                            @else
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Space Tersedia: {{ $stokMuatanPergi[$muatan->id] }}</b></p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Form Pemesanan Tiket Pulang</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-4">Rute: {{$jadwalPulang->rute->lokasi_berangkat}} - {{$jadwalPulang->rute->lokasi_tujuan}}</h5>
                        @foreach($muatans as $muatan)
                        <div class="form-group row mb-4">
                            <div class="col-md-6">
                                <label for="muatan_pulang_{{ $muatan->id }}" class="form-label"><b> {{ $muatan->nama }} ({{ 'Rp.' . number_format($muatan->harga_per_item, 0, ',', '.') }}) </b></label>
                                <div class="input-group">
                                    <button type="button" class="btn btn-decrement">-</button>
                                    <input type="number" name="muatan_pulang[{{ $muatan->id }}]" class="form-control" id="muatan_pulang_{{ $muatan->id }}" value="{{ old('muatan_pulang.' . $muatan->id, 0) }}">
                                    <button type="button" class="btn btn-increment">+</button>
                                </div>
                                @error('muatan_pulang.' . $muatan->id)
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($muatan->id == 1 || $muatan->id == 2)
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Kursi Tersedia: {{ $stokMuatanPulang[$muatan->id] }}</b></p>
                            </div>
                            @elseif ($muatan->id == 3)
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Bayi dapat dipangku</b></p>
                            </div> 
                            @else
                            <div class="col-md-6">
                                <p class="mt-2" style="color: red"><b>Space Tersedia: {{ $stokMuatanPulang[$muatan->id] }}</b></p>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <input type="hidden" name="jadwal_pergi_id" value="{{ $jadwalPergi->id }}">
            <input type="hidden" name="jadwal_pulang_id" value="{{ $jadwalPulang->id }}">
            <button type="submit" class="btn btn-primary">Next</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.btn-increment').forEach(button => {
            button.addEventListener('click', () => {
                const input = button.previousElementSibling;
                input.value = parseInt(input.value) + 1;
            });
        });

        document.querySelectorAll('.btn-decrement').forEach(button => {
            button.addEventListener('click', () => {
                const input = button.nextElementSibling;
                if (input.value > 0) {
                    input.value = parseInt(input.value) - 1;
                }
            });
        });
    });
</script>
@endsection
