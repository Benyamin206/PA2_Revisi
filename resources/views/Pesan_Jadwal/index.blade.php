@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('content')
<br><br>

<div class="container">
    <h2 class="mb-4 text-center">Pesan Jadwal Tersedia</h2>

    <div class="d-flex justify-content-center mb-4">
        <ul class="list-group list-group-horizontal position-relative overflow-auto" id="date-list">
            <!-- Dates will be inserted here by JavaScript -->
        </ul>
    </div>

    <div class="row align-items-center mb-4">
        <div class="col-md-6 mb-3">
            <form action="{{ route('filter_jadwal') }}" method="post" id="filter-form">
                @csrf
                <input type="hidden" name="date" id="selected-date">
            </form>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="/jadwal/index_pesan" class="btn btn-primary">Tampilkan Semua Jadwal</a>
        </div>
    </div>

    @if(empty($jadwals))
    <div class="text-center">
        <h1>Jadwal Tidak Ditemukan</h1>
    </div>
    @else
    <div class="row">
        @foreach($jadwals as $j)
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4>{{ $j->rute->lokasi_berangkat }} - {{ $j->rute->lokasi_tujuan }}</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Waktu Berangkat: <span class="waktu-berangkat" data-waktu="{{ $j->waktu_berangkat }}"></span></h5>
                    <p class="card-text">Kapal yang beroperasi: {{ $j->kapal->nama }}</p>
                    @if ($j->kapal->id != 21)
                    <button class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#modalKapal{{ $j->id }}">Tentang Kapal</button>
                    @endif
                    <form action="{{ route('detail_jadwal', $j->id) }}" method="GET">
                        @csrf
                        <button class="btn btn-primary w-100" type="submit">Lakukan Pemesanan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalKapal{{ $j->id }}" tabindex="-1" aria-labelledby="modalKapalLabel{{ $j->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalKapalLabel{{ $j->id }}">Tentang Kapal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{ $j->kapal->nama }}</h3>
                                <p>{{ $j->kapal->deskripsi }}</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('storage/Kapal_Image/'.$j->kapal->gambar) }}" class="img-fluid w-100" alt="Gambar Kapal">
                            </div>
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
    @endif
    <br><br>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    const dateList = document.getElementById('date-list');
    const selectedDateInput = document.getElementById('selected-date');
    const form = document.getElementById('filter-form');
    const initialDate = "{{ $date ?? '' }}"; // Get the selected date from the server-side

    function formatDate(date) {
        const dayName = days[date.getDay()];
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();
        return `${dayName}, ${day} ${months[month]} ${year}`;
    }

    function generateDates() {
        const today = new Date();
        for (let i = 0; i < 14; i++) {
            const date = new Date(today);
            date.setDate(today.getDate() + i);

            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item', 'date-item');
            listItem.textContent = formatDate(date);
            listItem.dataset.date = date.toISOString().split('T')[0]; // Set date in ISO format (YYYY-MM-DD)

            if (listItem.dataset.date === initialDate) {
                listItem.classList.add('active');
                setTimeout(() => {
                    listItem.scrollIntoView({ behavior: 'smooth', inline: 'center' });
                }, 100);
            }

            listItem.addEventListener('click', function() {
                selectedDateInput.value = this.dataset.date;

                document.querySelectorAll('.date-item').forEach(item => item.classList.remove('active'));

                this.classList.add('active');

                form.submit();
            });

            dateList.appendChild(listItem);
        }
    }

    generateDates();

    document.querySelectorAll('.waktu-berangkat').forEach((span) => {
        const dateTimeStr = span.getAttribute('data-waktu');
        span.textContent = formatDateTime(dateTimeStr);
    });

    function formatDateTime(dateTimeStr) {
        const date = new Date(dateTimeStr);
        const dayName = days[date.getDay()];
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        return `${dayName}, ${day} ${months[month]} ${year} - ${hours}:${minutes}`;
    }
});
</script>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f4f7;
        color: #343a40;
    }

    .custom-card {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

    .date-item {
        min-width: 220px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: #e9ecef; /* Soft background color */
        border-radius: 5px;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .date-item:hover {
        background-color: #007bff;
        color: white;
    }

    .date-item.active {
        background-color: #0056b3 !important;
        color: white !important;
    }

    .list-group-horizontal .date-item {
        margin-right: 10px;
    }

    .list-group-horizontal .date-item:last-child {
        margin-right: 0;
    }

    .modal-xl {
        max-width: 90%;
    }

    .modal-body img {
        max-height: 300px;
        object-fit: cover;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
    }
</style>

@endsection
