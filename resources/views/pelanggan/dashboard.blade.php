@extends('layouts.pelanggan')

@section('jsCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').on('click', '#detailData', function() {
                var id = $(this).data('id');
                var url = "{{ route('pelanggan.pesanDetail', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#bodyDetailModal').html(data);
                        detailData(id);
                        $('#detailModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            tableData();

            function tableData() {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pelanggan') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'kode_transaksi',
                            name: 'kode_transaksi'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data) {
                                var date = new Date(data);
                                var day = date.getDate();
                                var month = date.getMonth() + 1;
                                var year = date.getFullYear();
                                var formattedDate = day + '-' + month + '-' + year;
                                return formattedDate;
                            }
                        },
                        {
                            data: 'statusPesanan',
                            name: 'statusPesanan'
                        },
                        {
                            data: 'statusPembayaran',
                            name: 'statusPembayaran'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        }
                    ]
                });
            }

            function detailData(idDetail) {
                var urlDetail = "{{ route('pelanggan.pesanDetailProduk', ':id') }}";
                urlDetail = urlDetail.replace(':id', idDetail);
                $('#detail-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: urlDetail,
                    columns: [{
                            data: 'produk',
                            name: 'produk'
                        },
                        {
                            data: 'hargaProduk',
                            name: 'hargaProduk'
                        },
                        {
                            data: 'jumlah_dipesanan',
                            name: 'jumlah_dipesanan'
                        },
                        {
                            data: 'totalHarga',
                            name: 'totalHarga'
                        },
                    ]
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang! 🎉</h5>
                                <p class="mb-4">
                                    Temukan pengalaman berbelanja yang luar biasa dengan koleksi produk terbaru kami
                                </p>

                                <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary">Belanja Sekarang</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('backend/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('backend/img/icons/unicons/wallet-info.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Pesanan</span>
                                <h3 class="card-title mb-2">{{ $pesanan }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('backend/img/icons/unicons/chart-success.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Keranjang</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $keranjang }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Data Pesanan Anda</h5>
                        <div class="card-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Pembayaran</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- / Content -->
    {{-- MODAL DETAIL --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyDetailModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL DETAIL --}}
@endsection
