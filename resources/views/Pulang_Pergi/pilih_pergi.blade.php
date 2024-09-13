@extends('layouts.app')

<style>
    .scrollable {
        max-height: 400px;
        overflow-y: auto;
    }
    .vertical-divider {
        border-left: 3px solid #6c757d; /* Adjust the color and width as needed */
        height: 100%;
    }
    @media (max-width: 768px) {
        .vertical-divider {
            border-left: none;
            border-top: 3px solid #6c757d;
            width: 100%;
            height: auto;
            margin: 20px 0;
        }
    }
    .disabled-option {
        pointer-events: none;
        opacity: 0.5;
    }
</style>

@section('content')

<div class="container mt-5">
    <form id="jadwalForm" action="{{ route('detail_jadwal_pulang_pergi') }}" method="POST">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-md-5">
                <h2>Pilih Jadwal Berangkat</h2>
                <div class="scrollable">
                    @foreach ($Njadwals as $j)
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            {{ $j->rute->lokasi_berangkat }} - {{ $j->rute->lokasi_tujuan }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Waktu Berangkat: <span class="waktu-berangkat" data-waktu="{{ $j->waktu_berangkat }}"></span></h5>
                            <p class="card-text">Kapal: {{ $j->kapal->nama }}</p>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalKapal{{ $j->id }}">Tentang Kapal</button>
                            <div class="form-check">
                                <input class="form-check-input pergi-checkbox" type="checkbox" name="jadwal_berangkat" value="{{ $j->id }}" id="berangkat{{ $j->id }}" data-waktu="{{ $j->waktu_berangkat }}">
                                <label class="form-check-label" for="berangkat{{ $j->id }}">
                                    Pilih
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for ship description -->
                    <div class="modal fade" id="modalKapal{{ $j->id }}" tabindex="-1" aria-labelledby="modalKapalLabel{{ $j->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalKapalLabel{{ $j->id }}">Tentang Kapal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/Kapal_Image/'.$j->kapal->gambar) }}" class="img-fluid" alt="Gambar Kapal">
                                    </div>
                                    <div>
                                        <h3>{{ $j->kapal->nama }}</h3>
                                        <p>{{ $j->kapal->deskripsi }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-center align-items-center">
                <div class="vertical-divider"></div>
            </div>
            <div class="col-md-5">
                <h2>Pilih Jadwal Pulang</h2>
                <div class="scrollable">
                    @foreach ($Njadwals2 as $j2)
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            {{ $j2->rute->lokasi_berangkat }} - {{ $j2->rute->lokasi_tujuan }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Waktu Berangkat: <span class="waktu-berangkat" data-waktu="{{ $j2->waktu_berangkat }}"></span></h5>
                            <p class="card-text">Kapal: {{ $j2->kapal->nama }}</p>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalKapalPulang{{ $j2->id }}">Tentang Kapal</button>
                            <div class="form-check">
                                <input class="form-check-input pulang-checkbox" type="checkbox" name="jadwal_pulang" value="{{ $j2->id }}" id="pulang{{ $j2->id }}" data-waktu="{{ $j2->waktu_berangkat }}">
                                <label class="form-check-label" for="pulang{{ $j2->id }}">
                                    Pilih
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for ship description (return schedule) -->
                    <div class="modal fade" id="modalKapalPulang{{ $j2->id }}" tabindex="-1" aria-labelledby="modalKapalPulangLabel{{ $j2->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalKapalPulangLabel{{ $j2->id }}">Tentang Kapal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/Kapal_Image/'.$j2->kapal->gambar) }}" class="img-fluid" alt="Gambar Kapal">
                                    </div>
                                    <div>
                                        <h3>{{ $j2->kapal->nama }}</h3>
                                        <p>{{ $j2->kapal->deskripsi }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Pesan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        function formatDateTime(dateTimeStr) {
            const date = new Date(dateTimeStr);
            const dayName = days[date.getDay()];
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            return `${dayName}, ${day} ${month} ${year} - ${hours}:${minutes}`;
        }

        document.querySelectorAll('.waktu-berangkat').forEach((span) => {
            const dateTimeStr = span.getAttribute('data-waktu');
            span.textContent = formatDateTime(dateTimeStr);
        });

        const pergiCheckboxes = document.querySelectorAll('.pergi-checkbox');
        const pulangCheckboxes = document.querySelectorAll('.pulang-checkbox');
        const jadwalForm = document.getElementById('jadwalForm');

        function updateCheckboxStates() {
            let pergiWaktuSelected = null;
            let pulangWaktuSelected = null;

            pergiCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    pergiWaktuSelected = new Date(checkbox.getAttribute('data-waktu'));
                }
            });

            pulangCheckboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    pulangWaktuSelected = new Date(checkbox.getAttribute('data-waktu'));
                }
            });

            pergiCheckboxes.forEach((checkbox) => {
                const waktu = new Date(checkbox.getAttribute('data-waktu'));
                if (pulangWaktuSelected && waktu >= pulangWaktuSelected) {
                    checkbox.closest('.card').classList.add('disabled-option');
                    checkbox.disabled = true;
                } else {
                    checkbox.closest('.card').classList.remove('disabled-option');
                    checkbox.disabled = false;
                }
            });

            pulangCheckboxes.forEach((checkbox) => {
                const waktu = new Date(checkbox.getAttribute('data-waktu'));
                if (pergiWaktuSelected && waktu <= pergiWaktuSelected) {
                    checkbox.closest('.card').classList.add('disabled-option');
                    checkbox.disabled = true;
                } else {
                    checkbox.closest('.card').classList.remove('disabled-option');
                    checkbox.disabled = false;
                }
            });
        }

        pergiCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                pergiCheckboxes.forEach((cb) => {
                    if (cb !== checkbox) cb.checked = false;
                });
                updateCheckboxStates();
            });
        });

        pulangCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                pulangCheckboxes.forEach((cb) => {
                    if (cb !== checkbox) cb.checked = false;
                });
                updateCheckboxStates();
            });
        });

        jadwalForm.addEventListener('submit', (event) => {
            const pergiSelected = Array.from(pergiCheckboxes).some(checkbox => checkbox.checked);
            const pulangSelected = Array.from(pulangCheckboxes).some(checkbox => checkbox.checked);

            if (!pergiSelected || !pulangSelected) {
                event.preventDefault();
                alert('Harap pilih jadwal berangkat dan jadwal pulang.');
            }
        });

        updateCheckboxStates();
    });
</script>

@endsection
