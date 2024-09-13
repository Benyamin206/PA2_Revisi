@extends('layouts.adminBar2')
@section('content')
<div class="my">
  <h2>Jadwal</h2>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <form action="{{ route('tambah_jadwal') }}">
            <button type="submit" class="btn btn-success">Tambah Jadwal</button>
        </form>
        <div class="input-group w-25">
            <input type="date" id="filter-date" class="form-control" placeholder="Filter by date">
        </div>
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Waktu Berangkat</th>
                    <th scope="col">Rute</th>
                    <th scope="col">Kapal</th>
                    <th scope="col">Supir</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="jadwal-table">
                <?php $num = 1; ?>
                @foreach($jadwals as $j)
                <tr class="jadwal-row">
                    <th scope="row">{{ $num }}</th>
                    <td class="waktu-berangkat" data-waktu="{{ $j->waktu_berangkat }}">{{ $j->waktu_berangkat }}</td>
                    <td>{{ $j->rute->lokasi_berangkat }} - {{ $j->rute->lokasi_tujuan }}</td>
                    <td>{{ $j->kapal->nama }}</td>
                    <td>{{ $j->supir->name }}</td>
                    <td>
                        @php
                            $now = \Illuminate\Support\Carbon::now(new DateTimeZone('Asia/Jakarta'));
                            $now2 = strtotime($now);
                            $waktuBerangkat = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $j->waktu_berangkat);
                            $waktuBerangkat2 = strtotime($waktuBerangkat);
                        @endphp
                        @if ($now2 > $waktuBerangkat2)
                            <span class="badge badge-danger">Sudah Berangkat</span>
                        @else
                            <span class="badge badge-primary">Belum Berangkat</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('edit_jadwal', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                    </td>
                </tr>
                <?php $num++; ?>
                @endforeach
            </tbody>
        </table>
        <!-- Message when no schedules are found -->
        <div id="no-schedule-message" class="alert alert-info text-center" style="display: none;">
            Jadwal tidak ditemukan.
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // JavaScript for formatting datetime
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

        document.querySelectorAll('.waktu-berangkat').forEach((td) => {
            const dateTimeStr = td.getAttribute('data-waktu');
            td.textContent = formatDateTime(dateTimeStr);
        });

        // JavaScript for filtering rows by date and updating row numbers
        document.getElementById('filter-date').addEventListener('change', function() {
            const filterDate = new Date(this.value).setHours(0, 0, 0, 0);
            let hasVisibleRows = false;
            let rowIndex = 1; // Initialize row index for numbering
            document.querySelectorAll('.jadwal-row').forEach((row) => {
                const rowDate = new Date(row.querySelector('.waktu-berangkat').getAttribute('data-waktu')).setHours(0, 0, 0, 0);
                if (filterDate === rowDate) {
                    row.style.display = '';
                    row.querySelector('th').textContent = rowIndex; // Update row number
                    rowIndex++; // Increment row index
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });
            document.getElementById('no-schedule-message').style.display = hasVisibleRows ? 'none' : 'block';
        });
    });
</script>
@endsection
