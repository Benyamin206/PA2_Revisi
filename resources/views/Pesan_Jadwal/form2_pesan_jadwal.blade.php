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
    
    <div class="container mt-5" style="width: 40%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Form Pemesanan Tiket</h2>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-4">Rute: {{$jadwal->rute->lokasi_berangkat}} - {{$jadwal->rute->lokasi_tujuan}}</h5>
                        <form action="{{ route('isi_informasi_muatan') }}" method="post">
                            @csrf
                            @foreach($muatans as $muatan)
                            <div class="form-group row mb-4">
                                <div class="col-md-6">
                                    <label for="muatan_{{ $muatan->id }}" class="form-label"><b>{{ $muatan->nama }} ({{ 'Rp.' . number_format($muatan->harga_per_item, 0, ',', '.') }})</b></label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-decrement">-</button>
                                        <input type="number" name="muatan[{{ $muatan->id }}]" class="form-control" id="muatan_{{ $muatan->id }}" value="{{ old('muatan.' . $muatan->id, 0) }}">
                                        <button type="button" class="btn btn-increment">+</button>
                                    </div>
                                    @error('muatan.' . $muatan->id)
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if($muatan->id == 1 || $muatan->id == 2)
                                <div class="col-md-6">
                                    <p class="mt-2" style="color: red"><b>Kursi Tersedia: {{ $stokMuatan[$muatan->id] }}</b></p>
                                </div>
                                @elseif ($muatan->id == 3)
                                <div class="col-md-6">
                                    <p class="mt-2" style="color: red"><b>Bayi dapat dipangku</b></p>
                                </div> 
                                @else
                                <div class="col-md-6">
                                    <p class="mt-2" style="color: red"><b>Space Tersedia: {{ $stokMuatan[$muatan->id] }}</b></p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                            <br>
                            <div class="mt-4 text-">
                                <button style="" type="submit" class="btn btn-primary btn-lg">Pesan Sekarang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
