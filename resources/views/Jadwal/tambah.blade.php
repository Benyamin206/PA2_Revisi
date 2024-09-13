@extends('layouts.adminBar2')

@section('content')
<center><h1>Tambah Jadwal</h1></center>
<style>
    input:disabled {
        background-color: #ccc;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="container">
    <h5><a href="{{ route('index_jadwal') }}">Index Jadwal</a></h5>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Jadwal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store_jadwal') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="waktu_berangkat" class="col-md-4 col-form-label text-md-end">Waktu Berangkat</label>
                            <div class="col-md-6">
                                <input id="waktu_berangkat" type="text" class="form-control" name="waktu_berangkat" value="{{ old('waktu_berangkat') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rute" class="col-md-4 col-form-label text-md-end">Rute</label>
                            <div class="col-md-6">
                                <select name="rute_id" id="rute" class="form-control" required>
                                    <option value="" disabled selected>----- Pilih Rute -----</option>
                                    @foreach($rutes as $r)
                                        <option value="{{ $r->id }}" {{ old('rute_id') == $r->id ? 'selected' : '' }}>
                                            {{ $r->lokasi_berangkat }} - {{ $r->lokasi_tujuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kapal" class="col-md-4 col-form-label text-md-end">Kapal</label>
                            <div class="col-md-6">
                                <select name="kapal_id" id="kapal" class="form-control" required>
                                    <option value="" disabled selected>----- Pilih Kapal -----</option>
                                    @foreach($kapals as $k)
                                        <option value="{{ $k->id }}" data-tanggal-tersedia-booking="{{ $k->tanggal_tersedia_booking }}" {{ old('kapal_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama }} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nahkoda" class="col-md-4 col-form-label text-md-end">Nahkoda</label>
                            <div class="col-md-6">
                                <select name="supir_id" id="nahkoda" class="form-control" required>
                                    <option value="" disabled selected>----- Pilih Nahkoda -----</option>
                                    @foreach($nahkodas as $n)
                                        <option value="{{ $n->id }}" {{ old('supir_id') == $n->id ? 'selected' : '' }}>
                                            {{ $n->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah Jadwal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#waktu_berangkat', {
        enableTime: true,
        minDate: 'today', // Ensure only future dates can be selected
        dateFormat: 'Y-m-d H:i', // Date and time format
        time_24hr: true, // 24-hour format
        onChange: function(selectedDates, dateStr, instance) {
            // Get the selected date (only the date part)
            const selectedDate = dateStr.split(' ')[0];
            // Clear the kapal selection
            document.querySelector('#kapal').value = '';
            // Iterate over all kapal options
            document.querySelectorAll('#kapal option').forEach(option => {
                const tanggalTersediaBooking = option.getAttribute('data-tanggal-tersedia-booking');
                if (tanggalTersediaBooking && tanggalTersediaBooking === selectedDate) {
                    option.disabled = true;
                    if (!option.textContent.includes('(kapal ini dirental pada tanggal tersebut)')) {
                        option.textContent += ' (kapal ini dirental pada tanggal tersebut)';
                    }
                } else {
                    option.disabled = false;
                    option.textContent = option.textContent.replace(' (kapal ini dirental pada tanggal tersebut)', '');
                }
            });
        }
    });
</script>
@endsection
