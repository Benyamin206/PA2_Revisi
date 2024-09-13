
              

            
            
            
                            <!-- //container carausel -->
            
            
                            <!-- card -->
            
                            <div class="d-flex justify-content-center mb-5" id="card-container">
                                <div class="card bg-light shadow" style="width: 1180px;">
                                    <div class="card-body" id="card-container-body">
                                        <!-- header -->
                                        <div class="product-list-text">
                                           <h4> <b>Hey, Kamu</b></h4>
                                            <h2 class="font-weight-bold">Mau ke mana?</h2>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="input-group d-flex align-items-baseline mr-3" style="width: 140px;">
                                                <input type="radio" aria-label="Radio button for following text input">
                                                <p class="ml-2">Sekali Jalan</p>
                                            </div>
                                            <div class="input-group d-flex align-items-baseline" style="width: 140px;">
                                                <input type="radio" aria-label="Radio button for following text input">
                                                <p class="ml-2">Pulang-Pergi</p>
                                            </div>
                                        </div>
                                        <form action="{{route('filter_jadwal_cari_pergi')}}" method="POST">

                                            <div class="row">
                                                 @csrf
                                                <div class="col border border-secondary pt-3 pb-3 pr-0">
                                                    <p class="text-muted mb-2" style="font-size: 14px;">Mau kemana?</p>
                                                    <h6 class="text-muted font-weight-bold">
                                                        <i class="fas fa-ship" style="color: rgb(0, 100, 210)"></i>
                                                        Pilih Rute
                                                    </h6>
                                                    {{-- <select id="routeSelect" class="form-control">
                                                        <option value="tomokToAjibata">Tomok ke Ajibata</option>
                                                        <option value="ajibataToTomok">Ajibata ke Tomok</option>
                                                    </select> --}}
                                                    <select name="rute" id="" class="form-control" required>
                                                        @foreach ($rutes as $r)
                                                            <option value="{{$r->id}}">{{$r->lokasi_berangkat}} ke {{$r->lokasi_tujuan}}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                
                                                <div class="col border border-secondary pt-3 pb-3">
                                                    <p class="text-muted mb-2" style="font-size: 14px;">Berangkat</p>
                                                    <h6 id="departureDate" style="color: rgb(53, 64, 90)" class="font-weight-bold">
                                                        <i class="fa fa-calendar" aria-hidden="true" style="color: rgb(0, 100, 210)"></i>
                                                        {{-- Jum, 01 Januari 2021 --}} Silahkan pilih tanggal 
                                                    </h6>
                                                    <input type="date" name="date" id="datepicker" class="form-control">
                                                </div>
                                            </div>
                                        
            
                                        <style>
                                            .invalid-date {
                                                pointer-events: none; /* Tanggal tidak dapat diklik */
                                                color: red; /* Warna teks merah */
                                            }
                                        </style>
            
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                // Mendapatkan elemen-elemen yang diperlukan
                                                var datepicker = document.getElementById("datepicker");
            
                                                // Menetapkan tanggal minimum untuk datepicker menjadi hari ini
                                                datepicker.min = new Date().toISOString().split("T")[0];
            
                                                // Menangani perubahan tanggal
                                                datepicker.addEventListener("change", function () {
                                                    validateDatepicker();
                                                });
            
                                                // Fungsi untuk memvalidasi tanggal dan menerapkan gaya CSS
                                                function validateDatepicker() {
                                                    var selectedDate = new Date(datepicker.value);
                                                    var today = new Date();
            
                                                    if (selectedDate < today) {
                                                        datepicker.classList.add("invalid-date");
                                                    } else {
                                                        datepicker.classList.remove("invalid-date");
                                                    }
                                                }
                                            });
                                        </script>
            
                                        </script>
            
                                        <!-- //bottom -->
            
            
                                        <!-- footer card -->
                                        <div class="d-flex align-items-center">
                                            <div class="input-group mt-3 d-flex align-items-start">
                                                <div class="ml-2 text">
                                                    <br><br>
                                                </div>
                                            </div>
            
                        <button type="submit" class="btn btn-warning rounded-pill text-muted text-nowrap">CARI TIKET</button>
                    </form>
                                            {{-- <script>
                                                function redirectToBookingPage() {
                                                    window.location.href = 'booking.blade.php';
                                                }
                                            </script> --}}
                                        </div>
                                        <!-- //footer card -->
                                    </div>
                                </div>
                            </div>
                            <!-- //card -->
