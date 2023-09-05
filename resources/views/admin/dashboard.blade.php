 @extends('layouts.admin')

 @section('cssCustom')
     <link rel="stylesheet" href="{{ asset('backend/vendor/libs/typeahead-js/typeahead.css') }}" />
     <link rel="stylesheet" href="{{ asset('backend/vendor/libs/apex-charts/apex-charts.css') }}" />
 @endsection

 @section('jsCustom')
 {{-- {{ dd($monthlyIncome) }} --}}
     <script src="{{ asset('backend/vendor/libs/apex-charts/apexcharts.js') }}"></script>
     <script src="{{ asset('backend/js/dashboards-analytics.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.js"></script>
     <script>
         var incomeChart = new Chart(document.getElementById('incomeChart'), {
             type: 'bar',
             data: {
                 labels: {!! json_encode($bulanChart) !!},
                 datasets: [{
                     label: 'Penghasilan',
                     data: {!! json_encode($jumlahTotal) !!},
                     backgroundColor: 'rgba(75, 192, 192, 0.6)',
                     borderColor: 'rgba(75, 192, 192, 1)',
                     borderWidth: 1
                 }]
             },
             options: {
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             }
         });
     </script>
 @endsection

 @section('content')
     <div class="container-xxl flex-grow-1 container-p-y">
         <div class="row">

             <div class="col-lg-8 mb-4 order-0">
                 <div class="card">
                     <div class="d-flex align-items-end row">
                         <div class="col-sm-7">
                             <div class="card-body">
                                 <h5 class="card-title text-primary">Selamat Datang! 🎉</h5>
                                 <p class="mb-4">
                                     Anda memiliki <b>{{ $pesananHariIni }} pesanan</b> pada hari ini, silahkan masuk ke
                                     menu pesanan untuk
                                     melihat lebih detailnya
                                 </p>

                                 <a href="{{ route('admin.pesan') }}" class="btn btn-sm btn-outline-primary">Lihat Pesanan</a>
                             </div>
                         </div>
                         <div class="col-sm-5 text-center text-sm-left">
                             <div class="card-body pb-0 px-0 px-md-4">
                                 <img src="{{ asset('backend/img/illustrations/man-with-laptop-light.png') }}"
                                     height="140" alt="View Badge User"
                                     data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                     data-app-light-img="illustrations/man-with-laptop-light.png" />
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-2 mb-4 order-0">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title d-flex align-items-start justify-content-between">
                             <div class="avatar flex-shrink-0">
                                 {{-- <i class="bx bx-user rounded"></i> --}}
                                 <button class="btn btn-primary btn-sm"><i class="bx bx-user-check rounded"></i></button>
                             </div>
                         </div>
                         <span class="fw-semibold d-block mb-1">Pelanggan</span>
                         <h3 class="card-title mb-4">{{ $countPelanggan }}</h3>
                         {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                     </div>
                 </div>
             </div>

             <div class="col-lg-2 mb-4 order-0">
                 <div class="card">
                     <div class="card-body">
                         <div class="card-title d-flex align-items-start justify-content-between">
                             <div class="avatar flex-shrink-0">
                                 {{-- <i class="bx bx-user rounded"></i> --}}
                                 <button class="btn btn-success btn-sm"><i class="bx bx-user rounded"></i></button>
                             </div>
                         </div>
                         <span class="fw-semibold d-block mb-1">Pengguna</span>
                         <h3 class="card-title mb-4">{{ $countUser }}</h3>
                         {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> --}}
                     </div>
                 </div>
             </div>

         </div>

         <div class="row mb-4">
             <div class="col-md-6">

                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-8">
                                 <span class="fw-semibold d-block mb-1">Pendapatan Keseluruhan</span>
                                 <h3 class="card-text">Rp. {{ number_format($totalKeseluruhan) }}</h3>
                             </div>
                             <div class="col-md-4 text-right" style="text-align: center;">
                                 <i class="bx bx-money text-primary icon" style="font-size: 48px;"></i>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

             <div class="col-md-6">

                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-8">
                                 <span class="fw-semibold d-block mb-1">Pendapatan Hari Ini</span>
                                 <h3 class="card-text">Rp. {{ number_format($totalHariIni) }}</h3>
                             </div>
                             <div class="col-md-4 text-right" style="text-align: center;">
                                 <i class="bx bx-money text-primary icon" style="font-size: 48px;"></i>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>

         </div>

         <div class="row">
             <!-- Total Income -->
             <div class="col-md-8 mb-4">
                 <div class="card">
                     <div class="row row-bordered g-0">
                         <div class="col-md-12">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Grafik Pendapatan</h5>
                                 <small class="card-subtitle">Laporan tahunan</small>
                             </div>
                             <div class="card-body">
                                 <canvas id="incomeChart" width="100%"></canvas>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--/ Total Income -->
             </div>

         </div>
     @endsection
