@extends('layouts.adminBar2')

@section('content')
<center><h1>Edit Jadwal</h1></center>

<div class="container">
    <h5><a href="{{ route('index_jadwal') }}">Index Jadwal</a></h5>
</div>

<div class="containerss">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jadwal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_jadwal', $jadwal->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="waktu_berangkat" class="col-md-4 col-form-label text-md-end">Current Waktu Berangkat</label>
                            <div class="col-md-6">
                                {{ \Illuminate\Support\Carbon::parse($jadwal->waktu_berangkat)->format('Y-m-d H:i') }}
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="waktu_berangkat" class="col-md-4 col-form-label text-md-end">Edit Waktu Berangkat</label>
                            <div class="col-md-6">
                                <input id="waktu_berangkat" type="datetime-local" class="form-control" name="waktu_berangkat" value="{{ old('waktu_berangkat', \Illuminate\Support\Carbon::parse($jadwal->waktu_berangkat)->format('Y-m-d\TH:i')) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="rute_id" class="col-md-4 col-form-label text-md-end">Rute</label>
                            <div class="col-md-6">
                                <select name="rute_id" id="rute_id" class="form-control" required>
                                    <option value="{{ $jadwal->rute->id }}" selected>{{ $jadwal->rute->lokasi_berangkat }} - {{ $jadwal->rute->lokasi_tujuan }}</option>
                                    @foreach($rutes as $r)
                                        @if($r->id != $jadwal->rute->id)
                                            <option value="{{ $r->id }}" {{ old('rute_id') == $r->id ? 'selected' : '' }}>{{ $r->lokasi_berangkat }} - {{ $r->lokasi_tujuan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kapal" class="col-md-4 col-form-label text-md-end">Kapal</label>
                            <div class="col-md-6">
                                <select name="kapal_id" id="kapal" class="form-control" required>
                                    <option value="{{ $jadwal->kapal->id }}" data-tanggal-tersedia-booking="{{ $jadwal->kapal->tanggal_tersedia_booking }}" selected>{{ $jadwal->kapal->nama }}</option>
                                    @foreach($kapals as $k)
                                        @if($k->id != $jadwal->kapal->id)
                                            <option value="{{ $k->id }}" data-tanggal-tersedia-booking="{{ $k->tanggal_tersedia_booking }}" {{ old('kapal_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="supir" class="col-md-4 col-form-label text-md-end">Nahkoda</label>
                            <div class="col-md-6">
                                <select name="supir_id" id="supir" class="form-control" required>
                                    <option value="{{ $jadwal->supir->id }}" selected>{{ $jadwal->supir->name }}</option>
                                    @foreach($nahkodas as $n)
                                        @if($n->id != $jadwal->supir->id)
                                            <option value="{{ $n->id }}" {{ old('supir_id') == $n->id ? 'selected' : '' }}>{{ $n->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="updateButton" class="btn btn-primary">
                                    Update
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
    const updateButton = document.getElementById('updateButton');
    const waktuBerangkatInput = document.getElementById('waktu_berangkat');
    const kapalSelect = document.getElementById('kapal');

    function checkKapalAvailability() {
        const selectedDate = waktuBerangkatInput.value.split('T')[0];
        let isKapalUnavailable = false;

        document.querySelectorAll('#kapal option').forEach(option => {
            const tanggalTersediaBooking = option.getAttribute('data-tanggal-tersedia-booking');
            const kapalNama = option.textContent.split(' - ')[0]; // Extract the ship name

            if (tanggalTersediaBooking && tanggalTersediaBooking === selectedDate) {
                option.disabled = true;
                option.textContent = `${kapalNama} - <kapal ini dirental pada tanggal tersebut>`;
                if (option.selected) {
                    isKapalUnavailable = true;
                }
            } else {
                option.disabled = false;
                option.textContent = option.textContent.replace(' - <kapal ini dirental pada tanggal tersebut>', '');
            }
        });

        if (isKapalUnavailable) {
            alert('Kapal yang dipilih sedang dirental pada tanggal tersebut.');
            updateButton.disabled = true;
        } else {
            updateButton.disabled = false;
        }
    }

    waktuBerangkatInput.addEventListener('change', () => {
        kapalSelect.value = '';
        checkKapalAvailability();
    });

    window.addEventListener('load', checkKapalAvailability);
</script>
@endsection
